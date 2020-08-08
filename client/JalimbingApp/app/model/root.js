import { types, onSnapshot } from 'mobx-state-tree';

import DetailData from './detail-data';
import MapsData from './maps-data';

const RootModel = types.model({
  detailData: DetailData,
  mapsData: MapsData,
});

const rootStore = RootModel.create({
  detailData: {},
  mapsData: { items: [] },
});

export default rootStore;

onSnapshot(rootStore, (snapshot) => console.log('Snapshot: ', snapshot.detailData));
