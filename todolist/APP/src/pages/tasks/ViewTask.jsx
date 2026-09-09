import {useEffect, useState} from "react";
import {useNavigate, useParams} from "react-router-dom";
import api from "../../api.jsx";


export default function ViewTask(){
    const [isLoading, setIsLoading] = useState(false);
    const [data, setData] = useState({})
    const id = useParams();
    const navigate = useNavigate();

    async function getTask(){
        try{
            const res = await api.get(`/task/${id.id}`)
            setData(res.data)
            console.log(res.data)
        }catch (err){
            console.log(err.response?.data)
        }
    }

    useEffect(()=>{
        if(!localStorage.getItem('token')){
            navigate('/auth/signin')
        }else{
            getTask();
            setIsLoading(true);
        }
    }, [])

    return(
        <>
            {isLoading && (
                <>
                    <h2 className={'mb-32'}>{data.title}</h2>
                    <p>Description: {data.description}</p>
                    <p className={'mt-16'}>Priority: {data.priority}</p>
                    <p className={'mt-16'}>Type: {data.type}</p>
                    <p className={'mt-16'}>Count: {data.count}</p>
                    <p className={'mt-16'}>Count completed: {data.count_completed}</p>
                    <p className={'mt-16'}>Completed: {data.completed == 0 ? 'No' : 'Yes'}</p>
                    <button className={'mt-32'}>Edit</button>
                    <button className={'mt-16'}>Delete</button>
                </>
            )}
        </>
    )
}