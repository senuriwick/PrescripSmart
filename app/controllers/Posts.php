<?php
class Posts extends Controller
{
    public  function __construct()
    {
        if(!isLoggedIn())//If only if user logged in the admin add page accessible otherwise redirect to login page
        {
            redirect('users/login');

        }

        
    }
    public function index()
    {
        $data = [];
        $this->view('posts/index', $data);

    }

}
