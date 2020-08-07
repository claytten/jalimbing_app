@extends('layouts.admin.app',[
  'headers' => 'active',
  'menu' => 'accounts',
  'title' => 'Categories',
  'first_title' => 'Category',
  'first_link' => route('admin.category.index'),
  'second_title' => 'Edit',
  'second_link' => route('admin.category.edit', $category->id),
  'third_title'  => $category->name
])

@section('content_alert')
<div id="alert-section">
  @if(Session::get('message'))
    <div class="alert alert-{{ Session::get('status') }} alert-dismissible fade show alert-result" role="alert">
      <span class="alert-icon"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>
      <span class="alert-text">{{ Session::get('message') }}</span>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif
</div>
@endsection

@section('plugins_css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
@endsection


@section('content_body')
<form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
  {{ csrf_field() }}
  @method('PUT')
  <div class="row">
    <div class="col-lg-6">
      <div class="card-wrapper">
        <!-- Input groups -->
        <div class="card">
          <!-- Card header -->
          <div class="card-header">
            <div class="row align-items-center">
              <div class="col-8">
                <h3 class="mb-0">Categories Information</h3>
              </div>
              <div class="col-lg-2 text-right">
                <button type="button" class="btn btn-danger" id="btn-reset">Reset</button>
              </div>
              <div class="col-lg-2 text-right">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </div>
          <!-- Card body -->
          <div class="card-body">
              <!-- Input groups with icon -->
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="input-group input-group-merge">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                      </div>
                      <input class="form-control @error('name') is-invalid @enderror" placeholder="Your name" type="text" name="name" value="{{ $category->name }}" id="name">
                      @error('name')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="input-group input-group-merge">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                      </div>
                      <input class="form-control @error('schedule') is-invalid @enderror" placeholder="Schedule (ex. Sunday Night)" type="text" name="schedule" value="{{ $subcategory->schedule }}" id="schedule">
                      @error('schedule')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="input-group input-group-merge">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-instagram"></i></span>
                      </div>
                      <input class="form-control @error('instagram') is-invalid @enderror" placeholder="Your instagram" type="text" name="instagram" value="{{ $subcategory->instagram }}" id="instagram">
                      @error('instagram')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="input-group input-group-merge">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-whatsapp"></i></span>
                      </div>
                      <input class="form-control @error('whatsapp') is-invalid @enderror" placeholder="Your Whatsapp" type="text" name="whatsapp" value="{{ $subcategory->whatsapp }}" id="whatsapp">
                      @error('whatsapp')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="input-group input-group-merge">
                      <textarea class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Description" name="description" id="description">{{ $subcategory->description }}</textarea>
                      @error('description')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="input-group input-group-merge">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-youtube"></i></span>
                      </div>
                      <input class="form-control @error('link_youtube') is-invalid @enderror" placeholder="Your Link Youtube" type="text" name="link_youtube" value="{{ $subcategory->link_youtube }}" id="link_youtube">
                      @error('link_youtube')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
              <div class="row images-content">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="input-group input-group-merge">
                      <div class="custom-file">
                        <input type="file" accept=".jpg, .jpeg, .png" name="image" class="form-control imgs" onchange="previewImage(this)"id="projectCoverUploads">
                        <label class="custom-file-label" for="projectCoverUploads">Choose file image</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group" style="align-items: center">
                    <div class="input-group">
                      <button type="button" class="btn btn-sm btn-danger d-block mb-2 mx-auto remove_preview text-center" onclick="resetPreview(this)" disabled>Reset Preview</button>
                    </div>
                    <div class="input-group" style="justify-content: center">
                      @if(!empty($category->image))
                          <img class="img-responsive" width="150px;" style="padding:.25rem;background:#eee;display:block;" src="{{ url('/storage'.'/'.$category->image) }}">
                      @else
                          <img class="img-responsive" width="150px;" style="padding:.25rem;background:#eee;display:block;">
                      @endif
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card-wrapper">
        <div class="card">
          <!-- Card header -->
          <div class="card-header">
            <h3 class="mb-0">Pubilsh</h3>
          </div>
          <!-- Card body -->
          <div class="card-body">
            <label class="custom-toggle custom-toggle-default">
              <input type="checkbox" name="is_active" {{ ($subcategory->is_active == 1) ? 'checked' : '' }}>
              <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
            </label>
          </div>
        </div>
        <div class="card">
          <!-- Card header -->
          <div class="card-header">
            <h3 class="mb-0">Category Images</h3>
          </div>
          <!-- Card body -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <div class="input-group input-group-merge">
                    <button type="button" class="btn btn-primary" id="image_add"><i class="ni ni-fat-add"></i>Add Images</button>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <div id="image-container">
                    @if($subcategory->subCategoryImages()->exists())
                      @foreach($subcategory->subCategoryImages as $images)
                      <div class="form-group image_content_category">
                          <div class="row">
                              <div class="col-12 col-md-2 text-center">
                                  <button type="button" class="btn btn-sm btn-danger d-block mb-2 mx-auto remove_preview" onclick="resetCategoryPreview(this)" disabled>Reset Preview</button>
                                  <input type="hidden" name="old_image[]" class="old_image" value="{{ $images->image_link }}">
                                  <img class="img-responsive" width="150px;" style="padding:.25rem;background:#eee;display:block;" src="{{ url('/storage'.'/'.$images->image_link) }}">
                              </div>
                              <div class="col-12 col-md-10">
                                  <div class="input-group">
                                      <input type="file" accept=".jpg, .jpeg, .png" name="category_images[]" class="form-control category_images" onchange="previewCategoryImage(this)">
                                      <div class="input-group-append">
                                          <button class="btn btn-danger remove_field_category" type="button">
                                            <i class="ni ni-fat-remove"></i>
                                          </button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      @endforeach
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection

@section('inline_js')
<script>
  "use strict"

  // Add More Image
  function previewImage(input){
    console.log("Preview Image");
    let preview_image = $(input).closest('.images-content').find('.img-responsive');
    let preview_button = $(input).closest('.images-content').find('.remove_preview');

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            // console.log(e.target.result);
            $(preview_image).attr('src', e.target.result);
            
        }
        $('.custom-file-label').html(input.files[0].name);
        reader.readAsDataURL(input.files[0]);
        $(preview_button).prop('disabled', false);
    }
  }

  function resetPreview(input){

    let preview_image = $(input).closest('.images-content').find('.img-responsive');
    let preview_button = $(input).closest('.images-content').find('.remove_preview');
    let preview_form = $(input).closest('.images-content').find('.imgs');

    $('.custom-file-label').html('Choose File');
    $(preview_image).attr('src', '');
    $(preview_button).prop('disabled', true);
    $(preview_form).val('');
  }

  // Add More Image
  let wrap = document.getElementById("image-container");
  let add = document.getElementById("image_add");
  $(add).click(function(e){
      e.preventDefault();
      $(wrap).append('<div class="form-group image_content_category">'
              +'<div class="row">'
                  +'<div class="col-12 col-md-2 text-center">'
                      +'<button type="button" class="btn btn-sm btn-danger d-block mb-2 mx-auto remove_preview" onclick="resetCategoryPreview(this)" disabled>Reset Preview</button>'
                      +'<img class="img-responsive" width="150px;" style="padding:.25rem;background:#eee;display:block;">'
                  +'</div>'
                  +'<div class="col-12 col-md-10">'
                      +'<div class="input-group">'
                          +'<input type="file" accept=".jpg, .jpeg, .png" name="category_images[]" class="form-control category_images" onchange="previewCategoryImage(this)">'
                          +'<div class="input-group-append">'
                              +'<button class="btn btn-danger remove_field_category" type="button">'
                                  +'<i class="ni ni-fat-remove"></i>'
                              +'</button>'
                          +'</div>'
                      +'</div>'
                  +'</div>'
              +'</div>'
          +'</div>');
  });
  $(wrap).on("click", '.remove_field_category', function(e){ //user click on remove text
      // console.log("Hapus");
      console.log($(this).closest('.image_content_category'));
      e.preventDefault();
      $(this).closest('.image_content_category').remove();
  });
  $('.remove_field_category').on("click", function(e){ //user click on remove text
      // console.log("Hapus");
      $(this).closest('.image_content_category').remove();
  });

  function previewCategoryImage(input){
      console.log("Preview Image");
      let preview_image = $(input).closest('.image_content_category').find('.img-responsive');
      let preview_button = $(input).closest('.image_content_category').find('.remove_preview');
      let check_old_image = $(input).closest('.image_content_category').find('.old_image');

      if($(input).closest('.image_content_category').find('.old_image').val() !== "") {
        $(input).closest('.image_content_category').find('.old_image').remove();
      }

      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
              // console.log(e.target.result);
              $(preview_image).attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
          $(preview_button).prop('disabled', false);
      }
  }
  function resetCategoryPreview(input){
      console.log("Delete Preview is running...");

      let preview_image = $(input).closest('.image_content_category').find('.img-responsive');
      let preview_button = $(input).closest('.image_content_category').find('.remove_preview');
      let preview_form = $(input).closest('.image_content_category').find('.category_images');

      $(preview_image).attr('src', '');
      $(preview_button).prop('disabled', true);
      $(preview_form).val('');
  }

  $("#btn-reset").click(function(e){
    e.preventDefault();
    $("#name").val('');
    $('#schedule').val('');
    $('#instagram').val('');
    $('#whatsapp').val('');
    $('#description').html('');
  });
</script>
    
@endsection