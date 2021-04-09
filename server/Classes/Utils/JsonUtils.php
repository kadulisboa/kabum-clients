<?php

    namespace Utils;

    class JsonUtils {

        public static function processRequestBody() {
            
            try {
                $postJson = json_decode(file_get_contents("php://input"), true);
                
            } catch (\JsonException $exception ) {
                throw new InvalidArgumentsException(ConstantsUtils::MSG_ERROR_JSON_EMPTY);
                
            }

            if(in_array($postJson) && count($postJson)){
                return $postJson;
            }

        }

    }
