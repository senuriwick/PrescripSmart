<?php

//The Model interacts with data and database,communicates with the controller and sometimes updates the view
//The view usually consists of HTML and CSS and can be passed dynamic values from controller
//The Controller receives input from form,url etc,processes requests and passes data to the view



// DB Params
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'PRESCRIPSMART');

//App root definition
define('APPROOT' , dirname(dirname(__FILE__)));


//URL Root definition
define('URLROOT' , 'http://localhost/Prescripsmart');

//Site definition
define('SITENAME' , 'Prescripsmart');