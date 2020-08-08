/* eslint-disable no-param-reassign */
import { types as t } from 'mobx-state-tree';

const SubImagesItem = t.model({
  id: t.optional(t.maybeNull(t.number), 0),
  sub_category_id: t.optional(t.maybeNull(t.number), 0),
  image_link: t.optional(t.maybeNull(t.string), ''),
  is_active: t.optional(t.maybeNull(t.number), 0),
  created_at: t.optional(t.maybeNull(t.string), ''),
  updated_at: t.optional(t.maybeNull(t.string), ''),
});

export const Images = t.optional(t.maybeNull(t.string), '');

const DetailData = t
  .model({
    subcategory: t.optional(
      t.maybeNull(
        t.model({
          id: t.optional(t.maybeNull(t.number), 0),
          category_id: t.optional(t.maybeNull(t.number), 0),
          name: t.optional(t.maybeNull(t.string), ''),
          description: t.optional(t.maybeNull(t.string), ''),
          schedule: t.optional(t.maybeNull(t.string), ''),
          link_youtube: t.optional(t.maybeNull(t.string), ''),
          instagram: t.optional(t.maybeNull(t.string), ''),
          whatsapp: t.optional(t.maybeNull(t.string), ''),
          is_active: t.optional(t.maybeNull(t.number), 0),
          created_at: t.optional(t.maybeNull(t.string), ''),
          updated_at: t.optional(t.maybeNull(t.string), ''),
          sub_category_images: t.optional(t.array(SubImagesItem), []),
        })
      ),
      {}
    ),
    images: t.optional(t.array(Images), []),
  })
  .actions((self) => ({
    addDetailData(data) {
      self.subcategory = data.subcategory;
      self.images = data.images;
    },
  }));

export default DetailData;
