import {useEffect, useState} from "react";
import {api} from '../api.jsx';
import Header from '../assets/Header.jsx'
import {useNavigate} from "react-router-dom";
import Loading from '../assets/loading';

function Register() {

    const [username, setUsername] = useState('');
    const [password, setPassword] = useState('');
    const [confirmPassword, setConfirmPassword] = useState('');
    const [errors, setErrors] = useState('');
    const [loading, setLoading] = useState(false);
    const navigate = useNavigate();

    useEffect(() => {
        if (localStorage.getItem('token')) {
            navigate('/')
        }else{
            setLoading(true)
        }
    }, []);

    function handleSubmit(e) {
        e.preventDefault();
        if (password === confirmPassword) {
            api.register({username: username, password: password, password_confirmation: confirmPassword}).then((response) => {
                localStorage.setItem('token', response.data.token);
                localStorage.setItem('role', response.data.role);
                navigate('/')
            }).catch((error) => {
                setErrors(error.response.data.message);
                console.log(error.response.data.message)
            })
        }
    }

    return (
        <>
            <Header/>
            <div className="row justify-content-center align-items-center vh-100">
                {loading ? (
                    <form className={'col-2'} onSubmit={(e)=>{handleSubmit(e)}}>
                        <input className={'form-control mb-3'} type="text" placeholder="Username" onChange={(e) => setUsername(e.target.value)} required={true} minLength={3}/>
                        <input className={'form-control mb-3'} type="password" placeholder="Password" onChange={(e) => setPassword(e.target.value)} required={true} minLength={6} />
                        <input className={'form-control mb-3'} type="password" placeholder="Confirm Password" onChange={(e) => setConfirmPassword(e.target.value)} required={true} />
                        {errors && <p className={'text-danger'}>{errors}</p>}
                        <input className={'btn btn-dark w-100'} type="submit" value="Регестрация" />
                    </form>
                ) : <Loading />}
            </div>
        </>
    )
}

export default Register;