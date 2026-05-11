import axios from "axios";
import {data} from "react-router-dom";

axios.defaults.baseURL = 'http://127.0.0.1:8000/api/v1/';
axios.defaults.headers = {
    'Accept': 'application/json',
    'Content-Type': 'application/json',
}

axios.interceptors.request.use((config) => {
    const token = localStorage.getItem('token');
    if (token) {
        config.headers['Authorization'] = `Bearer ${token}`;
    }
    return config;
});

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
            params: data,
        })
    },
    getEventById: (id) => {
        return axios({
            method: 'GET',
            url: `/events/${id}`,
        })
    },
    getMyStatus: (id) => {
        return axios({
            method: 'GET',
            url: `/events/${id}/my-status`,
        })
    },
    registrations: (data) => {
        return axios({
            method: 'POST',
            url: '/registrations',
            data: data,
        })
    },
    registrationsCancle: (id) => {
        return axios({
            method: 'PATCH',
            url: `/registrations/${id}/cancel`,
        })
    },
    getMyParticipant: () => {
        return axios({
            method: 'GET',
            url: '/my-participant',
        })
    },
    participants: (data) => {
        return axios({
            method: 'POST',
            url: '/participants',
            data: data,
        })
    },
    participantsUpdate: (id, data) => {
        return axios({
            method: 'PUT',
            url: `/participants/${id}`,
            data: data,
        })
    },
    getMyRegistration: () => {
        return axios({
            method: 'GET',
            url: '/my-registrations',
        })
    }
}