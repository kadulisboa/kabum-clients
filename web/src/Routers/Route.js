import React from 'react';
import PropTypes from 'prop-types';
import { Redirect, Route } from 'react-router-dom';
import cookie from 'react-cookies';

function RouteWrapper({
    redirectTo, isPrivate, component: Component, ...rest
}) {
    const authenticated = cookie.load('kabum_clients_logged');

    if (!authenticated && isPrivate) return <Redirect to={redirectTo} />;

    return <Route {...rest} render={props => <Component {...props} />} />;
}

RouteWrapper.propTypes = {
    redirectTo: PropTypes.string,
    isPrivate: PropTypes.bool,
    component: PropTypes.oneOfType([PropTypes.element, PropTypes.func])
        .isRequired,
};

RouteWrapper.defaultProps = {
    redirectTo: '/login',
    isPrivate: false,
};

export default RouteWrapper;
