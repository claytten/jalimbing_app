import React, { useContext } from 'react';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import { LocalizationContext } from '../services/localization/localization-context';
import HomeIcon from '../assets/svg/HomeIcon.svg';
import ProfileIcon from '../assets/svg/UserIcon.svg';
import HomeScreen from '../screen/home-screen/home';
import EventScreen from '../screen/event-screen/event';

const Tab = createBottomTabNavigator();

function BottomTabs() {
  const { translations } = useContext(LocalizationContext);
  return (
    <Tab.Navigator
      initialRouteName="Home"
      tabBarOptions={{
        activeTintColor: '#971D36',
        inactiveTintColor: '#000000',
        labelStyle: {
          fontFamily: 'Roboto-Medium',
          fontSize: 10,
          lineHeight: 12,
          fontWeight: 'normal',
          fontStyle: 'normal',
          letterSpacing: 0.7,
          bottom: 5,
        },
      }}
    >
      <Tab.Screen
        name="Home"
        component={HomeScreen}
        options={{
          tabBarLabel: translations.HOME,
          tabBarIcon: ({ color }) => <HomeIcon fill={color} />,
        }}
      />
      <Tab.Screen
        name="Event"
        component={EventScreen}
        options={{
          tabBarLabel: translations.EVENT,
          tabBarIcon: ({ color }) => <ProfileIcon fill={color} />,
        }}
      />
    </Tab.Navigator>
  );
}
export default BottomTabs;
