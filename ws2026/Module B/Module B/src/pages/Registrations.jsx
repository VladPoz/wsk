import Header from "../assets/Header.jsx";
import {useNavigate} from "react-router-dom";
import {useEffect, useState} from "react";
import Loading from "../assets/loading.jsx";
import {api} from "../api.jsx";
import {Link} from "react-router-dom";


function Registrations(){

    const navigate = useNavigate();
    const [loading, setLoading] = useState(true);
    const [data, setData] = useState([]);

    useEffect(() => {
        if (!localStorage.getItem("token")) {
            navigate("/login");
        }else{
            api.getMyRegistration().then((res)=>{
                setData(res.data.data);
                console.log(res.data.data);
                setLoading(false);
            })
        }
    }, [])

    return(
        <>
            <Header />
            {loading ? (<Loading/>) : (
                <div className={'container'}>
                    <div className={'my-4'}>
                        {data.map((item,index)=>(
                            <Link key={index} className={'text-decoration-none'} to={`/events/${item.event.id}`}>
                                <div className={'bg-dark text-light p-3 rounded-3 mb-3'}>
                                    <p className={'mb-3'}>{item.event.title}</p>
                                    <p>Дата: {item.event.event_date}</p>
                                    <p className={'mb-0'}>Статус: {item.status}</p>
                                </div>
                            </Link>
                        ))}
                    </div>
                </div>
            )}
        </>
    )
}

export default Registrations;