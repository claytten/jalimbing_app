/* eslint-disable no-param-reassign */
import { types as t } from 'mobx-state-tree';

export const coordinates = t.optional(t.maybeNull(t.number), 0);

const MapsItem = t.model({
  type: t.optional(t.maybeNull(t.string), ''),
  properties: t.optional(
    t.maybeNull(
      t.model({
        popupContent: t.optional(
          t.maybeNull(
            t.model({
              id: 2,
              namePlace: t.optional(t.maybeNull(t.string), ''),
            }),
            {}
          )
        ),
      })
    ),
    {}
  ),
  geometry: t.optional(
    t.maybeNull(
      t.model({
        type: t.optional(t.maybeNull(t.string), ''),
        coordinates: t.optional(t.array(coordinates), []),
      })
    ),
    {}
  ),
});

const MapsData = t
  .model({
    items: t.optional(t.array(MapsItem), []),
  })
  .actions((self) => ({
    addMapsData(data) {
      self.items.push(data);
    },
    deleteMapsData() {
      self.items = [];
    },
  }));

export default MapsData;
