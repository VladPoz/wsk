import {Link} from "react-router-dom";


function Header() {
    return (
        <header className="header">
            <div className="container">
                <div className="header__content">
                    <Link to={'/'} className="header__title">Module B</Link>
                    {localStorage.getItem("token") ? (
                        <nav>
                            <Link to={'/login'}>Login</Link>
                            <Link to={'/register'}>Register</Link>
                        </nav>
                    ) : <nav>
                            <Link to={'/login'}>Login</Link>
                            <Link to={'/register'}>Register</Link>
                        </nav>}
                </div>
            </div>
        </header>
    )
}

export default Header;