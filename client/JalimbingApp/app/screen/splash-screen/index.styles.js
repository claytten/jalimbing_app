import { StyleSheet, Dimensions } from 'react-native';

const { width } = Dimensions.get('window');

const Styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#ffffff',
    alignSelf: 'center',
    justifyContent: 'center',
  },
  image: {
    width,
    height: 310,
  },
});

export default Styles;
