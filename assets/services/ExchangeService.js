import axios from 'axios';

const basePath = 'http://127.0.0.1:8000';

const options = {
  method: 'GET',
  url: 'https://currency-converter-by-api-ninjas.p.rapidapi.com/v1/convertcurrency',
  params: {},
  headers: {
    'X-RapidAPI-Key': '034754b689msh3d0c957f2d510eap15c9ccjsn0ebc80997f5d',
    'X-RapidAPI-Host': 'currency-converter-by-api-ninjas.p.rapidapi.com'
  }
};


export const exchangeCurrency = (params) => {
  try {
    options.params = params
    return axios.request(options).then((res) => res.data);
  } catch (e) {
    console.log(e)
  } finally {
    
  }

};

export const addToLog = (payload) => {
  try {
    const URL = `${basePath}/save/log`;
    return axios.post(URL, payload).then((res) => res.data);
  } catch (e) {
    console.log(e)
  }

};

export const logs = () => {
  const URL = `${basePath}/get/log`;
  return axios.get(URL).then((res) => res);
};
