import { create } from 'apisauce';
import { API_URL } from '../../config/env';
import * as API from '../../config/api';

const api = create({
  baseURL: API_URL,
});

export const getHomeData = () => {
  return new Promise((resolve, reject) => {
    api
      .get(API.GET_HOME_DATA)
      .then((response) => {
        console.log(response);
        if (response.ok) resolve(response.data);
        else reject(response);
      })
      .catch((error) => {
        reject(error);
      });
  });
};

export const getDetailData = (id) => {
  return new Promise((resolve, reject) => {
    api
      .get(API.GET_DETAIL_DATA.replace(/{id}/, id))
      .then((response) => {
        if (response.ok) resolve(response.data);
        else reject(response);
      })
      .catch((error) => {
        reject(error);
      });
  });
};

export const getMapsData = () => {
  return new Promise((resolve, reject) => {
    api
      .get(API.GET_MAPS_DATA)
      .then((response) => {
        if (response.ok) resolve(response.data);
        else reject(response);
      })
      .catch((error) => {
        reject(error);
      });
  });
};
