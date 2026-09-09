export default function Register(){
    return(
        <>
            <h2>Sign up</h2>
            <form className={"form"}>
                <div className={'w100 hz_input'}>
                    <label className={'mini'} htmlFor="">Email</label>
                    <input type="text" placeholder={'example@gmail.com'}/>
                </div>
                <div className={'w100 hz_input'}>
                    <label className={'mini'} htmlFor="">Password</label>
                    <input type="text" placeholder={'must be 8 characters'}/>
                </div>
                <div className={'w100 hz_input'}>
                    <label className={'mini'} htmlFor="">Confirm password</label>
                    <input type="text" placeholder={'repeat password'}/>
                </div>
                <button className={'btn mt-32'} type={"submit"}>Sign up</button>
            </form>
        </>
    )
}