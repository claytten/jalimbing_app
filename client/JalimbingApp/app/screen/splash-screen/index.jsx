/* eslint-disable global-require */
import React, { useEffect } from 'react';
import { SafeAreaView, Image } from 'react-native';
import Styles from './index.styles';

const Index = ({ navigation }) => {
  useEffect(() => {
    setTimeout(function () {
      moveToHome();
    }, 1000);
  }, []);

  const moveToHome = () => {
    navigation.navigate('Bottom Navigation');
  };

  return (
    <SafeAreaView style={Styles.container}>
      <Image source={require('../../assets/image/jurang-belimbing-logo.png')} style={Styles.image} />
    </SafeAreaView>
  );
};

export default Index;
