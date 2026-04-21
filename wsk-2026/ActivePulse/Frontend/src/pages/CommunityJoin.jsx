import {useNavigate, useParams} from "react-router-dom";
import {UserJoinedCommunity} from "../api/Response.jsx";
import {useEffect, useState} from "react";

function CommunityJoin(){

    const slug = useParams().slug;
    const [result, setResult] = useState(null);
    const navigate = useNavigate();

    async function handleSubmit(e){
        e.preventDefault();
        const response = await UserJoinedCommunity(slug);
        if(response.err){
            setResult(response.err);
            // navigate(`/community/${slug}`);
        }else{
            setResult(response);
            navigate(`/community/${slug}`);
        }
    }

    useEffect(()=>{
        if(!localStorage.getItem('token')){
            navigate('/')
        }
    }, [])

    return (
        <div id="container">
            <img id="logo" src="/logo/logo.png"/>
            <div id="title">Community: {slug}</div>
            {result && <p>{result}</p>}
            <form className="link__form">
                <button type={"submit"} onClick={(e)=>{handleSubmit(e)}} className="start-button" id="startBtn">Join</button>
            </form>
        </div>
    )
}

export default CommunityJoin;