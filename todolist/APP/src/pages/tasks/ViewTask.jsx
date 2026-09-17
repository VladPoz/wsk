import {useEffect, useState} from "react";
import {useNavigate, useParams} from "react-router-dom";
import api from "../../api.jsx";
import AcceptModal from "../../modal/AcceptModal.jsx";


export default function ViewTask(){
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState("");
    const [type, setType] = useState("");
    const [data, setData] = useState({});
    const [percent, setPercent] = useState(0);
    const id = useParams();
    const navigate = useNavigate();
    const [modalOpen, setModalOpen] = useState(false);
    const [count, setCount] = useState(1);
    const [update, setUpdate] = useState(true);

    async function getTask(){
        try{
            const res = await api.get(`/task/${id.id}`)
            setData(res.data)
            console.log(res.data);
            setIsLoading(true);
            setPercent(res.data.count_completed*100/res.data.count);
        }catch (err){
            setError(err.response?.data?.message)
        }
    }

    async function plusCount(){
        try{
            const res = await api.patch(`/task/${id.id}}/count/plus`, {count: count})
            setUpdate(!update)
        }catch (err){
            console.log(err.response?.data?.message)
        }
    }

    async function minusCount(){
        try{
            const res = await api.patch(`/task/${id.id}/count/minus`, {count: count})
            setUpdate(!update)
        }catch (err){
            console.log(err.response?.data?.message)
        }
    }

    useEffect(()=>{
        if(!localStorage.getItem('token')){
            navigate('/auth/signin')
        }else{
            getTask();
        }
    }, [modalOpen, update])

    return(
        <>
            {isLoading ? (
                <div className={'form d-start'}>
                    <h2>{data.title}</h2>
                    <p>{data.description}</p>
                    <div className={'w100 hz_input'}>
                        <p className={'mini'}>{data.count_completed}/{data.count}</p>
                        <div className={'progressBar'}>
                            <div style={{width: `${100-percent}%`}}></div>
                        </div>
                    </div>
                    {data.type === 'multiple' && data.completed !== 1 && (
                        <div className={'w100 hz_input'}>
                            <div className={'d-flex w100'}>
                                <button className={'min_btn'} onClick={()=>{minusCount()}}>-</button>
                                <input type="number" min={1} defaultValue={count} onChange={(e)=>{setCount(e.target.value)}}/>
                                <button className={'min_btn'} onClick={()=>{plusCount()}}>+</button>
                            </div>
                        </div>
                    )}
                    <button className={'mt-16'} onClick={()=>{setModalOpen(true); setType('completed')}} disabled={data.type !== 'single' && data.count_completed < data.count}>{data.completed === 0 ? 'Not Completed' : 'Completed'}</button>
                    <button onClick={()=>{setModalOpen(true); setType('delete')}}>Delete</button>
                </div>
            ) : (<h2>{error}</h2>)}
            {modalOpen && (<AcceptModal setModalOpen={setModalOpen} id={id.id} type={type}/>)}
        </>
    )
}