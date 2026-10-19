

function loading() {
    return(
        <div className="d-flex align-items-center justify-content-center w-100 mb-5">
            <svg className={'svg-icon loading'} xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 50 50" width={'100px'} height={'100px'}>
                <circle cx="25" cy="25" r="12" fill="none" stroke={'#cfcfcf'} strokeWidth={'2.5'} strokeLinecap={'round'}/>
                <circle cx="25" cy="25" r="12" fill="none" stroke={'#212529'} strokeWidth={'2.5'} strokeLinecap={'round'} strokeDasharray={'20 55'} />
            </svg>
        </div>
    )
}

export default loading;