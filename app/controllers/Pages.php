<?php
    class Pages extends Controller
    {
        public function __construct()
        {
            //echo 'Pages loaded';
//            $this->postModel = $this->model('Post');

        }
        public function index()
        {

            if(isLoggedIn())
            {
                redirect('posts');
            }

            $data = [
                'title' => 'Welcome',
                'description' => 'This page also used for the share the posts'
                    ];

            $this->view('pages/index',$data);
        }
        public function about()
        {
            $data = [
                'title' => 'About Us'
            ];
            $this->view('pages/about',$data);
        }
    }
?>