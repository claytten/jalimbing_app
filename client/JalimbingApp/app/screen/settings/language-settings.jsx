import React, { useState, useContext, useEffect } from 'react';
import { View, Text, Dimensions, TouchableOpacity } from 'react-native';
import { portraitStyles, landscapeStyles } from './language-settings.style';
import { LocalizationContext } from '../../services/localization/localization-context';
import 'mobx-react-lite/batchingForReactNative';
import rootStore from '../../model/root';

const LanguageSetting = () => {
  const [screen, setScreen] = useState(Dimensions.get('window'));
  const { translations, appLanguage, setAppLanguage } = useContext(LocalizationContext);
  const [selectedLanguage, setSelectedLanguage] = useState(appLanguage);

  useEffect(() => {
    setSelectedLanguage(appLanguage);
  }, [appLanguage]);

  const handleSetLanguage = async (language) => {
    setAppLanguage(language);
    rootStore.language.changeLanguage(language);
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
      <Text style={getStyle().textTitle}>{translations.LANGUAGE_SETTINGS}</Text>
      {translations.getAvailableLanguages().map((item) => (
        <TouchableOpacity key={item} style={getStyle().button} onPress={() => handleSetLanguage(item)}>
          <View style={{ flex: 7 }}>
            <Text>{item}</Text>
          </View>
          <View style={{ flex: 1 }}>
            <Text style={{ display: selectedLanguage === item ? 'flex' : 'none' }}>&#x2714;</Text>
          </View>
        </TouchableOpacity>
      ))}
    </View>
  );
};

export default LanguageSetting;
