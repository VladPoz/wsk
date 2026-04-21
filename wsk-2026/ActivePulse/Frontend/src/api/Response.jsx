import axios from "axios";

axios.defaults.baseURL = 'http://localhost:8000/api';

axios.defaults.headers = {
    'Authorization': `Bearer ${localStorage.getItem('token')}`,
    Accept: 'application/json',
}

export const PostRegister = async (userName, activeImage) => {
    try{
        const response = await axios.post('/register', {
            'name': userName,
            'avatar': activeImage,
            'is_admin': 0,
        });
        return response.data;
    }catch(err){
        return {'err': err.response?.data?.errors};
    }
}

export const PostLogin = async (userName) => {
    try{
        const response = await axios.post('/login', {
            'name': userName,
        })
        return response.data;
    }catch(err){
        return {'err': err.response?.data?.errors};
    }
}

export const PostLogout = async () => {
    try{
        const response = await axios.post('/logout', {})
        return response.data;
    }catch(err){
        return null;
    }
}

export const GetAvatar = async () => {
    try{
        const response = await axios.get('/avatar');
        console.log(response.data);
        return response.data;
    }catch(err){
        return null;
    }
}

export const PostCommunityStore = async (slug) => {
    try{
        const response = await axios.post('/community/store', {
            'slug': slug,
        });
        return response.data;
    }catch(err){
        return {'err': err.response?.data?.message};
    }
}

export const PostCommunitiesSignIn = async (slug) => {
    try{
        const response = await axios.post('/community/signin', {
            'slug': slug,
        })
        return response.data;
    }catch(err){
        return {'err': err.response?.data?.errors};
    }
}

export const UserJoinedCommunity = async (slug) => {
    try{
        const response = await axios.post(`/community/${slug}/join`, {})
        return response.data;
    }catch(err){
        return {'err': err.response?.data?.errors};
    }
}

export const GetCommunityList = async () => {
    try{
        const response = await axios.get('/community/list');
        return response.data;
    }catch(err){
        return {'err': err.response?.data?.errors};
    }
}

export const GetCommunityTask = async (slug) => {
    try{
        const response = await axios.get(`/community/${slug}/task`);
        return response.data;
    }catch(err){
        return {'err': err.response?.data?.errors};
    }
}