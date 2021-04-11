<?php

    namespace Validator;
    use Utils as U;
    use Repositories as R;
    use Services as S;

    class RequestValidator
    {
        private $request;
        private $dataRequest;
        private $authorizedTokenRepository;

        /**
         * Class constructor.
         */

        public function __construct($request)
        {
            $this->jsonUtils = new U\JsonUtils();
            $this->request = $request;
            $this->authorizedTokenRepository = new R\AuthorizedTokensRepository();
        }
        
        public function processRequest(){
            $return = U\ConstantsUtils::MSG_ERROR_ROUTE[0];

            if(
                in_array( $this->request['method'], U\ConstantsUtils::TYPE_REQUEST )
            ){
                $return = $this->directRequest();
            }
           
            return $return;
        }

        private function directRequest() {
            $headers = getallheaders();

            if( $this->request['method'] !== "GET" && $this->request['method'] !== "DELETE" ){
                $this->dataRequest = $this->jsonUtils->processRequestBody();
            }
        
            // $this->authorizedTokenRepository->validateToken($headers['Authorization']);
            $method = $this->request['method'];

            return $this->$method();;

        }

        private function get(){
            $return = U\ConstantsUtils::MSG_ERROR_ROUTE;

            if( in_array($this->request['route'], U\ConstantsUtils::TYPE_GET) ){
                switch ($this->request['route']) {
                    case 'users':
                        $usersService = new S\UsersService($this->request);
                        $return = $usersService->validateGet();
                        return $return;
                        
                        break;
                    
                    case 'clients':
                        $clientsService = new S\ClientsService($this->request);
                        $return = $clientsService->validateGet();
                        return $return;
                        break;
                    
                    default:
                        throw new \InvalidArgumentException(U\ConstantsUtils::MSG_ERROR_RECOURSE_NOT_FOUND[0]);
                        break;
                }

            }else {
                throw new \InvalidArgumentException($return[0]);
            }
        }

        private function post(){
            $return = U\ConstantsUtils::MSG_ERROR_ROUTE;

            if( in_array($this->request['route'], U\ConstantsUtils::TYPE_POST) ){
                
                switch ($this->request['route']) {

                    case 'users':
                        $usersService = new S\UsersService($this->request);
                        $usersService->setBodyRequest($this->dataRequest);
                        $return = $usersService->validatePost();
                        return (array) $return;
                        break;
                    
                    case 'clients':
                        $clientsService = new S\ClientsService($this->request);
                        $clientsService->setBodyRequest($this->dataRequest);
                        $return = $clientsService->validatePost();
                        return (array) $return;

                        break;
                    
                    case 'login':
                        $usersService = new S\UsersService($this->request);
                        $usersService->setBodyRequest($this->dataRequest);
                        $return = $usersService->validatePost();
                        return (array) $return;
                        break;
                    
                    default:
                        throw new \InvalidArgumentException(U\ConstantsUtils::MSG_ERROR_RECOURSE_NOT_FOUND[0]);
                        break;
                }

            }else {
                throw new \InvalidArgumentException($return[0]);
            }
        }

        private function delete(){
            $return = U\ConstantsUtils::MSG_ERROR_ROUTE;

            if( in_array($this->request['route'], U\ConstantsUtils::TYPE_GET) ){
                switch ($this->request['route']) {
                    case 'users':
                        $usersService = new S\UsersService($this->request);
                        $return = $usersService->validateDelete();

                        return $return;
                        
                        break;
                    
                    case 'clients':
                        $clientsService = new S\ClientsService($this->request);
                        $return = $clientsService->validateDelete();

                        return $return;
                        break;
                    
                    default:
                        throw new \InvalidArgumentException(U\ConstantsUtils::MSG_ERROR_RECOURSE_NOT_FOUND[0]);
                        break;
                }

            }else {
                throw new \InvalidArgumentException($return[0]);
            }
        }
        private function put(){
            $return = U\ConstantsUtils::MSG_ERROR_ROUTE;

            if( in_array($this->request['route'], U\ConstantsUtils::TYPE_GET) ){
                switch ($this->request['route']) {
                    case 'users':
                        $usersService = new S\UsersService($this->request);
                        $usersService->setBodyRequest($this->dataRequest);
                        $return = $usersService->validatePut();
                        return (array) $return;
                        
                        break;
                    
                    case 'clients':
                        $clientsService = new S\ClientsService($this->request);
                        $clientsService->setBodyRequest($this->dataRequest);
                        $return = $clientsService->validatePut();
                        return (array) $return;

                        break;

                    
                    default:
                        throw new \InvalidArgumentException(U\ConstantsUtils::MSG_ERROR_RECOURSE_NOT_FOUND[0]);
                        break;
                }

            }else {
                throw new \InvalidArgumentException($return[0]);
            }
        }
    }
