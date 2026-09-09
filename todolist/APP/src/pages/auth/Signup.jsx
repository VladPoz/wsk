import {useEffect, useState} from "react";
import {Link, useNavigate} from "react-router-dom";
import api from "../../api.jsx";

export default function Signup(){
    const [passwordCheck, SetPasswordCheck] = useState(false)
    const [confirmPasswordCheck, SetConfirmPasswordCheck] = useState(false)
    const [name, setName] = useState('');
    const [password, setPassword] = useState('');
    const [confirmPassword, setConfirmPassword] = useState('');
    const [errName, setErrName] = useState('');
    const [errPassword, setErrPassword] = useState('');
    const [errConfirmPassword, setErrConfirmPassword] = useState('');
    const [isLoading, setIsLoading] = useState(false);
    const navigate = useNavigate()

    async function Register(e){
        e.preventDefault()
        try{
            const res = await api.post('/auth/register', {
                name: name,
                password: password,
                password_confirmation: confirmPassword,
            })

            localStorage.setItem('token', res.data.token);
            navigate('/')
        }catch (err){
            setErrName(err.response?.data?.errors?.name?.[0]);
            setErrPassword(err.response?.data?.errors?.password?.[0]);
            setErrConfirmPassword(err.response?.data?.errors?.password_confirmation?.[0]);
        }
    }

    useEffect(()=>{
        if(localStorage.getItem('token')){
            navigate('/');
        }else{
            setIsLoading(true);
        }
    })

    return(
        <>
            {isLoading & (
                <>
                    <h2>Sign up</h2>
                    <form className={"form"} onSubmit={(e)=>{Register(e)}}>
                        <div className={'w100 hz_input'}>
                            <label className={'mini'} htmlFor={'name'}>Username</label>
                            <input id={'name'} type="text" placeholder={'your username'} onChange={(e)=>{setName(e.target.value); setErrName('')}}/>
                            <p className={'mini error'}>{errName}</p>
                        </div>
                        <div className={'w100 hz_input'}>
                            <label className={'mini'} htmlFor={'password'}>Password</label>
                            <span className={'w100 form_password'}>
                                <input id={'password'} type={passwordCheck ? "text" : "password"} placeholder={'must be 8 characters'} onChange={(e)=>{setPassword(e.target.value); setErrPassword('')}}/>
                                <img onClick={()=>{SetPasswordCheck(!passwordCheck)}} src={passwordCheck ? "/icons/eye.svg" : "/icons/not_eye.svg"} alt=""/>
                            </span>
                            <p className={'mini error'}>{errPassword}</p>
                        </div>
                        <div className={'w100 hz_input'}>
                            <label className={'mini'} htmlFor={'confirm__password'}>Confirm password</label>
                            <span className={'w100 form_password'}>
                                <input id={'confirm__password'} type={confirmPasswordCheck ? "text" : "password"} placeholder={'repeat password'} onChange={(e)=>{setConfirmPassword(e.target.value); setErrConfirmPassword('')}}/>
                                <img onClick={()=>{SetConfirmPasswordCheck(!confirmPasswordCheck)}} src={passwordCheck ? "/icons/eye.svg" : "/icons/not_eye.svg"} alt=""/>
                            </span>
                            <p className={'mini error'}>{errConfirmPassword}</p>
                        </div>
                        <button className={'btn mt-16'} type={"submit"}>Sign up</button>
                    </form>
                    <p className={'auth__link'}>Already have an account? <Link className={'link'} to={'/auth/signin'}>Sign in</Link></p>
                </>
            )}
        </>
    )
}