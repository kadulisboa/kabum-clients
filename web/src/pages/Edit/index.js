import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import './styles.css';
import { FiTrash2, FiEdit } from 'react-icons/fi';
import api from '../../services/api';

const Edit = ({ history }) => {
    const { client_id } = history.location.state;

    const [client, setClient] = useState([])

    useEffect(() => {

        api.get(`clients/${client_id}`).then(response => {
            setClient(response.data.Response);
        })

    }, []);
    console.log(client);

    return (
        <div id="page-main">
            <header>
                <h1>Kabum Clientes</h1>
            </header>
            <main>
                <div>
                    <form>
                        <label>
                            <legend>Nome:</legend>
                            <input value={client.name} />
                        </label>
                        <label>
                            <legend>Telefone:</legend>
                            <input value={client.phone} />
                        </label>
                        <label>
                            <legend>Aniversário:</legend>
                            <input value={client.birthday.split('-').reverse().join('/')} />
                        </label>
                        <label>
                            <legend>RG:</legend>
                            <input value={client.email} />
                        </label>
                        <label>
                            <legend>CPF:</legend>
                            <input value={client.cpf} />
                        </label>
                    </form>
                </div>
            </main>
        </div>
    )
}

export default Edit;
