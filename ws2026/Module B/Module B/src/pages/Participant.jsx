import Header from "../assets/Header.jsx";
import {useEffect, useState} from "react";
import Loading from "../assets/loading.jsx";
import {api} from "../api.jsx";
import {useNavigate} from "react-router-dom";


function Participant(){

    const navigate = useNavigate();
    const [loading, setLoading ] = useState(false);
    const [name, setName] = useState("");
    const [phone, setPhone] = useState("");
    const [error, setError] = useState(null);
    const [hasParticipant, setHasParticipant] = useState(false);
    const [data, setData] = useState({});
    const [result, setResult] = useState('');

    useEffect(() => {
        if(!localStorage.getItem("token")){
            navigate("/login");
        }else{
            api.getMyParticipant().then((response)=>{
                setHasParticipant(true)
                setData(response.data)
                setName(response.data.name);
                setPhone(response.data.phone);
                setLoading(true);
            }).catch(()=>{
                setLoading(false);
            });
        }
    }, [result]);

    function handleCreate(e){
        e.preventDefault();
        api.participants({name: name, phone: phone}).then((response)=>{
            setResult(response.data.message);
        }).catch(err=>{
            setError(Object.values(err.response.data.errors)[0])
        })
    }

    function handleUpdate(e){
        e.preventDefault();
        setResult('')
        api.participantsUpdate(data.id, {name: name, phone: phone}).then((response)=>{
            setResult(response.data.message);
            setError('')
        }).catch(err=>{
            setError(Object.values(err.response.data.errors)[0])
        })
    }

    return(
        <>
            <Header/>
            {!loading ? (
                <Loading/>
            ) : (
                <>
                    <div className="container">
                        <div className="row my-4 g-3">
                            <div className="col-lg-6">
                                <div className="p-3 h-100 bg-dark text-light rounded-3 d-flex flex-column justify-content-center g-5">
                                    <p className={'fs-5'}>Имя: {data.name}</p>
                                    <p className={'fs-5 mb-0'}>Телефон: {data.phone}</p>
                                </div>
                            </div>
                            <div className={'col-lg-6'}>
                                {hasParticipant ? (
                                    <form onSubmit={(e)=>{handleUpdate(e)}} className={'h-100 p-3 rounded-3 shadow d-flex flex-column'}>
                                        <input className={'form-control mb-3'} type="text" placeholder="Name" onChange={(e)=>{setName(e.target.value)}} defaultValue={data.name} required={true} minLength={2} maxLength={255} />
                                        <input className={'form-control mb-3'} type="tel" placeholder="Phone" onChange={(e)=>{setPhone(e.target.value)}} defaultValue={data.phone} required={true} maxLength={20} pattern={'[\\d\\s\\+\\(\\)\\-]*'} />
                                        {error && <p className={'text-danger mb-3'}>{error}</p>}
                                        <input className={'btn btn-dark w-100'} type="submit" value="Обновить" />
                                    </form>
                                ) : (
                                    <form onSubmit={(e)=>{handleCreate(e)}} className={'h-100 p-3 rounded-3 shadow d-flex flex-column'}>
                                        <input className={'form-control mb-3'} type="text" placeholder="Name" onChange={(e)=>{setName(e.target.value)}} required={true} />
                                        <input className={'form-control mb-3'} type="tel" placeholder="Phone" onChange={(e)=>{setPhone(e.target.value)}} required={true}/>
                                        {error && <p className={'text-danger mb-3'}>{error}</p>}
                                        <input className={'btn btn-dark w-100'} type="submit" value="Создать" />
                                    </form>
                                )}
                            </div>
                        </div>
                    </div>
                </>
            )}
        </>
    )
}

export default Participant;