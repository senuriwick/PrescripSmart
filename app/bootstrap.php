<?php

//require_once 'libraries/controller.php';
//require_once 'libraries/core.php';
//require_once 'libraries/database.php';

//Loading the helpers
require_once 'helpers/url_helper.php';
require_once 'helpers/session_helper.php';

//Loading config file
require_once 'config/config.php';


//Autoload the above core libraries
spl_autoload_register(function($className)//The className should be same as the file name like Core and Controller
{
    require_once 'libraries/' .$className. '.php';
});

