import React, { createContext, useState } from 'react';
import AsyncStorage from '@react-native-community/async-storage';
import * as RNLocalize from 'react-native-localize';
import translations from './translations';
import { APP_LANGUAGE, DEFAULT_LANGUAGE } from '../../config/constants';

import 'mobx-react-lite/batchingForReactNative';
import rootStore from '../../model/root';

export const LocalizationContext = createContext({
  translations,
  setAppLanguage: () => {},
  appLanguage: DEFAULT_LANGUAGE,
  initializeAppLanguage: () => {},
});

export const LocalizationProvider = ({ children }) => {
  const [appLanguage, setAppLanguage] = useState(DEFAULT_LANGUAGE);

  const setLanguage = (language) => {
    translations.setLanguage(language);
    setAppLanguage(language);
    rootStore.language.changeLanguage(language);
    AsyncStorage.setItem(APP_LANGUAGE, language);
  };

  const initializeAppLanguage = async () => {
    const currentLanguage = await AsyncStorage.getItem(APP_LANGUAGE);
    if (!currentLanguage) {
      let localeCode = DEFAULT_LANGUAGE;
      const supportedLocaleCodes = translations.getAvailableLanguages();
      const phoneLocaleCodes = RNLocalize.getLocales().map((locale) => locale.languageCode);
      phoneLocaleCodes.some((code) => {
        if (supportedLocaleCodes.includes(code)) {
          localeCode = code;
          return true;
        }
        return false;
      });
      setLanguage(localeCode);
    } else {
      setLanguage(currentLanguage);
    }
  };

  return (
    <LocalizationContext.Provider
      value={{
        translations,
        setAppLanguage: setLanguage,
        appLanguage,
        initializeAppLanguage,
      }}
    >
      {children}
    </LocalizationContext.Provider>
  );
};
