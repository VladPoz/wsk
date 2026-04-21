import './App.css'
import {BrowserRouter, Routes, Route} from "react-router-dom";
import Home from './pages/Home';
import Setup from './pages/Setup.jsx';
import Register from "./pages/Register.jsx";
import Login from "./pages/Login.jsx";
import CommunityCreate from "./pages/CommunityCreate.jsx";
import CommunityJoin from "./pages/CommunityJoin.jsx";
import Community from "./pages/Community.jsx";
import CommunityList from "./pages/CommunityList.jsx";

function App() {
  return (
      <BrowserRouter>
        <Routes>
            <Route path={'/'} element={<Home />}></Route>
            <Route path={'/setup'} element={<Setup />}></Route>
            <Route path={'/setup/login'} element={<Login />}></Route>
            <Route path={'/setup/register'} element={<Register />}></Route>
            <Route path={'/community/store'} element={<CommunityCreate />}></Route>
            <Route path={'/community/list'} element={<CommunityList />}></Route>
            <Route path={'/community/:slug'} element={<Community />}></Route>
            <Route path={'/community/:slug/join'} element={<CommunityJoin />}></Route>
        </Routes>
      </BrowserRouter>
  )
}

export default App
