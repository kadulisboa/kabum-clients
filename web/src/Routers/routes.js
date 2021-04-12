import React from 'react';
import { Switch } from 'react-router-dom';
import Login from '../pages/Login';
import Main from '../pages/Main';
import Edit from '../pages/Edit';
import Route from './Route';



const Routes = () => {
    return (
        <Switch>
            <Route component={Login} path="/login" exact />
            <Route component={Main} path="/" exact isPrivate />
            <Route component={Edit} path="/editar" exact isPrivate />
        </Switch>
    )
}

export default Routes;
