<?php

    namespace Validator;
    use Utils as U;
    use Repositories as R;

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
        
            $this->authorizedTokenRepository->validateToken($headers['Authorization']);
            $method = $this->request['method'];
            return $this->$method();;

        }
        private function get(){
            $return = U\ConstantsUtils::MSG_ERROR_ROUTE;
            if( in_array($this->request['route'], U\ConstantsUtils::TYPE_GET) ){
                echo "existe";
                die;

            }
        }
    }
