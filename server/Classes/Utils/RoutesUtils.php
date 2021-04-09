<?php
    
    namespace Utils;

    class RoutesUtils {
        public static function getRoutes() {
            $request = [];
            $urls = self::getUrls();

            $request['route'] = strtolower($urls[0]);
            $request['recourse'] = $urls[1] ? $urls[1] : null;
            $request['id'] = $urls[2] ? $urls[2] : null;
            $request['method'] = $_SERVER['REQUEST_METHOD'];

            return $request;

        }
        
        public static function getUrls() {
            $url = str_replace('/'. DIR_PROJECT,'', $_SERVER['REQUEST_URI']);
            return explode('/', trim($url, '/'));
        }

    }
