<?php

    namespace Utils;

    class PdoUtils extends \PDO {

        /**
        *
        * Magic Method __construct
        *
        * @param  EMPTY
        * @return NULL
        *
        */

        function __construct() {

            try {

                parent::__construct( sprintf( '%s:dbname=%s;host=%s', TYPE, DTBS, HOST ), USER, PASS, [

                    PdoUtils::ATTR_PERSISTENT         => false,
                    PdoUtils::ATTR_ERRMODE            => PdoUtils::ERRMODE_EXCEPTION,
                    PdoUtils::ATTR_DEFAULT_FETCH_MODE => PdoUtils::FETCH_NAMED,
                    PdoUtils::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4',
                    PdoUtils::ATTR_STATEMENT_CLASS    => ['Utils\PDOStatement']

                ]);

            } catch( \PDOException $e) {
                echo $e->getMessage();
            }

        }

        /**
        *
        * Select
        *
        * @param STRING => $table
        * @param MIXED  => ARGS
        * @return PDO::STATEMENT => http://php.net/manual/pt_BR/class.pdostatement.php
        *
        */

        function Select( $table, $fields = "*", $where = 1, $options = "" ) {

            if(is_array($where)){
                $where = $this->Serialize($where, 'and');
            }

            return $this->Execute("SELECT {$fields} FROM {$table} WHERE {$where} {$options};");

        }

        /**
        *
        * Insert
        *
        * @param  STRING => $table
        * @param  ARRAY  => $values
        * @return PDO::STATEMENT => http://php.net/manual/pt_BR/class.pdostatement.php
        *
        */

        function Insert( $table, $values ) {
            
            $data = $this->Filter( $values, 'input' );
            $keys   = implode(',', array_keys( (array) $data ) );
            $values = $this->Serialize( (array) $data, ',', true );

            return $this->Execute("INSERT INTO {$table} (`id`, {$keys}) VALUES (uuid(), {$values});");

        }

        /**
        *
        * Update
        *
        * @param  STRING => $table
        * @param  MIXED  => $where
        * @param  ARRAY  => $values
        * @return PDO::STATEMENT => http://php.net/manual/pt_BR/class.pdostatement.php
        *
        */

        function Update( $table, $where, $values ) {

            if( is_array( $where ) ) $where = $this->Serialize( $this->Filter( $where, 'input' ), 'and' );

            $set = $this->Serialize( $this->Filter( $values, 'input' ), ',' );

            return $this->Execute("UPDATE {$table} SET {$set} WHERE {$where};");

        }

        /**
        *
        * Delete
        *
        * @param  STRING => $table
        * @param  STRING => $where
        * @return PDO::STATEMENT => http://php.net/manual/pt_BR/class.pdostatement.php
        *
        */

        function Delete( $table, $where ) {

            if( is_array( $where ) ) $where = $this->Serialize( $this->Filter( $where, 'input' ), 'and' );

            return $this->Execute("DELETE FROM {$table} WHERE {$where};");

        }

        /**
        *
        * Execute
        *
        * @param  STRING => $sql
        * @return PDO::STATEMENT => http://php.net/manual/pt_BR/class.pdostatement.php
        *
        */

        function Execute( $sql ) {

            try {
                
                return $this->Query( $sql );

            } catch( \PDOException $e) {

                echo $e->getMessage();

            }

        }

        /**
        *
        * Serialize
        *
        * @param  ARRAY  => $array
        * @param  STRING => $contact
        * @return STRING
        *
        */

        function Serialize( $array, $concat, $only_values = false ) {

            return implode( " {$concat} ", array_map( function( $k, $v ) use ( $only_values ) {

                if( $only_values ) return "'{$v}'";
                else return "{$k} = '{$v}'";

            }, array_keys( $array ), $array ) );

        }

        /**
        *
        * Filter
        *
        * @param  ARRAY $data
        * @param  STRING $sep
        * @param  STRING $type
        * @return ARRAY
        *
        */

        function Filter( $data, $type ) {

            switch ( $type ) {
                
                case 'input':
                    
                    foreach( $data as $k => &$v ) {
                        
                        if( strpos( $k, 'birthday' ) !== false )   $v = date_format( date_create( str_replace( '/', '-', $v ) ), 'Y-m-d' );
                        if( strpos( $k, 'address' ) !== false )    $v = json_encode($v);
                        
                    }

                    break;

                case 'output':

                    foreach( $data as $k => &$v ) {

                        if( strpos( $k, 'birthday' ) !== false )    $v = date_format( date_create( str_replace( '/', '-', $v ) ), 'Y-m-d' );

                    }

                    break;
            }

            return $data;

        }
    }

    class PDOStatement extends \PDOStatement {



        /**
        *
        * Debug
        *
        * @param  EMPTY
        * @return NULL
        *
        */

        function Debug() {

            ( new U\API )->Response( [ 'sql' => $this->queryString ] );

        }



    }
