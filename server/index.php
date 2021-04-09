<?php

    use Validator as V;
    use Utils as U;

    include 'settings.php';

    try {
        $getRoutes =  ( new U\RoutesUtils )->getRoutes();
        $requestValidator = new V\RequestValidator($getRoutes);

        $return = $requestValidator->processRequest();

    }catch(Exception $exception){
        echo json_encode([
            U\ConstantsUtils::TYPE => U\ConstantsUtils::TYPE_ERROR,
            U\ConstantsUtils::RESPONSE => $exception->getMessage()
        ], JSON_THROW_ON_ERROR, 512);
        exit;
    }
