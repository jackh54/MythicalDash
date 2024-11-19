<?php

use MythicalDash\App;
$router->get('/api/user/auth/login', function () : void { 
    App::init();
    $appInstance = App::getInstance(true);
    $config = $appInstance->getConfig();
    session_start();
    $csrf = new MythicalSystems\Utils\CSRFHandler();

    App::OK('Procced', [
        "input" => $csrf->input('login_form'),
    ]);


});

$router->post('/api/user/auth/login', function () : void { 

});



