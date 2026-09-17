import {useState} from "react";
import api from "../api.jsx";
import {useNavigate} from "react-router-dom";


export default function AcceptModal({setModalOpen, id, type}){
    const navigate = useNavigate();

    async function DellTask(e){
        e.preventDefault()
        try{
            const res = await api.delete(`/task/${id}/del`);
            navigate('/')
        }catch(err){
            console.log(err.response.data)
        }
    }
    async function CompletedTask(e){
        e.preventDefault()
        try{
            const res = await api.patch(`/task/${id}/status`);
            setModalOpen(false);
        }catch(err){
            console.log(err.response.data)
        }
    }

    return (
        <div className={'modal__bg'} onClick={(e)=> {if(e.target === e.currentTarget){setModalOpen(false)}}}>
            <div className="container d-flex" onClick={(e)=> {if(e.target === e.currentTarget){setModalOpen(false)}}}>
                {type === 'delete' ? (
                    <form className={"modal w100"} onSubmit={(e)=> {DellTask(e)}}>
                        <h2 className={'mt-16'}>Are you sure?</h2>
                        <button type={"submit"} className={'mb-16 mt-16'}>Delete</button>
                    </form>
                ) : (
                    <form className={"modal w100"} onSubmit={(e)=> {CompletedTask(e)}}>
                        <h2 className={'mt-16'}>Are you sure?</h2>
                        <button type={"submit"} className={'mb-16 mt-16'}>Confirm</button>
                    </form>
                )}
            </div>
        </div>
    )
}