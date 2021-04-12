import axios from 'axios';

const api = axios.create({
    baseURL: "http://192.168.56.102/kabum/server"
});

export default api;
