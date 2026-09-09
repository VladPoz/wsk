import {useEffect, useState} from "react";
import {data, Link, useNavigate} from "react-router-dom";
import api from "../../api.jsx";

export default function Signin(){
    const [passwordCheck, SetPasswordCheck] = useState(false);
    const [name, setName] = useState('');
    const [password, setPassword] = useState('');
    const [errName, setErrName] = useState('');
    const [errPassword, setErrPassword] = useState('')
    const [errLogin, setErrLogin] = useState('')
    const navigate = useNavigate();

    async function login(e){
        e.preventDefault()
        try{
            const res = await api.post('/auth/login', {
                name: name,
                password: password,
            });
            localStorage.setItem('token', res.data.token)
            navigate('/')
        }catch (err){
            setErrName(err.response?.data?.errors?.name?.[0]);
            setErrPassword(err.response?.data?.errors?.password?.[0]);
            setErrLogin(err.response?.data?.err);
        }
    }

    useEffect(()=>{
        if (localStorage.getItem('token')){
           navigate('/')
        }
    }, [])

    return(
        <>
            <h2>Sign In</h2>
            <form className={"form"} onSubmit={(e)=>login(e)}>
                <div className={'w100 hz_input'}>
                    <label className={'mini'} htmlFor={'name'}>Username</label>
                    <input id={'name'} type="text" placeholder={"your username"} onChange={(e)=>{setName(e.target.value); setErrName(''); setErrLogin('')}}/>
                    <p className={'mini error'}>{errName}</p>
                </div>
                <div className={'w100 hz_input'}>
                    <label className={'mini'} htmlFor={'password'}>Password</label>
                    <span className={'w100 form_password'}>
                        <input id={'password'} type={passwordCheck ? "text" : "password"} placeholder={'must be 6 characters'} onChange={(e)=>{setPassword(e.target.value); setErrPassword(''); setErrLogin('')}}/>
                        <img onClick={()=>{SetPasswordCheck(!passwordCheck)}} src={passwordCheck ? "/icons/eye.svg" : "/icons/not_eye.svg"} alt=""/>
                    </span>
                    <p className={'mini error'}>{errPassword}</p>
                    <p className={'error'}>{errLogin}</p>
                </div>
                <button className={'btn mt-16'} type={"submit"}>Sing In</button>
            </form>
            <p className={'auth__link'}>Don’t have an account? <Link className={'link'} to={'/auth/signup'}>Sign up</Link></p>
        </>
    )
}