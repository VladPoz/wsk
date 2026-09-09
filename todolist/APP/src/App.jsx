import {BrowserRouter, Link, Route, Routes} from "react-router-dom";
import Signin from "./pages/auth/Signin.jsx";
import Signup from "./pages/auth/Signup.jsx";
import Page_404 from "./pages/Page_404.jsx";
import ViewAllTasks from "./pages/tasks/ViewAllTasks.jsx";
import ViewTask from "./pages/tasks/ViewTask.jsx";
import "./App.css";

export default function App(){
  return(
    <BrowserRouter>
        <div className={'container'}>
            <div className={'header'}>
                <Link className={'back_btn'} to={'/'}>
                    <img src="/icons/left.svg" alt=""/>
                </Link>
                <img src="/icons/Star.svg" alt=""/>
            </div>
            <Routes>
                <Route path={'/'} element={<ViewAllTasks />} />
                <Route path={'/auth/signin'} element={<Signin />} />
                <Route path={'/auth/signup'} element={<Signup />} />
                <Route path={'/task/:id'} element={<ViewTask />} />
                <Route path={'*'} element={<Page_404 />} />
            </Routes>
        </div>
    </BrowserRouter>
  )
};