import {useEffect, useState} from "react";
import {Link, useNavigate} from "react-router-dom";
import {GetCommunityList} from "../api/Response.jsx";


function CommunityList(){

    const navigate = useNavigate();
    const [myCommunityList, setMyCommunityList] = useState([]);
    const [communityList, setCommunityList] = useState([]);
    const [error, setError] = useState(null);

    async function getData(){
        const data = await GetCommunityList();
        console.log(data);
        if(data.err){
            setError(Object.values(data.err));
        }else{
            setError(null);
            setMyCommunityList(data[0]);
            setCommunityList(data[1]);
        }
    }

    useEffect(()=>{
        if(!localStorage.getItem('token')){
            navigate('/')
        }else{
            getData()
        }
    }, [])

    if(error !== null){
        return(
            <div id="container">
                <img id="logo" src="/logo/logo.png"/>
                <div id="title">Community list</div>
                <p>{error}</p>
            </div>
        )
    }

    return(
        <div id="container">
            <img id="logo" src="/logo/logo.png"/>
            <div id="title">Community list</div>
            <div className="link__form">
                {myCommunityList.length !== 0 && (
                    <>
                        <div id="title">My</div>
                        {myCommunityList.map((item)=>(
                            <Link className="start-button" id="startBtn" key={item.id} to={`/community/${item.slug}`}>{item.slug}</Link>
                        ))}
                    </>
                )}
                {communityList.length !== 0 && (
                    <>
                        <div id="title">Other</div>
                        {communityList.map((item)=>(
                            <Link className="start-button" id="startBtn" key={item.id} to={`/community/${item.slug}`}>{item.slug}</Link>
                        ))}
                    </>
                )}
            </div>
        </div>
    )
}

export default CommunityList;