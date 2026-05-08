import {useEffect, useState} from "react";
import {api} from '../api.jsx';
import Header from '../assets/Header.jsx'
import {useNavigate} from "react-router-dom";

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
                navigate('/events')
            }).catch((error) => {
                setErrors(error.response.data.message);
                console.log(error.response.data.message)
            })
        }
    }

    return (
        <>
            <Header/>
            {loading ? (
                <form className={'form'} onSubmit={(e)=>{handleSubmit(e)}}>
                    <input type="text" placeholder="Username" onChange={(e) => setUsername(e.target.value)} required={true} minLength={3}/>
                    <input type="password" placeholder="Password" onChange={(e) => setPassword(e.target.value)} required={true} minLength={6} />
                    <input type="password" placeholder="Confirm Password" onChange={(e) => setConfirmPassword(e.target.value)} required={true} />
                    {errors && <p>{errors}</p>}
                    <input className={'btn'} type="submit" value="Register" />
                </form>
            ) : null}
        </>
    )
}

export default Register;