import { StyleSheet, Dimensions } from 'react-native';

const { width } = Dimensions.get('window');
const oneThirdWidth = width / 3 - 23;
const halfWidth = width / 2 - 30;

export const portraitStyles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#f7f7f7',
  },
  image: {
    width,
    height: 250,
  },
  image1: {
    width: '100%',
    height: '100%',
  },
  imageMedsos: {
    width: 35,
    height: 35,
  },
  view1: {
    width: '90%',
    minHeight: 80,
    alignSelf: 'center',
    borderRadius: 5,
    borderWidth: 1,
    borderColor: '#f0f0f0',
    backgroundColor: '#ffffff',
    bottom: 40,
    padding: 10,
  },
  view2: {
    width: oneThirdWidth,
    height: oneThirdWidth,
    marginLeft: 20,
  },
  viewMenu: {
    bottom: 20,
  },
  viewMenuMedsos: {
    flex: 1,
    flexDirection: 'row',
    flexWrap: 'wrap',
    justifyContent: 'space-between',
    paddingLeft: 20,
    paddingRight: 20,
  },
  viewMenuChild: {
    width: halfWidth,
    height: 70,
    marginBottom: 10,
    backgroundColor: '#ffffff',
    borderRadius: 5,
    borderWidth: 1,
    borderColor: '#f0f0f0',
    padding: 10,
    flexDirection: 'row',
  },
  viewMenuChild1: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
  },
  viewVideo: {
    width: '100%',
    alignSelf: 'center',
    paddingLeft: 20,
    paddingRight: 20,
    marginTop: 20,
  },
  viewMenuChild2: {
    flex: 2,
    justifyContent: 'center',
  },
  textTitle: {
    paddingBottom: 5,
  },
  textDaftarKategori: {
    fontSize: 20,
    fontWeight: 'bold',
    marginBottom: 10,
    marginLeft: 20,
  },
  player: {
    alignSelf: 'stretch',
    marginVertical: 10,
  },
});

export const landscapeStyles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#f7f7f7',
  },
  image: {
    width,
    height: 250,
  },
  image1: {
    width: '100%',
    height: '100%',
  },
  imageMedsos: {
    width: 35,
    height: 35,
  },
  view1: {
    width: '90%',
    minHeight: 80,
    alignSelf: 'center',
    borderRadius: 5,
    borderWidth: 1,
    borderColor: '#f0f0f0',
    backgroundColor: '#ffffff',
    bottom: 40,
    padding: 10,
  },
  view2: {
    width: oneThirdWidth,
    height: oneThirdWidth,
    marginLeft: 20,
  },
  viewMenu: {
    bottom: 20,
  },
  viewMenuMedsos: {
    flex: 1,
    flexDirection: 'row',
    flexWrap: 'wrap',
    justifyContent: 'space-between',
    paddingLeft: 20,
    paddingRight: 20,
  },
  viewMenuChild: {
    width: halfWidth,
    height: 70,
    marginBottom: 10,
    backgroundColor: '#ffffff',
    borderRadius: 5,
    borderWidth: 1,
    borderColor: '#f0f0f0',
    padding: 10,
    flexDirection: 'row',
  },
  viewMenuChild1: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
  },
  viewVideo: {
    width: '100%',
    alignSelf: 'center',
    paddingLeft: 20,
    paddingRight: 20,
    marginTop: 20,
  },
  viewMenuChild2: {
    flex: 2,
    justifyContent: 'center',
  },
  textTitle: {
    paddingBottom: 5,
  },
  textDaftarKategori: {
    fontSize: 20,
    fontWeight: 'bold',
    marginBottom: 10,
    marginLeft: 20,
  },
  player: {
    alignSelf: 'stretch',
    marginVertical: 10,
  },
});
