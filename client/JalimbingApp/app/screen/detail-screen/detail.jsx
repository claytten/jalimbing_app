/* eslint-disable global-require */
import React, { useState, useRef, useContext, useEffect } from 'react';
import {
  View,
  Text,
  ScrollView,
  SafeAreaView,
  Dimensions,
  Image,
  TouchableWithoutFeedback,
  PixelRatio,
  Linking,
} from 'react-native';
import YouTube from 'react-native-youtube';
import { observer } from 'mobx-react-lite';
import { portraitStyles, landscapeStyles } from './detail.styles';
import { LocalizationContext } from '../../services/localization/localization-context';
import * as Resources from '../../services/api/resources';

import 'mobx-react-lite/batchingForReactNative';
import rootStore from '../../model/root';

import Popup from '../../components/Popup';
import { YOUTUBE_API, IMAGE_URL } from '../../config/env';
import Instagram from '../../assets/svg/instagram.svg';

const Detail = observer(({ route }) => {
  const { id } = route.params;
  const [screen, setScreen] = useState(Dimensions.get('window'));
  const { translations } = useContext(LocalizationContext);
  const [popupImageUri, setPopupImageUri] = useState(IMAGE_URL);
  const [visible, setvisible] = useState(false);
  const [isReady, setIsReady] = useState(false);
  const [status, setStatus] = useState(null);
  const [quality, setQuality] = useState(null);
  const [error, setError] = useState(null);
  const [currentTime, setCurrentTime] = useState(0);
  const [fullscreen, setFullscreen] = useState(false);
  const [playerWidth, setPlayerWidth] = useState(Dimensions.get('window').width);
  const youtubeRef = useRef();

  useEffect(() => {
    getDetailData();
  }, []);

  const getDetailData = () => {
    Resources.getDetailData(id)
      .then((res) => {
        rootStore.detailData.addDetailData(res.data);
      })
      .catch((err) => {
        console.log(err);
      });
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

  const onPressImage = (uri) => {
    setPopupImageUri(IMAGE_URL + uri);
    setvisible(true);
  };

  const instagramPress = async (url) => {
    const uri = `instagram://user?username=${url}`;
    const supported = await Linking.canOpenURL(uri);

    if (supported) {
      await Linking.openURL(uri);
    } else {
      alert(`Don't know how to open this URL: ${uri}`);
    }
  };

  const whatsappPress = async (url) => {
    const uri = `https://wa.me/${url}?text=SelamatSiang`;
    const supported = await Linking.canOpenURL(uri);

    if (supported) {
      await Linking.openURL(uri);
    } else {
      alert(`Don't know how to open this URL: ${uri}`);
    }
  };

  return (
    <SafeAreaView style={getStyle().container} onLayout={onLayout}>
      <ScrollView>
        {rootStore.detailData.subcategory.sub_category_images.length > 0 && (
          <Image
            source={{ uri: IMAGE_URL + rootStore.detailData.subcategory.sub_category_images[0].image_link }}
            style={getStyle().image}
          />
        )}

        <View style={getStyle().view1}>
          <Text style={getStyle().textTitle}>{rootStore.detailData.subcategory.name}</Text>
          <Text style={getStyle().textTitle}>{rootStore.detailData.subcategory.description}</Text>
          <Text style={getStyle().textTitle}>Jadwal kegiatan: {rootStore.detailData.subcategory.schedule}</Text>
        </View>
        <View style={getStyle().viewMenu}>
          <Text style={getStyle().textDaftarKategori}>{translations.DOCUMENTATION}</Text>
          <View style={{ paddingRight: 20 }}>
            <ScrollView horizontal showsHorizontalScrollIndicator={false}>
              {rootStore.detailData.subcategory.sub_category_images.map((items) => (
                <TouchableWithoutFeedback onPress={() => onPressImage(items.image_link)} key={items.id}>
                  <View style={getStyle().view2}>
                    <Image source={{ uri: IMAGE_URL + items.image_link }} style={getStyle().image1} />
                  </View>
                </TouchableWithoutFeedback>
              ))}
            </ScrollView>
          </View>
          <View style={getStyle().viewVideo}>
            <YouTube
              ref={youtubeRef}
              apiKey={YOUTUBE_API}
              videoId={rootStore.detailData.subcategory.link_youtube}
              play={false}
              loop
              fullscreen={fullscreen}
              controls={1}
              style={[{ height: PixelRatio.roundToNearestPixel(playerWidth / (16 / 9)) }, getStyle().player]}
              onError={(e) => {
                setError(e.error);
              }}
              onReady={() => {
                setIsReady(true);
              }}
              onChangeState={(e) => {
                setStatus(e.state);
              }}
              onChangeQuality={(e) => {
                setQuality(e.quality);
              }}
              onChangeFullscreen={(e) => {
                setFullscreen(e.fullscreen);
              }}
              onProgress={(e) => {
                setCurrentTime(e.currentTime);
              }}
            />
          </View>

          <Text style={{ ...getStyle().textDaftarKategori, marginTop: 10 }}>{translations.SOCIAL_MEDIA}</Text>
          <View style={getStyle().viewMenuMedsos}>
            <TouchableWithoutFeedback onPress={() => instagramPress(rootStore.detailData.subcategory.instagram)}>
              <View style={getStyle().viewMenuChild} onLayout={onLayout}>
                <View style={getStyle().viewMenuChild1}>
                  <Instagram />
                </View>
                <View style={getStyle().viewMenuChild2}>
                  <Text style={getStyle().text}>Instagram</Text>
                </View>
              </View>
            </TouchableWithoutFeedback>
            <TouchableWithoutFeedback onPress={() => whatsappPress(rootStore.detailData.subcategory.whatsapp)}>
              <View style={getStyle().viewMenuChild} onLayout={onLayout}>
                <View style={getStyle().viewMenuChild1}>
                  <Image source={require('../../assets/image/whatsapp.png')} style={getStyle().imageMedsos} />
                </View>
                <View style={getStyle().viewMenuChild2}>
                  <Text style={getStyle().text}>Whatsapp</Text>
                </View>
              </View>
            </TouchableWithoutFeedback>
          </View>
        </View>
      </ScrollView>

      <Popup
        visible={visible}
        okeBtn={() => setvisible(false)}
        onClose={() => setvisible(false)}
        imageUri={popupImageUri}
      />
    </SafeAreaView>
  );
});

export default Detail;
