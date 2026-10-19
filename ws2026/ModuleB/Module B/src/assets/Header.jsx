import {Link, useNavigate} from "react-router-dom";
import {api} from "../api.jsx";

function Header() {

    const navigate = useNavigate();

    function handleLogout() {
        api.logout().then(() => {
            navigate("/login");
            localStorage.removeItem("token");
            localStorage.removeItem("role");
        }).catch((err) => {
            console.log(err.response.data.message);
        })
    }

    return (
        <header className="navbar navbar-dark bg-dark">
            <div className="container">
                <Link className={'navbar-brand'} to={'/'}>Events</Link>
                {localStorage.getItem("token") ? (
                    <nav className="navbar-nav flex-row gap-4">
                        <Link className={'nav-link'} to={'/registrations'}>Мои регистрации</Link>
                        <Link className={'nav-link'} to={'/participant'}>Профиль участника</Link>
                        <input type={'submit'} onClick={handleLogout} className={'btn btn-light'} value={'Выйти'}/>
                    </nav>
                ) : <nav className="navbar-nav flex-row gap-5">
                        <Link className={'nav-link nav-item'} to={'/login'}>Войти</Link>
                        <Link className={'nav-link nav-item'} to={'/register'}>Регестрация</Link>
                    </nav>}
            </div>
        </header>
    )
}

export default Header;