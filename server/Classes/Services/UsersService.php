<?php

    namespace Services;

    use Repositories as R;
    use Utils as U;

    class UsersService{
        private $data;
        private $bodyRequest;
        private $usersRepository;

        /**
         * Class constructor.
         */
        public function __construct($data = []) {
            $this->data = $data;
            $this->usersRepository = new R\UsersRepository();
        }

        public function validateGet(){
            if( $this->data['id'] ){
                $return = $this->listById($this->data['id']);
            } else {
                $return = $this->listAll();
            }
            return $return;
        }

        public function listById($id) {
            $return = $this->usersRepository->getById($id);
            if(count($return) == 0 ){
                throw new \InvalidArgumentException(U\ConstantsUtils::MSG_ERROR_NOT_RETURN[0]);    
            } 
            return $return;
        }
        
        public function listAll() {
            $return = $this->usersRepository->getAll();
            if(count($return) == 0 ){
                throw new \InvalidArgumentException(U\ConstantsUtils::MSG_ERROR_NOT_RETURN[0]);    
            }
            
            return $return;
        }

        public function validatePost(){

            if( $this->bodyRequest && $this->data["route"] == "users" ){
                $return = $this->createNewUser($this->bodyRequest);

            } else if( $this->bodyRequest && $this->data["route"] == "login" ) {
                $return = $this->loginUser($this->bodyRequest);

            } else {
                throw new \InvalidArgumentException(U\ConstantsUtils::MSG_ERROR_NOT_AFFECTED[0]);

            }

            return $return;
        }

        public function setBodyRequest($body){
            $this->bodyRequest = $body;
        }
        
        public function createNewUser($bRquest){
            $existentEmail = $this->usersRepository->verifyEmail($bRquest['email'])['email'];

            if ($existentEmail == $bRquest['email']) {
                throw new \InvalidArgumentException(U\ConstantsUtils::MSG_ERROR_LOGIN_EXISTS[0]);
            }

            $dataBodyRequest = (object) $bRquest;
            $passwordSecurity = password_hash($dataBodyRequest->password.U\ConstantsUtils::CODE_PASS, PASSWORD_DEFAULT);
            $dataBodyRequest->password = $passwordSecurity;
            
            
            $return = $this->usersRepository->createUsers($dataBodyRequest);
            unset($dataBodyRequest->password);
            
            return $dataBodyRequest;
        }
        
        public function loginUser($bRequest)
        {
            $email = $bRequest['email'];

            if($email == NULL || $email == '' || $bRequest['password'] == NULL || $bRequest['password'] == '' ){
                throw new \InvalidArgumentException(U\ConstantsUtils::MSG_ERROR_LOGIN_PASS[0]);
            }

            $existentEmail = $this->usersRepository->verifyEmail($email);
            
            if ($existentEmail == NULL || $existentEmail == '' ){
                throw new \InvalidArgumentException(U\ConstantsUtils::MSG_ERROR_NOT_RETURN[0]);
            }

            $pass = password_verify($bRequest['password'].U\ConstantsUtils::CODE_PASS ,$existentEmail['password']);
            
            if($pass) {
                $return = [];
                $return['name'] = $existentEmail['name'];
                $return['email'] = $existentEmail['email'];
                $return['cookie_name'] = "kabum_clients_logged";
                $return['expired_date'] = date('d/m/Y', strtotime( "+1 day" ) );
                
            } else {
                throw new \InvalidArgumentException(U\ConstantsUtils::MSG_ERROR_LOGIN_PASS[1]);
            }

            return $return;
        }

        public function validateDelete(){
            if( $this->data['id'] == NULL ){
                throw new \InvalidArgumentException(U\ConstantsUtils::MSG_ERROR_ID_REQUIRED[0]);
            } else {
                return $this->usersRepository->deleteUser($this->data['id']);
            }
        }

        public function validatePut(){
            if( $this->bodyRequest ){
                return $this->usersRepository->editUsers($this->bodyRequest, $this->data['id']);
            } else {
                throw new \InvalidArgumentException(U\ConstantsUtils::MSG_ERROR_NOT_AFFECTED[0]);
            }
        }

        
    }
