npm install immer use-immer

import './App.css';
import Header from "./layouts/Header";
import Footer from "./layouts/Footer";
import HomeGuest from "./components/HomeGuest";
import { BrowserRouter, Switch, Route } from "react-router-dom";
import About from "./pages/About";
import Terms from "./pages/Terms";
import Home from "./components/Home";
import CreatePost from "./pages/CreatePost";
import ViewSinglePost from "./pages/ViewSinglePost";
import FlashMessage from "./components/FlashMessage";
import StateContext from "./context/StateContext";
import DispatchContext from "./context/DispatchContext";
import { useImmerReducer } from "use-immer";
import { useEffect } from "react";

function App() {
  const initialState = {
    loggedIn: Boolean(localStorage.getItem('complexappToken')),
    flashMessage: '',
    user: {
      token: localStorage.getItem('complexappToken'),
      username: localStorage.getItem('complexappUsername')
    }
  }
  const ourReducer = (draft, action) => {
    switch (action.type) {
      case "login":
        draft.loggedIn = true;
        draft.user = action.data;
        return;
      case "logout":
        draft.loggedIn = false;
        return;
      case "flashMessage":
        draft.flashMessage = action.value;
        return;
      default:
        return;
    }
  }

  const [state, dispatch] = useImmerReducer(ourReducer, initialState);

  useEffect(() => {
    if (state.loggedIn) {
      localStorage.setItem('complexappToken', state.user.token);
      localStorage.setItem('complexappUsername', state.user.username);
    } else {
      localStorage.removeItem('complexappToken');
      localStorage.removeItem('complexappUsername');
    }
  }, [state.loggedIn, state.user.token, state.user.username]);
  return (
    <StateContext.Provider value={state}>
      <DispatchContext.Provider value={dispatch}>
        <BrowserRouter>
          <Header/>
          {state.flashMessage !== '' && <FlashMessage msg={state.flashMessage}/>}
          <Switch>
            <Route path="/" exact>
              {state.loggedIn ? <Home/> : <HomeGuest/>}
            </Route>
            <Route path="/create-post">
              <CreatePost/>
            </Route>
            <Route path="/post/:id">
              <ViewSinglePost/>
            </Route>
            <Route path="/about">
              <About/>
            </Route>
            <Route path="/terms">
              <Terms/>
            </Route>
          </Switch>
          <Footer/>
        </BrowserRouter>
      </DispatchContext.Provider>
    </StateContext.Provider>
  );
}

export default App;

#======================================= Header logout
import React, { useState, useContext } from 'react';
import axios from "axios";
import { API_AXIOS_URL } from "../config";
import DispatchContext from "../context/DispatchContext";

function HeaderLoggedOut() {
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const AppDispatch = useContext(DispatchContext);

  async function submitHandler(e) {
    e.preventDefault();
    try {
      const response = await axios.post(`${API_AXIOS_URL}/login`, { username, password })
      if (response.data) {
        setUsername('')
        setPassword('')
        AppDispatch({ type: "login", data: response.data });
      } else {
        console.log(response.data, 'response.data')
      }
    } catch (e) {
      console.log(e, 'e')
    }

  }

  return (
    <form onSubmit={submitHandler} className="mb-0 pt-2 pt-md-0">
      <div className="row align-items-center">
        <div className="col-md mr-0 pr-md-0 mb-3 mb-md-0">
          <input value={username} onChange={e => setUsername(e.target.value)} name="username"
                 className="form-control form-control-sm input-dark" type="text"
                 placeholder="Username" autoComplete="off"/>
        </div>
        <div className="col-md mr-0 pr-md-0 mb-3 mb-md-0">
          <input value={password} onChange={e => setPassword(e.target.value)} name="password"
                 className="form-control form-control-sm input-dark" type="password"
                 placeholder="Password"/>
        </div>
        <div className="col-md-auto">
          <button className="btn btn-success btn-sm">Sign In</button>
        </div>
      </div>
    </form>
  );
}

export default HeaderLoggedOut;
