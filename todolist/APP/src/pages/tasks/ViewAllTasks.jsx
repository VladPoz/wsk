import {useEffect, useState} from "react";
import {Link, useNavigate} from "react-router-dom";
import api from "../../api.jsx";
import AddModal from "../../modal/AddModal.jsx";

export default function ViewAllTasks(){
    const navigate = useNavigate();
    const [isLoading, setIsLoading] = useState(false);
    const [data, setData] = useState([]);
    const [modalOpen, setModalOpen] = useState(false);

    async function getAllMyTasks(){
        try{
            const res = await api.get('/task')
            setData(res.data);
        }catch (err){
            console.log(err.response?.data?.errors)
        }
    }

    useEffect(()=>{
        if(!localStorage.getItem('token')){
            navigate('/auth/signin');
        }else{
            getAllMyTasks();
            setIsLoading(true)
        }
    }, [modalOpen]);

    return(
        <>
            {isLoading && (
                <>
                    <h2>My tasks</h2>
                    <nav className={'form'}>
                        <button onClick={()=>{setModalOpen(true)}}>Add task</button>
                        {data.map(e=>(
                            <Link key={e.id} className={e.completed === 1 ? 'task_el completed' : 'task_el'} to={`/task/${e.id}`}>
                                <div className={'w100 hz_input'}>
                                    <p>{e.title}</p>
                                    <p className={'mini'}>{e.description}</p>
                                    <div className={'w100 hz_input'}>
                                        <p className={'mini fc-2'}>{e.count_completed}/{e.count}</p>
                                        <div className={'progressBar'}>
                                            <div style={{width: `${100-(e.count_completed*100/e.count)}%`}}></div>
                                        </div>
                                    </div>
                                </div>
                            </Link>
                        ))}
                    </nav>
                </>
            )}
            {modalOpen && (<AddModal setModalOpen={setModalOpen}/>)}
        </>
    )
}