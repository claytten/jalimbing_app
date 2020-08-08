import 'react-native-gesture-handler';
import * as React from 'react';
import { YellowBox } from 'react-native';
import { NavigationContainer } from '@react-navigation/native';
import MainNavigation from './navigation/main-navigation';
import { LocalizationProvider } from './services/localization/localization-context';

YellowBox.ignoreWarnings([
  'componentWillMount is deprecated',
  'componentWillReceiveProps is deprecated',
  'Require cycle:',
]);

function App() {
  return (
    <NavigationContainer>
      <LocalizationProvider>
        <MainNavigation />
      </LocalizationProvider>
    </NavigationContainer>
  );
}
export default App;
