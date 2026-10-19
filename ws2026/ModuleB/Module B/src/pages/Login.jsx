import Header from "../assets/Header.jsx";
import {useNavigate} from "react-router-dom";
import {useEffect, useState} from "react";
import {api} from "../api.jsx";
import Loading from "../assets/loading.jsx";

function Login() {

    const [username, setUsername] = useState("");
    const [password, setPassword] = useState("");
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(null);
    const navigate = useNavigate();

    function handleSubmit(e){
        e.preventDefault();
        api.login({username: username, password: password}).then((response) => {
            localStorage.setItem("token", response.data.token);
            localStorage.setItem('role', response.data.role);
            navigate("/");
        }).catch((err) => {
            setError(err.response.data.message);
        })
    }

    useEffect(() => {
        if (localStorage.getItem('token')) {
            navigate('/')
        }else{
            setLoading(true);
        }
    }, []);

    return (
        <>
            <Header/>
            <div className="row justify-content-center align-items-center vh-100">
                {loading ? (
                    <form className={'col-2'} onSubmit={handleSubmit}>
                        <input className={'form-control mb-3'} type="text" placeholder="Username" onChange={(e)=>{setUsername(e.target.value)}} required={true} />
                        <input className={'form-control mb-3'} type="password" placeholder="Password" name="password" onChange={(e)=>{setPassword(e.target.value)}} required={true}/>
                        {error && <p className={'text-danger mb-3'}>{error}</p>}
                        <input className={'btn btn-dark w-100'} type="submit" value="Войти" />
                    </form>
                ) : <Loading/>}
            </div>
        </>
    )
}

export default Login;