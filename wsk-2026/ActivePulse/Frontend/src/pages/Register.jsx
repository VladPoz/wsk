import {useEffect, useState} from "react";
import {GetAvatar, PostRegister} from "../api/Response.jsx";
import {useNavigate} from "react-router-dom";

function Register() {

    const [userName, setUserName] = useState(null);
    const [image, setImage] = useState([]);
    const [activeImage, setActiveImage] = useState(null);
    const [result, setResult] = useState(null);
    const navigate = useNavigate();

    async function onSubmit(e) {
        e.preventDefault();
        const respose = await PostRegister(userName, activeImage);
        console.log(respose.err);
        if (respose.err){
            setResult(Object.values(respose.err)[0]);
        }else{
            setResult(null)
            localStorage.setItem('token', respose.token)
            localStorage.setItem('name', respose.name)
            localStorage.setItem('avatar', activeImage)
            navigate('/setup')
        }
    }

    async function getData(){
        const data = await GetAvatar();
        setImage(data)
    }

    async function SetActiveImage(e){
        setActiveImage(`http://127.0.0.1:8000/storage/${e.target.value}`);
    }

    useEffect(() => {
        if(localStorage.getItem('token')){
            navigate('/setup');
        }else{
            getData()
        }
    }, []);

    return(
        <div id="container">
            <img id="logo" src="/logo/logo.png"/>
            <div id="title">Register</div>
            <form className="link__form">
                <input className={'input'} type="text" onChange={(e) => {
                    setUserName(e.target.value)
                }} placeholder={'Name'}/>
                <figure className="avatar__form">
                    {image && (
                        image.map((item, index) => (
                            <div>
                                <input className={'hide'} type="radio" id={index} value={item} name={'1'} onChange={(e)=>{SetActiveImage(e)}}/>
                                <label htmlFor={index} id={index}>
                                    <img className={activeImage === `http://127.0.0.1:8000/storage/${item}` ? 'avatar__active' : null} src={`http://127.0.0.1:8000/storage/${item}`} alt={index}/>
                                </label>
                            </div>
                        ))
                    )}
                </figure>
                {result && (<p>{result}</p>)}
                <button type={"submit"} onClick={(e) => {
                    onSubmit(e)
                }} className="start-button" id="startBtn">Register
                </button>
            </form>
        </div>
    )
}

export default Register;