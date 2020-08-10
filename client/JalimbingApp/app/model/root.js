import { types, onSnapshot } from 'mobx-state-tree';

import DetailData from './detail-data';
import MapsData from './maps-data';
import Language from './language';

const RootModel = types.model({
  language: Language,
  detailData: DetailData,
  mapsData: MapsData,
});

const rootStore = RootModel.create({
  language: {},
  detailData: {},
  mapsData: { items: [] },
});

export default rootStore;

onSnapshot(rootStore, (snapshot) => console.log('Snapshot: ', snapshot.language));
