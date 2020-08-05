
"use strict"

var url = window.location.origin + "/";
var centerView = new L.LatLng(-7.0517, 110.44463);
var mymap = L.map('mapid', {
  fullscreenControl: true
}).setView(centerView, 18);

L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoid2VsdmltIiwiYSI6ImNrOHEwbzZ0ZzAwZHUzbnFua3VuNnE5dHAifQ.Qhi2c-M8MUebIBpfUR2dVQ', {
  id: 'mapbox/outdoors-v9',
  accessToken: 'pk.eyJ1Ijoid2VsdmltIiwiYSI6ImNrOHEwbzZ0ZzAwZHUzbnFua3VuNnE5dHAifQ.Qhi2c-M8MUebIBpfUR2dVQ'
}).addTo(mymap);


/**
 * Singleton Variables
 * for better sharable state
 */
let startMarkingFlag = false;
let mark = [];
let takeMarker = undefined;
let markerPoint = L.marker();
let drawingState = false;

let startMarkingButton = L.easyButton({
  id: 'start-marking-button',
  states: [{
    icon: 'fa fa-pen',
    title: 'Start Marking',
    stateName: 'start-marking',
    onClick: (btn,map) => {
      btn.button.style.backgroundColor = "#f00";
      btn.button.style.color = "#fff";
      document.getElementById("mapid").style.cursor = "crosshair";

      btn.state('cancel-marking');
      drawingState = true;
    }
  }, {
    icon: 'fa fa-times',
    title: 'Cancel Marking',
    stateName: 'cancel-marking',
    onClick: (btn,map) => {
      btn.button.style.backgroundColor = '#fff';
      btn.button.style.color = '#000';
      document.getElementById("mapid").style.cursor = "grab";

      btn.state('start-marking');
      cancelMarking();
    }
  }]
});
startMarkingButton.addTo(mymap);

function cancelMarking() {
  markerPoint.closePopup();
  markerPoint.unbindPopup();
  mymap.removeLayer(markerPoint)
  mark = [];
}

function onMapClick(e) {
  if(!drawingState) return;

  
  if(mark.length == 0) {
    mark.push([e.latlng['lat'], e.latlng['lng']]);
    console.log(mark);
    startMarking(e.latlng);
  }
}

function startMarking(latlng) {
  markerPoint = L.marker(latlng);
  markerPoint.addTo(mymap);
  
  let popup = L.popup({
    closeButton: false,
    autoClose: false,
    closeOnEscapeKey: false,
    closeOnClick: false,
  }).setContent(`
    <div style="display:flex; flex-wrap: wrap;width:200px;height:100px" >
      <input class="form-control" style="width:100%; height: 50px"placeholder=" Nama Tempat" type="text" id="name-place" >
      <button class="col-12" class="btn btn-primary" onclick="confirmArea('${latlng}')"><i class="fa fa-check-circle"></i></button>
    </div>
  `);
  markerPoint.bindPopup(popup).openPopup();
}

function confirmArea(latlng) {
  let v = {
    namePlace : document.getElementById('name-place').value
  };

  sendMarkingJSON(v, latlng);
}

function sendMarkingJSON(data,latlng) {
  let markerGeoJSON = markerPoint.toGeoJSON(15);
  //checking inside GeoJSON
  console.log(markerGeoJSON);

  markerGeoJSON.properties = {
    popupContent: {
      namePlace : data.namePlace
    }
  }
  let formData = new FormData();
  formData.append('namePlace', data.namePlace);
  formData.append('coordinates', JSON.stringify(markerGeoJSON.geometry.coordinates));
  formData.append('action', 'post');
  $(".alert-result").slideUp(function(){
      $(this).remove();
  });

  $.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: `${url}admin/maps/api`,
    type: 'POST',
    cache: false,
    contentType: false,
    processData: false,
    data: formData,
    error: function (xhr, status, error) {
        console.log(xhr.responseText);
        console.log('Error sending data', error);
    },
    success: function(response){
      console.log("lolsd");
      console.log(response);
      $(`
      <div class="alert alert-`+ response.status +` alert-dismissible fade show alert-result" role="alert" style="margin-bottom: 0">
        <span class="alert-icon"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>
        <span class="alert-text">`+ response.message +`</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      `).appendTo($("#alert-result")).slideDown("slow", "swing");
      setTimeout(location.reload.bind(location), 1000);
    }
  });

}

function getGeoJSONData(){
  let wew;

  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: `${url}admin/maps/api`,
    type: 'GET',
    async: false,
    cache: false,
    error: function (xhr, status, error) {
      console.log(xhr.responseText);
    },
    success: function(response){
      wew = response.data;
      console.log(wew);
    }
  });

  return wew;
  //underbuilding
}

function onEachFeatureCallback(feature, layer){
  if (feature.properties && feature.properties.popupContent) {
    let { id,namePlace } = feature.properties.popupContent;
    let content = {
      id: id,
      namePlace: namePlace,

    }

    layer.bindPopup(getPopupContent(content));
  }
}

function getPopupContent(field) {
  return `
    <div style="display:flex; flex-wrap: wrap;width:200px;height:100px" >
      <input class="form-control" style="width:100%; height: 50px"placeholder=" Nama Tempat" type="text" id="name-place" value="${field.namePlace}">
      <button class="col-12" class="btn btn-primary" onclick="confirmUpdateArea('${field.id}')"><i class="fa fa-check-circle"></i></button>
      <button class="col-12" class="btn btn-primary" onclick="confirmDeleteArea('${field.id}')"><i class="fa fa-trash"></i></button>
    </div>
  `;
}

function confirmUpdateArea(id) {
  let v = {
    id : id,
    namePlace : document.getElementById('name-place').value
  };

  sendUpdateMarkingJSON(v);
}

function sendUpdateMarkingJSON(data) {
  let formData = new FormData();
  formData.append('id', data.id);
  formData.append('namePlace', data.namePlace);
  formData.append('action', 'update');

  $(".alert-result").slideUp(function(){
      $(this).remove();
  });

  $.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: `${url}admin/maps/api`,
    type: 'POST',
    cache: false,
    contentType: false,
    processData: false,
    data: formData,
    error: function (xhr, status, error) {
        console.log(xhr.responseText);
        console.log('Error sending data', error);
    },
    success: function(response){
      console.log("lolsd");
      console.log(response);
      $(`
      <div class="alert alert-`+ response.status +` alert-dismissible fade show alert-result" role="alert" style="margin-bottom: 0">
        <span class="alert-icon"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>
        <span class="alert-text">`+ response.message +`</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      `).appendTo($("#alert-result")).slideDown("slow", "swing");
      setTimeout(location.reload.bind(location), 1000);
    }
  });

}

function confirmDeleteArea(id) {
  let v = {
    id : id
  };
  sendDeleteMarkingJSON(v);
}

function sendDeleteMarkingJSON(data) {
  let formData = new FormData();
  formData.append('id', data.id);
  formData.append('action', 'delete')

  $(".alert-result").slideUp(function(){
      $(this).remove();
  });

  $.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: `${url}admin/maps/api`,
    type: 'POST',
    cache: false,
    contentType: false,
    processData: false,
    data: formData,
    error: function (xhr, status, error) {
        console.log(xhr.responseText);
        console.log('Error sending data', error);
    },
    success: function(response){
      console.log("lolsd");
      console.log(response);
      $(`
      <div class="alert alert-`+ response.status +` alert-dismissible fade show alert-result" role="alert" style="margin-bottom: 0">
        <span class="alert-icon"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>
        <span class="alert-text">`+ response.message +`</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      `).appendTo($("#alert-result")).slideDown("slow", "swing");
      setTimeout(location.reload.bind(location), 1000);
    }
  });
}

mymap.on('click', onMapClick);
document.onkeydown = (e) => {
  if(!drawingState) return;

  switch(e.keyCode){
    case 27: onKeyDownEscape(); break;
  }
};

function onKeyDownEscape() {
  cancelMarking();
}

L.geoJSON(getGeoJSONData(), {
  style: function(feature){
    return {color: feature.properties.color}
  },
  onEachFeature: onEachFeatureCallback
}).addTo(mymap);