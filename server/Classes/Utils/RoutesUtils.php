<?php
    
    namespace Utils;

    class RoutesUtils {
        public static function getRoutes() {
            $request = [];
            $urls = self::getUrls();

            $request['route'] = strtolower($urls[0]);
            $request['id'] = $urls[1] ? $urls[1] : null;
            $request['method'] = $_SERVER['REQUEST_METHOD'];
            // $request['recourse'] = $urls[1] ? $urls[1] : null;
            
            return $request;

        }
        
        public static function getUrls() {
            $url = str_replace('/'. DIR_PROJECT,'', $_SERVER['REQUEST_URI']);
            return explode('/', trim($url, '/'));
        }

    }
