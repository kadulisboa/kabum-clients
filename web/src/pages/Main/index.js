import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import './styles.css';
import { FiTrash2, FiEdit } from 'react-icons/fi';
import api from '../../services/api';

const Main = ({ history }) => {
    const [clients, setClients] = useState([])

    useEffect(() => {

        api.get('clients').then(response => {
            setClients(response.data.Response);
        })

    }, []);

    const handleDeleteClient = (id) => {
        const confirm = window.confirm("Deseja mesmo excluir esse cliente?");

        if (confirm) {
            api.delete('clients/' + id).then(response => {
                if (response.data.Type === 'success') {
                    alert(response.data.Response.message);
                    const clientsRemoveIndex = clients.findIndex(client => id === client.id);
                    const newClients = [...clients];
                    newClients.splice(clientsRemoveIndex, 1);
                    setClients(newClients);
                }
            });
        }

    }

    const handleEditClient = (id) => {
        const confirm = window.confirm("Deseja mesmo editar esse cliente?");

        if (confirm) {
            history.push({
                pathname: '/editar',
                state: { client_id: id }
            });
        }

    }

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
                                    <div className="data-client-box">
                                        <div className="data-client">
                                            <p className="title"><b>Dados Pessoais</b></p>
                                            <p>Nome: {client.name}</p>
                                            <p>Aniversário: {client.birthday.split('-').reverse().join('/')}</p>
                                            <p>Telefone: {client.phone}</p>
                                            <p>CPF: {client.cpf}</p>
                                            <p>RG: {client.rg}</p>
                                        </div>
                                        <ol>
                                            <p><b>Endereços</b></p>
                                            {Object.values(JSON.parse(client.address)).map(address => (
                                                <li key={address.street + ',' + address.number}>
                                                    <p>
                                                        {address.street}, {address.number} - {address.city}/{address.uf}
                                                    </p>
                                                </li>
                                            ))}
                                        </ol>
                                    </div>
                                    <div className="buttons">
                                        <button onClick={() => handleEditClient(client.id)} title="Editar Cliente">
                                            <FiEdit />
                                        </button>
                                        <button
                                            onClick={() => handleDeleteClient(client.id)}
                                            title="Excluir Cliente"
                                        >
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
