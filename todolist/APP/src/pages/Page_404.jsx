import {Link} from "react-router-dom";

export default function Page_404(){
    return(
        <nav className={'form'}>
            <h2 className={'mt-32'}>404</h2>
            <Link to={'/'} className={'btn d-flex'}>Home Page</Link>
        </nav>
    )
}