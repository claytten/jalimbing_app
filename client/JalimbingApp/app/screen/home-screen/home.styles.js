import { StyleSheet, Dimensions } from 'react-native';

const { width } = Dimensions.get('window');
const halfWidth = width / 2 - 25;

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
    width: 70,
    height: 70,
  },
  view1: {
    width: '90%',
    height: 80,
    flexDirection: 'row',
    alignSelf: 'center',
    borderRadius: 5,
    borderWidth: 1,
    borderColor: '#f0f0f0',
    backgroundColor: '#ffffff',
    bottom: 40,
  },
  view2: {
    flex: 1,
    alignItems: 'center',
    justifyContent: 'center',
  },
  view3: {
    flex: 2,
    paddingTop: 10,
    paddingBottom: 10,
    paddingRight: 10,
    justifyContent: 'center',
  },
  viewDate: {
    flexDirection: 'row',
    alignItems: 'center',
    paddingTop: 5,
  },
  viewMenu: {
    paddingLeft: 20,
    paddingRight: 20,
    bottom: 20,
  },
  viewMenu1: {
    flex: 1,
    flexDirection: 'row',
    flexWrap: 'wrap',
    justifyContent: 'space-between',
  },
  viewMenuChild: {
    width: halfWidth,
    height: 120,
    marginBottom: 10,
    backgroundColor: '#ffffff',
    borderRadius: 5,
    borderWidth: 1,
    borderColor: '#f0f0f0',
  },
  textDesa: {
    paddingBottom: 5,
  },
  textDate: {
    marginLeft: 5,
  },
  textDaftarKategori: {
    fontSize: 20,
    fontWeight: 'bold',
    marginBottom: 10,
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
    width: 70,
    height: 70,
  },
  view1: {
    width: '90%',
    height: 80,
    flexDirection: 'row',
    alignSelf: 'center',
    borderRadius: 5,
    borderWidth: 1,
    borderColor: '#f0f0f0',
    backgroundColor: '#ffffff',
    bottom: 40,
  },
  view2: {
    flex: 1,
    alignItems: 'center',
    justifyContent: 'center',
  },
  view3: {
    flex: 2,
    paddingTop: 10,
    paddingBottom: 10,
    paddingRight: 10,
    justifyContent: 'center',
  },
  viewDate: {
    flexDirection: 'row',
    alignItems: 'center',
    paddingTop: 5,
  },
  viewMenu: {
    paddingLeft: 20,
    paddingRight: 20,
    bottom: 20,
  },
  viewMenu1: {
    flex: 1,
    flexDirection: 'row',
    flexWrap: 'wrap',
    justifyContent: 'space-between',
  },
  viewMenuChild: {
    width: halfWidth,
    height: 120,
    marginBottom: 10,
    backgroundColor: '#ffffff',
    borderRadius: 5,
    borderWidth: 1,
    borderColor: '#f0f0f0',
  },
  textDesa: {
    paddingBottom: 5,
  },
  textDate: {
    marginLeft: 5,
  },
  textDaftarKategori: {
    fontSize: 20,
    fontWeight: 'bold',
    marginBottom: 10,
  },
});
