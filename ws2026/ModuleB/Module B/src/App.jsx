import {BrowserRouter, Route, Routes} from "react-router-dom";
import './App.css';
import Register from "./pages/Register.tsx";
import Login from "./pages/Login.jsx";
import EventsList from "./pages/EventsList.jsx";
import Events from "./pages/Events.jsx";
import ErrorPage from "./pages/ErrorPage.jsx";
import Participant from "./pages/Participant.jsx";
import Registrations from "./pages/Registrations.jsx";

function App() {
  return (
    <BrowserRouter>
      <Routes>
          <Route path="/login" element={<Login />}  />
          <Route path="/register" element={<Register />}  />
          <Route path="/" element={<EventsList />} />
          <Route path={'/events/:id'} element={<Events />} />
          <Route path={'/registrations'} element={<Registrations />} />
          <Route path={'/participant'} element={<Participant />} />
          <Route path="*" element={<ErrorPage />}  />
      </Routes>
    </BrowserRouter>
  )
}

export default App
