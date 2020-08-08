import { StyleSheet, Dimensions } from 'react-native';

const { width } = Dimensions.get('window');

export const portraitStyles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#ffffff',
  },
  button: {
    width: width - 40,
    height: 30,
    borderBottomWidth: 0.3,
    flexDirection: 'row',
    alignItems: 'center',
    alignSelf: 'center',
    paddingLeft: 20,
    marginTop: 30,
  },
  textTitle: {
    fontSize: 20,
    fontWeight: 'bold',
    marginLeft: 20,
    marginTop: 30,
  },
});

export const landscapeStyles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#ffffff',
  },
  button: {
    width: width - 40,
    height: 30,
    borderBottomWidth: 0.3,
    flexDirection: 'row',
    alignItems: 'center',
    alignSelf: 'center',
    paddingLeft: 20,
    marginTop: 30,
  },
  textTitle: {
    fontSize: 20,
    fontWeight: 'bold',
    marginLeft: 20,
    marginTop: 30,
  },
});
