import {useEffect, useState} from "react";
import {PostCommunityStore} from "../api/Response.jsx";
import {useNavigate} from "react-router-dom";


function CommunityCreate() {

    const [result, setResult] = useState(null);
    const [slug, setSlug] = useState(null);
    const navigate = useNavigate();

    async function onSubmit(e) {
        e.preventDefault();
        const response = await PostCommunityStore(slug);
        console.log(slug)
        if (!response.err){
            setResult(null)
            navigate('/setup')
        }
        setResult(response.err);
    }

    useEffect(()=>{
        if(!localStorage.getItem('token')){
            navigate('/')
        }
    }, [])

    return(
        <div id="container">
            <img id="logo" src="/logo/logo.png"/>
            <div id="title">Store</div>
            <form className="link__form">
                <input className={'input'} type="text" onChange={(e)=>{setSlug(e.target.value)}} placeholder={'Name'}/>
                {result && (<p>{result}</p>)}
                <button type={"submit"} className="start-button" id="startBtn" onClick={(e)=>{onSubmit(e)}}>Create</button>
            </form>
        </div>
    )
}

export default CommunityCreate;