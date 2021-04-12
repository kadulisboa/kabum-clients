import React, { useEffect, useState, ChangeEvent, FormEvent } from 'react';
import { Link } from 'react-router-dom';
import './styles.css';
import cookie from 'react-cookies';
import { FiTrash2, FiEdit } from 'react-icons/fi';
import logo from '../../assets/images/kabum-logo.png';
import api from '../../services/api';

const Main = () => {
    const [clients, setClients] = useState([])

    useEffect(async () => {
        const response = await api.get('clients');
        setClients(response.data.Response);

    }, []);

    return (
        <div id="page-main">
            <header>
                <h1>Kabum Clientes</h1>
            </header>
            <main>
                <div>
                    <ul>
                        {
                            clients.map(client => (
                                <li key={client.id}>
                                    <p>Nome: {client.name}</p>
                                    <p>Aniversário: {client.birthday.split('-').reverse().join('/')}</p>
                                    <p>CPF: {client.cpf}</p>
                                    <p>RG: {client.rg}</p>
                                    <p>Telefone: {client.phone}</p>
                                    <ol>
                                        {console.log(client.address)}
                                        {Object.values(JSON.parse(client.address)).map(address => (
                                            <li key={address.street + ',' + address.number}>
                                                <p>
                                                    {address.street}, {address.number} - {address.city}/{address.uf}
                                                </p>
                                            </li>
                                        ))}
                                    </ol>
                                    <div className="buttons">
                                        <button>
                                            <FiEdit />
                                        </button>
                                        <button>
                                            <FiTrash2 />
                                        </button>
                                    </div>
                                </li>
                            ))
                        }

                    </ul>
                </div>
            </main>
        </div>
    )
}

export default Main;
