

function Login() {
    return (
        <>
            <form className={'form'}>
                <input type="text" placeholder="Email" name="email" />
                <input type="text" placeholder="Password" name="password" typeof="password" />
                <input className={'btn'} type="submit" value="Login" />
            </form>
        </>
    )
}

export default Login;