/* eslint-disable global-require */
import React, { useState, useContext, useEffect, useCallback } from 'react';
import {
  View,
  Text,
  ScrollView,
  SafeAreaView,
  Dimensions,
  Image,
  BackHandler,
  Alert,
  RefreshControl,
} from 'react-native';
import moment from 'moment';
import 'moment/locale/id';
import 'moment/locale/en-sg';
import { observer } from 'mobx-react-lite';
import { portraitStyles, landscapeStyles } from './home.styles';
import { LocalizationContext } from '../../services/localization/localization-context';
import * as Resources from '../../services/api/resources';

import 'mobx-react-lite/batchingForReactNative';
import rootStore from '../../model/root';

import Menu from '../../components/menu';
import WatchIcon from '../../assets/svg/watch-later.svg';

const Home = observer(({ navigation }) => {
  const [screen, setScreen] = useState(Dimensions.get('window'));
  const { translations, initializeAppLanguage } = useContext(LocalizationContext);
  const [homeData, setHomeData] = useState([]);
  const [refreshing, setRefreshing] = useState(false);
  const [date, setDate] = useState();
  const { languageChange } = rootStore.language;

  useEffect(() => {
    getHomeData();
    BackHandler.addEventListener('hardwareBackPress', onExit);

    return () => {
      BackHandler.removeEventListener('hardwareBackPress', onExit);
    };
  }, []);

  useEffect(() => {
    if (languageChange === 'ID') {
      moment.locale('id');
      setDate(moment().format('LL'));
    } else {
      moment.locale('en-sg');
      setDate(moment().format('LL'));
    }
  }, [languageChange]);

  useEffect(() => {
    initializeAppLanguage();
  }, [initializeAppLanguage]);

  const getHomeData = () => {
    Resources.getHomeData()
      .then((res) => {
        setHomeData(res.data);
        setRefreshing(false);
      })
      .catch((error) => {
        console.log(error);
        setRefreshing(false);
      });
  };

  const onRefresh = useCallback(() => {
    setRefreshing(true);
    getHomeData();
  }, []);

  const onExit = () => {
    Alert.alert(
      'Exit from the app?',
      '',
      [
        { text: 'Yes', onPress: () => BackHandler.exitApp() },
        { text: 'No', onPress: () => console.log('NO'), style: 'cancel' },
      ],
      { cancelable: false }
    );
    return true;
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
      <ScrollView refreshControl={<RefreshControl refreshing={refreshing} onRefresh={onRefresh} />}>
        <Image source={require('../../assets/image/jurang-belimbing.jpg')} style={getStyle().image} />
        <View style={getStyle().view1}>
          <View style={getStyle().view2}>
            <Image source={require('../../assets/image/village-icon.png')} style={getStyle().image1} />
          </View>
          <View style={getStyle().view3}>
            <Text style={getStyle().textDesa}>{translations.JALIMBING_ART_VILLAGE}</Text>
            <View style={getStyle().viewDate}>
              <WatchIcon />
              <Text style={getStyle().textDate}>{date}</Text>
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
});

export default Home;
