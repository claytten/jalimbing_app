import React from 'react';
import { StyleSheet, Modal, View, Image, TouchableWithoutFeedback, Dimensions } from 'react-native';

const Regular = ({ visible, onClose, imageUri }) => {
  return (
    <Modal visible={visible} onRequestClose={onClose} transparent animationType="fade">
      <TouchableWithoutFeedback onPress={onClose}>
        <View style={styles.container}>
          <Image source={{ uri: imageUri }} style={styles.image} resizeMode="cover" />
        </View>
      </TouchableWithoutFeedback>
    </Modal>
  );
};

export default Regular;

const { width } = Dimensions.get('window');
const styles = StyleSheet.create({
  container: {
    flex: 1,
    alignItems: 'center',
    justifyContent: 'center',
    backgroundColor: '#00000088',
  },
  image: {
    width: width - 40,
    height: 200,
  },
});
