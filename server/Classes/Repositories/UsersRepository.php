<?php

    namespace Repositories;

    use \Utils as U;

    class UsersRepository {

        private $pdo;
        private const TABLE = "users";
        
        /**
         * Class constructor.
         */
        public function __construct()
        {
            $this->pdo = new U\PdoUtils();
            $this->pdoS = new U\PDOStatement();
        }

        public function getAll(){
            return $this->pdo->Select(self::TABLE)->fetchAll(\PDO::FETCH_ASSOC);
        }
        
        public function getById($id){
            return $this->pdo->Select(self::TABLE, "*", ["id" => $id])->fetch(\PDO::FETCH_ASSOC);
        }

        public function verifyEmail($email){
            return $this->pdo->Select(self::TABLE, "*", ["email" => $email])->fetch(\PDO::FETCH_ASSOC);
        }

        public function createUsers($bodyRquest){

            $return = $this->pdo->Insert(self::TABLE, $bodyRquest);
            $error = $this->pdo->errorInfo();

            if($error[0] != "00000") {
                throw new \InvalidArgumentException(U\ConstantsUtils::MSG_ERROR_NOT_RETURN[0]);
            }

            return $return;
        }

        public function deleteUser($id){
            $return = $this->pdo->Delete(self::TABLE, [ "id" => $id ]);
            $error = $this->pdo->errorInfo();
            if($error[0] != "00000") {
                throw new \InvalidArgumentException(U\ConstantsUtils::MSG_ERROR_NOT_RETURN[0]);
            }

            return [ "message" => U\ConstantsUtils::MSG_DEL_SUCCESS[0] ];
        }

        public function editUsers($bodyRquest, $id)
        {
            if($id == NULL) {
                $where = 1;
            } else {
                $where = ["id" => $id];
            }
            
            $return = $this->pdo->Update(self::TABLE, $where, $bodyRquest);
            $error = $this->pdo->errorInfo();
            if($error[0] != "00000") {
                throw new \InvalidArgumentException(U\ConstantsUtils::MSG_ERROR_NOT_RETURN[0]);
            }

            return ["message"=> U\ConstantsUtils::MSG_ATT_SUCCESS];
        }
    }
