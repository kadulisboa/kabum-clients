import React, { useEffect, useState, ChangeEvent, FormEvent } from 'react';
import { Link } from 'react-router-dom';
import './styles.css';
import cookie from 'react-cookies';
import { FiLogIn } from 'react-icons/fi';
import logo from '../../assets/images/kabum-logo.png';
import api from '../../services/api';

const Login = ({ history }) => {
    const [formData, setFormData] = useState({
        email: '',
        password: '',
    });

    function handleInputChange(event) {
        const { name, value } = event.target;

        setFormData({ ...formData, [name]: value });
    }

    async function handleSubmit(event) {
        event.preventDefault();

        const { data } = await api.post('login', formData);

        if (data.Type === 'success') {

            const expires = new Date();
            const expired_date = data.Response.expired_date.split('/').reverse().join('-')

            cookie.save(data.Response.cookie_name, {
                'id': data.Response.id,
                'name': data.Response.name,
                'email': data.Response.email,
            },
                {
                    expires: expires.setDate(Date.parse(expired_date))
                }
            );

            alert('Logado com sucesso!');
        } else if (data.Type === 'error') {
            alert(data.Response);
            return 0;
        }


        history.push('/');

    }

    return (
        <div id="page-login">
            <div className="logo">
                <img src={logo} alt="Logo Kabum.com.br" />
                <h2>Clientes</h2>
            </div>
            <form onSubmit={handleSubmit}>
                <label>
                    <legend>E-mail*</legend>
                    <input required type="email" name="email" onChange={handleInputChange} placeholder="Insira aqui o seu email" />
                </label>
                <label>
                    <legend>Senha*</legend>
                    <input required type="password" name="password" onChange={handleInputChange} placeholder="Insira aqui a sua senha" />
                </label>
                <button type="submit">
                    <b>Logar</b>
                    <FiLogIn />
                </button>
                <p>Preenchimento Obrigatório *</p>
            </form>
        </div>
    )
}

export default Login;
