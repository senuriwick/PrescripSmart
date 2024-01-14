<?php
//This deals with the url and forms an array with the parameters and loads the specific controller
  class Core{

    protected $currentController = 'Pages';//stores the name of the current controller 
    protected $currentMethod = 'index';//st ores name of current method
    protected $params = [];//stores an array of parameters extracted from the URL
 
    public function __construct()
    {

       $url =  $this->getUrl();//extracts the url array using geturl()
       

      

       if(!empty($url[0]) && file_exists('../app/controllers/' . ucwords($url[0]) . '.php'))/**checks if the controller file
       corresponding to the 1st index of the url and ucwords function just capitalizes the first letter**/
        {
          $this->currentController = ucwords($url[0]);//if exist set to current controller
          unset($url[0]); 
        }

        else
        {
            
            echo"Array Index is null";
        }
         
          
         

        

        require_once '../app/controllers/'. $this->currentController . '.php';//includes the controller file
        $this->currentController = new $this->currentController;//instantiate a new object
     

        if(isset($url[1]))
        {
          if(method_exists($this->currentController, $url[1]))//checks if given object has a method as specified.
          {
            $this->currentMethod = $url[1];
            unset($url[1]);
          }
        }

      $this->params = $url ? array_values($url) : [];//sets the array of url to params if exist, if not for an empty array

      call_user_func_array([$this->currentController,$this->currentMethod], $this->params);//calls a method in a specified object 

    }

    public function getUrl()
    {
       if(isset($_GET['url']))//checks url is set and present  and isset() returns true if the variable is set
       {
        $url = rtrim($_GET['url'] , '/');//Prevents url ending with '/'
        $url = filter_var($url, FILTER_SANITIZE_URL);//Removes characters which are not allowed in a url 
        $url = explode('/' , $url);//splits the URL using '/' and turns each segment into an array
        
        return $url;

       }
    }
  }
    
  
