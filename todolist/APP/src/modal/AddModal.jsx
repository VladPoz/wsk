import {useState} from "react";
import api from "../api.jsx";


export default function AddModal({setModalOpen}) {
    const [title, setTitle] = useState("");
    const [description, setDescription] = useState("");
    const [priority, setPriority] = useState('low');
    const [type, setType] = useState('single');
    const [count, setCount] = useState(1);
    const [acceptCount, setAcceptCount] = useState(0);

    async function AddTask(e){
        e.preventDefault()
        try{
            const res = await api.post('/task', {
                title: title,
                description: description,
                priority: priority,
                type: type,
                count: count,
                count_completed: acceptCount,
            })
            setModalOpen(false);
        }catch(err){
            console.log(err.response.data)
        }
    }

    return (
        <div className={'modal__bg'} onClick={(e)=> {
            if(e.target === e.currentTarget) {
                setModalOpen(false);
            }
        }}>
            <div className="container d-flex" onClick={(e)=> {
                if(e.target === e.currentTarget) {
                    setModalOpen(false);
                }
            }}>
                <form className={"modal w100"} onSubmit={(e)=> {
                    AddTask(e)
                }}>
                    <h3>Add task</h3>
                    <div className={'w100 hz_input'}>
                        <label className={'mini'} htmlFor={'title'}>Title</label>
                        <input id={'title'} type="text" placeholder={"title"} onChange={(e)=>{setTitle(e.target.value)}}/>
                    </div>
                    <div className={'w100 hz_input'}>
                        <label className={'mini'} htmlFor={'description'}>Description</label>
                        <input id={'description'} type="text" placeholder={"description"} onChange={(e)=>{setDescription(e.target.value)}}/>
                    </div>
                    <div className={'w100 hz_input'}>
                        <label className={'mini'} htmlFor={'priority'}>Priority</label>
                        <select className={'in_el'} id={'priority'} onChange={(e)=>{setPriority(e.target.value)}}>
                            <option value="low">low</option>
                            <option value="medium">medium</option>
                            <option value="high">high</option>
                        </select>
                    </div>
                    <div className={'w100 hz_input'}>
                        <label className={'mini'} htmlFor={'type'}>Type</label>
                        <select className={'in_el'} id={'type'} onChange={(e)=>{setType(e.target.value)}}>
                            <option value="low">single</option>
                            <option value="multiple">multiple</option>
                        </select>
                    </div>
                    {type === 'multiple' && (
                        <>
                            <div className={'w100 hz_input'}>
                                <label className={'mini'} htmlFor={'count'}>Count</label>
                                <input id={'count'} type="number" defaultValue={1} min={1} placeholder={"count"} onChange={(e)=>{setCount(e.target.value)}}/>
                            </div>
                            <div className={'w100 hz_input'}>
                                <label className={'mini'} htmlFor={'accept__count'}>Accept count</label>
                                <input id={'accept__count'} type="number" defaultValue={0} min={0} placeholder={"accept count"} onChange={(e)=>{setAcceptCount(e.target.value)}}/>
                            </div>
                        </>
                    )}
                    <button className={'mt-16'}>Add task</button>
                </form>
            </div>
        </div>
    )
}