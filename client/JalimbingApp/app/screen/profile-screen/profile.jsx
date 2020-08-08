import React, { useState, useContext, useEffect } from 'react';
import { View, Text, TouchableOpacity, Dimensions } from 'react-native';
import MapView, { Marker, PROVIDER_GOOGLE } from 'react-native-maps';
import { observer } from 'mobx-react-lite';
import { portraitStyles, landscapeStyles } from './profile.style';
import * as Resources from '../../services/api/resources';

import { LocalizationContext } from '../../services/localization/localization-context';
import 'mobx-react-lite/batchingForReactNative';
import rootStore from '../../model/root';

const Profile = observer(({ navigation }) => {
  const LATITUDE_DELTA = 0.0028812912122404555;
  const LONGITUDE_DELTA = 0.0024907663464546204;
  const [region] = useState({
    latitude: -7.051556,
    longitude: 110.444748,
    latitudeDelta: LATITUDE_DELTA,
    longitudeDelta: LONGITUDE_DELTA,
  });

  const { translations } = useContext(LocalizationContext);
  const [screen, setScreen] = useState(Dimensions.get('window'));

  useEffect(() => {
    getMapsData();
  }, []);

  const getMapsData = () => {
    Resources.getMapsData()
      .then((res) => {
        res.data.features.map((item) => {
          rootStore.mapsData.addMapsData(item);
          return true;
        });
      })
      .catch((error) => {
        console.log(error);
      });
  };

  const moveToLanguangeSetting = () => {
    navigation.navigate('Language Setting');
  };

  const getOrientation = () => {
    if (screen.width > screen.height) {
      return 'LANDSCAPE';
    }
    return 'PORTRAIT';
  };

  const getStyle = () => {
    if (getOrientation() === 'LANDSCAPE') {
      return landscapeStyles;
    }
    return portraitStyles;
  };

  const onLayout = () => {
    setScreen(Dimensions.get('window'));
  };

  return (
    <View style={getStyle().container} onLayout={onLayout}>
      <Text style={getStyle().textTitle}>{translations.PROFILE}</Text>
      <MapView
        style={getStyle().map}
        provider={PROVIDER_GOOGLE}
        initialRegion={region}
        region={region}
        showsUserLocation
        showsMyLocationButton
      >
        {rootStore.mapsData.items.map((marker) => {
          const positions = { latitude: marker.geometry.coordinates[1], longitude: marker.geometry.coordinates[0] };
          return (
            <Marker
              title={marker.properties.popupContent.namePlace}
              draggable={false}
              coordinate={positions}
              key={marker.properties.popupContent.id}
            />
          );
        })}
      </MapView>

      <TouchableOpacity onPress={moveToLanguangeSetting} style={getStyle().buttonSetting}>
        <Text style={getStyle().textSetting}>{translations.LANGUAGE_SETTINGS}</Text>
      </TouchableOpacity>
    </View>
  );
});

export default Profile;
