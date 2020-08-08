/* eslint-disable global-require */
import React, { useState, useContext, useEffect } from 'react';
import { View, Text, ScrollView, SafeAreaView, Dimensions, Image } from 'react-native';
import moment from 'moment';
import { portraitStyles, landscapeStyles } from './home.styles';
import { LocalizationContext } from '../../services/localization/localization-context';
import * as Resources from '../../services/api/resources';

import Menu from '../../components/menu';
import WatchIcon from '../../assets/svg/watch-later.svg';

const Home = ({ navigation }) => {
  const [screen, setScreen] = useState(Dimensions.get('window'));
  const { translations, initializeAppLanguage } = useContext(LocalizationContext);
  const [homeData, setHomeData] = useState([]);
  const [date] = useState(new Date());

  useEffect(() => {
    getHomeData();
  }, []);

  useEffect(() => {
    initializeAppLanguage();
  }, [initializeAppLanguage]);

  const getHomeData = () => {
    Resources.getHomeData()
      .then((res) => {
        setHomeData(res.data);
      })
      .catch((error) => {
        console.log(error);
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

  const moveToDetail = (id) => {
    navigation.navigate('Detail Page', { id });
  };

  return (
    <SafeAreaView style={getStyle().container} onLayout={onLayout}>
      <ScrollView>
        <Image source={require('../../assets/image/Gunung.jpg')} style={getStyle().image} />
        <View style={getStyle().view1}>
          <View style={getStyle().view2}>
            <Image source={require('../../assets/image/village-icon.png')} style={getStyle().image1} />
          </View>
          <View style={getStyle().view3}>
            <Text style={getStyle().textDesa}>{translations.JALIMBING_ART_VILLAGE}</Text>
            <View style={getStyle().viewDate}>
              <WatchIcon />
              <Text style={getStyle().textDate}>{moment(date).format('dddd, MMMM YYYY')}</Text>
            </View>
          </View>
        </View>
        <View style={getStyle().viewMenu}>
          <Text style={getStyle().textDaftarKategori}>{translations.LIST_CATEGORY}</Text>
          <View style={getStyle().viewMenu1}>
            {homeData.map((item) => {
              return <Menu text="Desa" item={item} onPress={() => moveToDetail(item.id)} key={item.id} />;
            })}
          </View>
        </View>
      </ScrollView>
    </SafeAreaView>
  );
};

export default Home;
