import { BrowserRouter, Switch, Route } from "react-router-dom";

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


import { withRouter } from "react-router-dom";

function HeaderLoggedIn({ history }) {
    history.push('/');
}
