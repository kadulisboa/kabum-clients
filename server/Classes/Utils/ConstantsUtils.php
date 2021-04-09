<?php

    namespace Utils;

    abstract class ConstantsUtils {
        public const TYPE_REQUEST = [
            "GET", 
            "POST",
            "DELETE",
            "PUT"
        ];

        public const TYPE_GET = [
            "users",
            "clients",
            "tokens"
        ];
        
        public const TYPE_POST = [
            "users",
            "clients",
            "tokens"
        ];
        
        public const TYPE_DELETE = [
            "users",
            "clients",
            "tokens"
        ];

        public const TYPE_PUT = [
            "users",
            "clients",
            "tokens"
        ];

        public const MSG_ERROR_ROUTE = ["Rota não permitida."];
        public const MSG_ERROR_RECOURSE_NOT_FOUND = ["Recurso Inexistente."];
        public const MSG_ERROR_GENERIC = ["Erro desconhecido."];
        public const MSG_ERROR_NOT_RETURN = ["Nenhum registro encontrado."];
        public const MSG_ERROR_NOT_AFFECTED = ["Nenhum registro afetado."];
        public const MSG_ERROR_TOKEN_EMPTY = ["Informar Token."];
        public const MSG_ERROR_TOKEN_UNAUTHORIZED = ["Token não autorizado."];
        public const MSG_ERROR_JSON_EMPTY = ["JSON Vazio."];
        
        public const MSG_DEL_SUCCESS = ["Registro Deletado com sucesso."];
        public const MSG_ATT_SUCCESS = ["Registro Atualizado com sucesso."];
        
        public const MSG_ERROR_ID_REQUIRED = ["ID Obrigatório."];
        public const MSG_ERROR_LOGIN_EXISTS = ["Login já existente."];
        public const MSG_ERROR_LOGIN_PASS = ["Login e senha são obrigatórios."];

        const TYPE_SUCCESS = "success";
        const TYPE_ERROR = "error";

        public const YES = "Y";
        public const NO = "N";
        public const TYPE = "Type";
        public const RESPONSE = "Response";


    }
