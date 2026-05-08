import Header from "../assets/Header.jsx";
import {useNavigate} from "react-router-dom";
import {useEffect, useState} from "react";
import {api} from "../api.jsx";

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
            navigate("/events");
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
            {loading ? (
                <form className={'form'} onSubmit={handleSubmit}>
                    <input type="text" placeholder="Username" onChange={(e)=>{setUsername(e.target.value)}} required={true} />
                    <input type="password" placeholder="Password" name="password" onChange={(e)=>{setPassword(e.target.value)}} required={true}/>
                    {error && <p>{error}</p>}
                    <input className={'btn'} type="submit" value="Login" />
                </form>
            ) : null}
        </>
    )
}

export default Login;