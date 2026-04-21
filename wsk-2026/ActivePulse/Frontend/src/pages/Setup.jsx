import {Link, useNavigate} from "react-router-dom";
import {useEffect, useState} from "react";
import {PostCommunitiesSignIn, PostCommunityStore, PostLogout} from "../api/Response.jsx";


function Setup() {
    const [isAuth, setIsAuth] = useState(false);
    const [slug, setSlug] = useState(null);
    const [errors, setErrors] = useState(null);
    const navigate = useNavigate();

    useEffect(() => {
        if(localStorage.getItem("token")) {
            setIsAuth(true);
        }
    }, []);

    async function onSubmit(e) {
        e.preventDefault();
        const respose = await PostLogout()
        localStorage.removeItem('token');
        localStorage.removeItem('name');
        localStorage.removeItem('avatar');
        navigate('/');
    }

    async function onFindSubmit(e) {
        e.preventDefault();
        const findResponse = await PostCommunitiesSignIn(slug)
        if(!findResponse.err){
            setErrors(null)
            navigate(`/community/${slug}/join`)
        }else{
            setErrors(Object.values(findResponse.err))
        }

    }

    if(isAuth) {
        return (
            <div id="container">
                <img id="logo" src="/logo/logo.png"/>
                <div id="title">Setup</div>
                <nav className="link__form">
                    <Link to={'/community/store'} className="start-button" id="startBtn">Store</Link>
                    <Link to={'/community/list'} className="start-button" id="startBtn">My community</Link>
                    {errors && <p>{errors}</p>}
                    <form className={'form'}>
                        <input className={'input'} type="text" onChange={(e) => {
                            setSlug(e.target.value)
                        }} placeholder={'Slug'}/>
                        <button type={"submit"} className="start-button" id="startBtn" onClick={(e) => onFindSubmit(e)}>Find</button>
                    </form>
                    <form>
                        <button type={"submit"} className="start-button submite" id="startBtn" onClick={(e) => onSubmit(e)}>Log Out
                        </button>
                    </form>
                </nav>
            </div>
        )
    }

    return (
        <div id="container">
            <img id="logo" src="/logo/logo.png"/>
            <div id="title">Setup</div>
            <nav className="link__form">
                <Link to={'/setup/register'} className="start-button" id="startBtn">Register</Link>
                <Link to={'/setup/login'} className="start-button" id="startBtn">Login</Link>
            </nav>
        </div>
    )
}

export default Setup;