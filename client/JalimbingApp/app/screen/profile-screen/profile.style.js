import { StyleSheet, Dimensions } from 'react-native';

const { width } = Dimensions.get('window');
const halfWidth = width / 2 - 25;

export const portraitStyles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#ffffff',
  },
  map: {
    width,
    height: 300,
  },
  textTitle: {
    fontSize: 20,
    fontWeight: 'bold',
    marginBottom: 10,
    marginLeft: 20,
    marginTop: 20,
  },
  buttonSetting: {
    width,
    height: 30,
    borderTopWidth: 0.3,
    borderBottomWidth: 0.3,
    marginTop: 30,
    paddingLeft: 20,
  },
  textSetting: {
    fontSize: 16,
    fontWeight: 'bold',
  },
});

export const landscapeStyles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#ffffff',
  },
  map: {
    width,
    height: 300,
  },
  textTitle: {
    fontSize: 20,
    fontWeight: 'bold',
    marginBottom: 10,
    marginLeft: 20,
    marginTop: 20,
  },
  textSetting: {
    fontSize: 16,
    fontWeight: 'bold',
    marginBottom: 10,
  },
});
