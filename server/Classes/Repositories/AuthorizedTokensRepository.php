<?php

    namespace Repositories;
    use InvalidArgumentException;
    use \Utils as U;

    class AuthorizedTokensRepository
    {
        private $pdo;
        public const TABLE = "authorization_tokens";


        /**
         * Class constructor.
        **/

        public function __construct()
        {
            $this->pdo = new U\PdoUtils();
        }
        
        public function validateToken($token) {
            $token = str_replace([' ', 'Bearer'], '', $token);
            
            // ->fetch(\PDO::FETCH_ASSOC);

            if($token){
                $consultToken = $this->pdo->Select(self::TABLE,'*', ["token" => $token, "status" => 1])->fetchAll(\PDO::FETCH_ASSOC);
                
                if(count($consultToken) != 1){
                    header('HTTP/1.1 401 Unauthorized');
                    throw new \InvalidArgumentException(U\ConstantsUtils::MSG_ERROR_TOKEN_UNAUTHORIZED[0], 1);
                }
                
            }else{
                header('HTTP/1.1 400 Unauthorized');
                throw new InvalidArgumentException(U\ConstantsUtils::MSG_ERROR_TOKEN_EMPTY[0], 1);

            }

        }

        public function createToken() {

            $data    = random_bytes( 16 );
            $data[6] = chr( ord( $data[6] ) & 0x0f | 0x40 );
            $data[8] = chr( ord( $data[8] ) & 0x3f | 0x80 );

            $data = vsprintf( '%s%s-%s-%s-%s-%s%s%s', str_split( bin2hex( $data ), 4 ) );

            (new U\PDO)->Insert(TABLE, ["token"=>$data]);

        }
        
        public function getToken($id) {

            $this->pdo->Select(TABLE, "*" ,"token = $id AND status = 1");

        }

    }
