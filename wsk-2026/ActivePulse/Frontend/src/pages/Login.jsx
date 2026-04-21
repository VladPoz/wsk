import {useEffect, useState} from "react";
import {useNavigate} from "react-router-dom";
import {PostLogin} from "../api/Response.jsx";

function Login() {

    const [userName, setUserName] = useState(null);
    const [result, setResult] = useState(null);
    const navigate = useNavigate();

    async function onSubmit(e) {
        e.preventDefault();
        const respose = await PostLogin(userName);
        console.log(respose.err);
        if (respose.err){
            setResult(Object.values(respose.err)[0]);
        }else{
            setResult(respose.message)
            localStorage.setItem('token', respose.token);
            localStorage.setItem('name', respose.name);
            localStorage.setItem('avatar', respose.avatar);
            navigate('/setup')
        }
    }

    useEffect(() => {
        if(localStorage.getItem('token')){
            navigate('/setup');
        }
    }, [])

    return(
        <div id="container">
            <img id="logo" src="/logo/logo.png"/>
            <div id="title">Login</div>
            <form className="link__form">
                <input className={'input'} type="text" onChange={(e) => {
                    setUserName(e.target.value)
                }}/>
                {result && (<p>{result}</p>)}
                <button type={"submit"} onClick={(e) => {
                    onSubmit(e)
                }} className="start-button" id="startBtn">Login</button>
            </form>
        </div>
    )
}

export default Login;