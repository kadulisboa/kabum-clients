<?php

    namespace Utils;

    use Utils as U;

    class JsonUtils {
        
        public static function processRequestBody() {
            
            try {
                $postJson = json_decode(file_get_contents("php://input"), true);
            } catch (\JsonException $exception ) {
                throw new InvalidArgumentsException(ConstantsUtils::MSG_ERROR_JSON_EMPTY[0]);
                
            }
            
            if(is_array($postJson) && count($postJson)){
                return $postJson;
            }

        }

        public function processArray($dataReturn){
            $data = [];
            $data[U\ConstantsUtils::TYPE] = U\ConstantsUtils::TYPE_ERROR;

            if ((is_array($dataReturn) && count($dataReturn) > 0) ) {
                $data[U\ConstantsUtils::TYPE] = U\ConstantsUtils::TYPE_SUCCESS;
                $data[U\ConstantsUtils::RESPONSE] = $dataReturn;
            }

            $this->returnJson($data);
        }

        private function returnJson($json){

            header('Content-Type: application/json');
            header('Cache-Control: no-cache, no-store, must-revalidate');
            header('Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE');
            echo json_encode($json, JSON_THROW_ON_ERROR, 1024);
            exit;
        }

    }
