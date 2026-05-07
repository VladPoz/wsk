import {useState} from "react";
import {api} from '../api.jsx';

function Register() {

    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [confirmPassword, setConfirmPassword] = useState('');

    function handleSubmit(e) {
        e.preventDefault();
        api.register({email: email, password}).then((response) => {})
    }

    return (
        <>
            <form className={'form'} onSubmit={(e)=>{handleSubmit(e)}}>
                <input type="text" placeholder="Email" name="email" onChange={(e) => setEmail(e.target.value)} />
                <input type="text" placeholder="Password" name="password" typeof="password" onChange={(e) => setPassword(e.target.value)} />
                <input type="text" placeholder="Confirm Password" name="confirm" onChange={(e) => setConfirmPassword(e.target.value)} />
                <input className={'btn'} type="submit" value="Register" />
            </form>
        </>
    )
}

export default Register;