<?php

    namespace Repositories;

    use \Utils as U;

    class UsersRepository {

        private $pdo;
        private const TABEL = "users";
        
        /**
         * Class constructor.
         */
        public function __construct()
        {
            $this->pdo = new U\PdoUtils();
        }
    }
