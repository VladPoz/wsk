import {useEffect, useState} from "react";
import {Link, useNavigate} from "react-router-dom";
import api from "../../api.jsx";

export default function ViewAllTasks(){
    const navigate = useNavigate();
    const [isLoading, setIsLoading] = useState(false);
    const [data, setData] = useState([])

    async function getAllMyTasks(){
        try{
            const res = await api.get('/task')
            setData(res.data);
        }catch (err){
            console.log(err.response.data)
        }
    }

    useEffect(()=>{
        if(!localStorage.getItem('token')){
            navigate('/auth/signin');
        }else{
            getAllMyTasks();
            setIsLoading(true)
        }
    }, []);

    return(
        <>
            {isLoading && (
                <>
                    <h2>My tasks</h2>
                    <nav className={'form'}>
                        {data.map(e=>(
                            <Link className={'in_el d-between'} to={`/task/${e.id}`}>
                                <div>
                                    <h3>{e.title}</h3>
                                    <p className={'fc-2 mini '}>{e.description}</p>
                                    <p className={'fc-2'}>{e.priority}</p>
                                </div>
                            </Link>
                        ))}
                    </nav>
                </>
            )}
        </>
    )
}