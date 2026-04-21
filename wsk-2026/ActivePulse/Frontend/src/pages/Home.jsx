import {Link} from "react-router-dom";


function Home() {



    return(
        <div id="container">
            <img id="logo" src="/logo/logo.png"/>
            <div id="title">Welcome to ActivePulse</div>
            <div id="slogan">Train Today. Win Tomorrow.</div>
            <div id="description">
                It's never been easier to get moving. Just press start, and join your
                community for a daily burst of fun and fitness.
            </div>
            <div id="pulse">
                <svg width="200" height="100">
                    <polyline
                        points="0,50 20,50 30,20 40,80 50,50 70,50"
                        className={'hz'}
                        id="pulse-line"
                    />
                </svg>
            </div>
            <Link to={'/setup'}
                type="button"
                className="start-button"
                id="startBtn"
            >Start Now</Link>
        </div>
    )
}

export default Home;