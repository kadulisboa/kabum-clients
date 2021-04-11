<?php

    namespace Services;

    use Repositories as R;
    use Utils as U;

    class ClientsService{
        private $data;
        private $bodyRequest;
        private $clientsRepository;

        /**
         * Class constructor.
         */
        public function __construct($data = []) {
            $this->data = $data;
            $this->clientsRepository = new R\ClientsRepository();
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
            $return = $this->clientsRepository->getById($id);
            if(count($return) == 0 ){
                throw new \InvalidArgumentException(U\ConstantsUtils::MSG_ERROR_NOT_RETURN[0]);    
            } 
            return $return;
        }
        
        public function listAll() {
            $return = $this->clientsRepository->getAll();
            if(count($return) == 0 ){
                throw new \InvalidArgumentException(U\ConstantsUtils::MSG_ERROR_NOT_RETURN[0]);    
            }
            
            return $return;
        }

        public function validatePost(){

            if( $this->bodyRequest ){
                $return = $this->createNewClients($this->bodyRequest);

            } else {
                throw new \InvalidArgumentException(U\ConstantsUtils::MSG_ERROR_NOT_AFFECTED[0]);
            }
            
            return $return;
        }

        public function setBodyRequest($body){
            $this->bodyRequest = $body;
        }
        
        public function createNewClients($bRquest){
            $dataBodyRequest = (object) $bRquest;
            
            if(!is_array($dataBodyRequest->address)){
                throw new \InvalidArgumentException(U\ConstantsUtils::MSG_ERROR_JSON_EMPTY[0]);
            }
            
            // password_verify($dataBodyRequest->password.U\ConstantsUtils::CODE_PASS ,$dataBodyRequest->passwordSecurity);
            
            $return = $this->clientsRepository->createClients($dataBodyRequest);
            
            return $dataBodyRequest;
        }

        public function validateDelete(){
            if( $this->data['id'] == NULL ){
                throw new \InvalidArgumentException(U\ConstantsUtils::MSG_ERROR_ID_REQUIRED[0]);
            } else {
                return $this->clientsRepository->deleteClients($this->data['id']);
            }
        }

        public function validatePut(){
            if( $this->bodyRequest ){
                return $this->clientsRepository->editClients($this->bodyRequest, $this->data['id']);
            } else {
                throw new \InvalidArgumentException(U\ConstantsUtils::MSG_ERROR_NOT_AFFECTED[0]);
            }
        }

        
    }
