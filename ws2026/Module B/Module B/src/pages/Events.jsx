import Header from "../assets/Header.jsx";
import {useEffect, useState} from "react";
import {api} from "../api.jsx";
import {Link, useParams} from "react-router-dom";
import Loading from "../assets/loading.jsx";


function Events(){

    const [result, setResult] = useState('');
    const id = useParams().id;
    const [data, setData] = useState({});
    const [status, setStatus] = useState({});
    const [profile, setProfile] = useState(true);
    const [loading, setLoading] = useState(false);

    useEffect(() => {
        api.getEventById(id).then((response) => {
            setData(response.data);
        });
        api.getMyStatus(id).then((response) => {
            setStatus(response.data.data);
            setLoading(true);
        });
    },[result]);

    function handleRegistration(){
        api.registrations({event_id: id}).then((response) => {
            setResult(response.data.message);
        }).catch(() => {
            setProfile(false)
        })
    }

    function handleCancel(){
        api.registrationsCancle(status.register_id).then((response) => {
            setResult(response.data.message);
        })
    }

    return(
        <>
            <Header/>
            <div className={'container'}>
                {loading ? (

                    <div className={'mt-5 row g-3'}>
                        <div className={'col-lg-8 mb-3'}>
                            <div className={'bg-light h-100 rounded-3 p-3 shadow'}>
                                <h2 className={'text-center'}>{data.title}</h2>
                                <p className={'fs-4 mb-1'}>{data.description}</p>
                                <p className={'fs-5 mb-1'}>Локация: {data.location}</p>
                                <p className={'fs-5 mb-1'}>Дата: {data.event_date}</p>
                                <p className={'fs-5 mb-1'}>Вместимость: {data.capacity}</p>
                                <p className={'fs-5 mb-1'}>Зарегестрированно: {data.registrations_count}</p>
                                <div className={'mt-3'}>
                                    {(status === null || status?.status === 'CANCELLED') && (
                                        <>
                                            <button onClick={handleRegistration} className={'btn btn-dark'} type={'submit'}>Записаться</button>
                                            {!profile && (
                                                <Link className={'fs-5 link-danger'} to={'/participant'}><p className={'mt-1 mb-0'}>Профиль участника</p></Link>
                                            )}
                                        </>
                                    )}
                                    {status?.status === 'PENDING' && (
                                        <>
                                            <p>Ожидает подтверждения</p>
                                            <button onClick={handleCancel} className={'btn btn-dark'} type={'submit'}>Отменить</button>
                                        </>
                                    )}
                                    {status?.status === 'CONFIRMED' && (
                                        <>
                                            <p>Подтверждено</p>
                                            <button onClick={handleCancel} className={'btn btn-dark'} type={'submit'}>Отменить</button>
                                        </>
                                    )}
                                </div>
                            </div>
                        </div>
                        <div className="col-lg-4 mb-3">
                            <div className={'bg-dark text-light p-3 rounded-3 h-100'}>
                                <h2 className={'text-center'}>Участники</h2>
                                    {data.participants?.length > 0 ? (
                                        <ol>{
                                            data.participants.map((participant) => (
                                                <li key={participant.id} className={'fs-5'}>{participant.name}</li>
                                            ))}
                                        </ol>
                                    ) : (
                                        <p className={'text-center my-3 fs-5'}>Нету регестраций</p>
                                    )}
                            </div>
                        </div>
                    </div>
                ) : (<Loading/>)}
            </div>
        </>
    )
}

export default Events;