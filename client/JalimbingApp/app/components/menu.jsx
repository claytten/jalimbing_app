/* eslint-disable global-require */
import React, { useState } from 'react';
import { View, Text, Dimensions, Image, TouchableWithoutFeedback } from 'react-native';
import { IMAGE_URL } from '../config/env';
import { portraitStyles, landscapeStyles } from './menu.styles';

const Menu = ({ onPress, item }) => {
  const [screen, setScreen] = useState(Dimensions.get('window'));

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
    <TouchableWithoutFeedback onPress={onPress}>
      <View style={getStyle().viewMenuChild} onLayout={onLayout}>
        <Image source={{ uri: IMAGE_URL + item.image }} style={getStyle().image} resizeMode="contain" />
        <Text style={getStyle().text}>{item.name}</Text>
        <Text style={getStyle().text1}>&gt;</Text>
      </View>
    </TouchableWithoutFeedback>
  );
};

export default Menu;
