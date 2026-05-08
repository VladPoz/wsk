import Header from "../assets/Header.jsx";
import {useEffect, useState} from "react";
import {api} from "../api.jsx";

function EventsList() {

    const [search, setSearch] = useState('')

    useEffect(() => {
        api.getEventsList({search: null}).then((response) => {
            console.log(response.data.data)
        }).catch((err) => {
            console.log(err.response.data.message)
        })
    }, []);

    function handleSearch(e) {
        e.preventDefault()
        api.getEventsList({search: search}).then((response) => {
            console.log(response.data.data)
        }).catch((err) => {
            console.log(err.response.data.message)
        })
    }

    return(
        <>
            <Header/>
            <div className="container">
                <form onSubmit={handleSearch}>
                    <input type="text" placeholder={'Search'} className={'search'} onChange={(e)=>{setSearch(e.target.value)}} required={true} />
                </form>
                <div className="row"></div>
            </div>
        </>
    )
}

export default EventsList;