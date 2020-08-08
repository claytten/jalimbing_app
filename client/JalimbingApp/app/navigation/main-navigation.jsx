import * as React from 'react';
import { createStackNavigator } from '@react-navigation/stack';
import BottomNavigation from './bottom-navigation';
import DetailPage from '../screen/detail-screen/detail';
import LanguageSetting from '../screen/settings/language-settings';

const Stack = createStackNavigator();

export default function DashboardNavigation() {
  return (
    <Stack.Navigator initialRouteName="Bottom Navigation" screenOptions={{ headerShown: false }}>
      <Stack.Screen name="Bottom Navigation" component={BottomNavigation} />
      <Stack.Screen name="Detail Page" component={DetailPage} />
      <Stack.Screen name="Language Setting" component={LanguageSetting} />
    </Stack.Navigator>
  );
}
