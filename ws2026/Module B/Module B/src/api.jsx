import axios from "axios";

axios.defaults.baseURL = 'http://127.0.0.1:8000/api/v1/';
axios.defaults.headers = {
    'Accept': 'application/json',
    'Content-Type': 'application/json',
    'Authorization': `Bearer ${localStorage.getItem('token')}`,
}

export const api = {
    login: (data) => {
        return axios({
            method: 'POST',
            url: '/auth/login',
            data: data,
        })
    },
    register: (data) => {
        return axios({
            method: 'POST',
            url: '/auth/register',
            data: data,
        })
    },
    logout: () => {
        return axios({
            method: 'POST',
            url: '/auth/logout',
        })
    },
    getEventsList: (data) => {
        return axios({
            method: 'GET',
            url: '/events',
            data: data,
        })
    },
}