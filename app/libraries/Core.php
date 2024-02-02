<?php


    /* Router | App Core Class */
    /* Routing url format : /controller/method/params */

    class Core {

        protected $currentController = 'Users';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct(){

            $url = $this->getUrl();

            // Find Controller
            if( $url && file_exists('../app/controllers/' . ucwords($url[0]) . '.php' ) )  {

                // If exists, set as controller
                $this->currentController = ucwords( $url[0] );

                // Unset 0 Index
                unset($url[0]);

            }


            // Require the controller
            // Require the controller
            require_once '../app/controllers/' . $this->currentController . '.php';


            // Instantiate controller class
            $this->currentController = new $this->currentController;

            // Find Method
            if(isset($url[1])){


                // Check to see if method exists in controller
                if( method_exists( $this->currentController , $url[1] ) ) {

                    $this->currentMethod = $url[1];

                    // Unset 1 index
                    unset($url[1]);

                }
            }

            // Get params
            $this->params = $url ? array_values($url) : [];

            // Call a callback with array of params
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        }

        public function getUrl(){

            if(isset($_GET['url'])){

                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                // print_r($url);
                return $url;

            }

        }

    }
