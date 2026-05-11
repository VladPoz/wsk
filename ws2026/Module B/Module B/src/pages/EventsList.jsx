import Header from "../assets/Header.jsx";
import {useEffect, useState} from "react";
import {api} from "../api.jsx";
import {Link, useNavigate} from "react-router-dom";
import Loading from "../assets/loading.jsx";

function EventsList() {

    const [search, setSearch] = useState('');
    const [date, setDate] = useState('');
    const [page, setPage] = useState(1);
    const [events, setEvents] = useState([]);
    const navigate = useNavigate();
    const [loading, setLoading] = useState(false);

    useEffect(() => {
        if (!localStorage.getItem("token")) {
            navigate('/login');
        };
    }, []);

    useEffect(() => {
        const timer = setTimeout(() => {
            setLoading(false);
            api.getEventsList({search: search, date: date, page: page}).then((response) => {
                setEvents(response.data.data)
                setLoading(true);
            }).catch((err) => {
                console.log(err.response.data.message);
            })
        }, 400);


        return () => clearTimeout(timer)
    }, [search, date, page]);

    return(
        <>
            <Header/>
            <div className="container">
                <div className={'my-3 row g-3'}>
                    <div className="col-10">
                        <input className={'form-control'} type="text" placeholder={'Поиск'} onChange={(e)=>{setSearch(e.target.value)}}/>
                    </div>
                    <div className="col-2">
                        <input className={'form-control'} type="date" onChange={(e)=>{setDate(e.target.value)}}/>
                    </div>
                </div>
                {loading ? (
                    <div className={'row g-3'}>
                        {events ? (events.map((item, index)=>(
                            <div key={index} className={'col-xl-3 col-lg-4 col-md-6'}>
                                <Link className={'nav-link'} to={`/events/${item.id}`}>
                                    <div className={"bg-dark text-light p-3 rounded-3 form-el"}>
                                        <p>{item.title}</p>
                                        <p>Локация: {item.location}</p>
                                        <p>Дата: {item.event_date}</p>
                                        <p>Вместимость: {item.capacity}</p>
                                        <p className={'mb-0'}>Зарегестрированно: {item.registrations_count}</p>
                                    </div>
                                </Link>
                            </div>
                        ))) : null}
                    </div>
                ) : (<Loading/>)}
            </div>
        </>
    )
}

export default EventsList;