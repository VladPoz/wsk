import {Link} from "react-router-dom";

function ErrorPage() {
    return (
        <div className={'d-flex vh-100 align-items-center justify-content-center flex-column'}>
            <h1>404</h1>
            <p>Страница не найдена</p>
            {localStorage.getItem('token') ? (
                <Link className={'btn btn-dark'} to={'/'}>Мероприятия</Link>
            ) : (
                <Link className={'btn btn-dark'} to={'/login'}>Вход</Link>
            )}
        </div>
    )
}

export default ErrorPage;