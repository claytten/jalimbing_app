import { StyleSheet, Dimensions } from 'react-native';

const { width } = Dimensions.get('window');
const halfWidth = width / 2 - 25;

export const portraitStyles = StyleSheet.create({
  viewMenuChild: {
    width: halfWidth,
    height: 120,
    marginBottom: 10,
    backgroundColor: '#ffffff',
    borderRadius: 5,
    borderWidth: 1,
    borderColor: '#f0f0f0',
    padding: 10,
  },
  image: {
    width: 60,
    height: 82,
  },
  text: {
    fontSize: 13,
    fontWeight: '800',
  },
  text1: {
    position: 'absolute',
    bottom: 5,
    right: 15,
    fontSize: 18,
    fontWeight: '800',
    color: '#39c900',
  },
});

export const landscapeStyles = StyleSheet.create({
  viewMenuChild: {
    width: halfWidth,
    height: 120,
    marginBottom: 10,
    backgroundColor: '#ffffff',
    borderRadius: 5,
    borderWidth: 1,
    borderColor: '#f0f0f0',
    padding: 10,
  },
  image: {
    width: 60,
    height: 82,
  },
  text: {
    fontSize: 13,
    fontWeight: '800',
  },
  text1: {
    position: 'absolute',
    bottom: 5,
    right: 15,
    fontSize: 18,
    fontWeight: '800',
    color: '#39c900',
  },
});
