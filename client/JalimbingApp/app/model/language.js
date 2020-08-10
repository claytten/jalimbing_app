/* eslint-disable no-param-reassign */
import { types as t } from 'mobx-state-tree';

const Language = t
  .model({
    languageChange: t.optional(t.maybeNull(t.string), 'EN'),
  })
  .actions((self) => ({
    changeLanguage(data) {
      self.languageChange = data;
    },
  }));

export default Language;
