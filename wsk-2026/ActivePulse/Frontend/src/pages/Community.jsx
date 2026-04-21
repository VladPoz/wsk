import {useNavigate, useParams} from "react-router-dom";
import {useEffect, useState} from "react";
import {GetCommunityTask} from "../api/Response.jsx";


function Community(){

    const slug = useParams().slug
    const navigate = useNavigate();
    const [tasks, setTasks] = useState([]);
    const [error, setError] = useState(null);

    async function getTasks(){
        const data = await GetCommunityTask(slug);
        if(data.err){
            setError(Object.values(data.err)[0]);
        }else{
            setError(null);
            setTasks(data[1]);
        }
    }

    useEffect(()=>{
        if(!localStorage.getItem('token')){
            navigate('/')
        }else{
            getTasks();
        }
    }, [])

    if(error){
        return(
            <div id="container">
                <img id="logo" src="/logo/logo.png" alt="logo"/>
                <div id="title">Community: {slug}</div>
                <p>{error}</p>
            </div>
        )
    }

    return(
        <div id="container">
            <img id="logo" src="/logo/logo.png" alt={'logo'}/>
            <div id="title">Community: {slug}</div>
            <div className={'link__form'}>
                {tasks.length !== 0 ? (
                    tasks.map((item) => (
                        <>
                            <h3>{item.name}</h3>
                            <div className="d-flex justify-content-between">
                                <p>{item.description}</p>
                                <p>{item.count}</p>
                            </div>
                        </>
                    ))
                ) : null}
            </div>
        </div>
    )
}

export default Community;