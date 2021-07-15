<?php

class Posts extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->postModel = $this->model('post');
        $this->userModel = $this->model('User');

    }

    public function index()
    {
        //Get Posts
        $posts = $this->postModel->getPosts();


        $data = [
            'posts' => $posts
        ];

        $this->view('posts/index', $data);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST Array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''
            ];

            //Validate Title
            if (empty($data['title'])) {
                $data['title_err'] = 'Please Enter Title';
            }

            //Validate Body
            if (empty($data['body'])) {
                $data['body_err'] = 'Please Enter Body Text';
            }

            //Make sure no error
            if (empty($data['title_err']) && empty($data['body_err'])) {
                //Validate
                if ($this->postModel->addPost($data)) {
                    flash('post_message', 'Post Added');
                    redirect('posts');
                } else {
                    die('Something went wrong');
                }
            } else {
                //Load View with errors
                $this->view('posts/add', $data);
            }

        } else {
            $data = [
                'title' => '',
                'body' => ''
            ];

            $this->view('posts/add', $data);
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST Array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''
            ];

            //Validate Title
            if (empty($data['title'])) {
                $data['title_err'] = 'Please Enter Title';
            }

            //Validate Body
            if (empty($data['body'])) {
                $data['body_err'] = 'Please Enter Body Text';
            }

            //Make sure no error
            if (empty($data['title_err']) && empty($data['body_err'])) {
                //Validate
                if ($this->postModel->updatePost($data)) {
                    flash('post_message', 'Post Updated');
                    redirect('posts');
                } else {
                    die('Something went wrong');
                }
            } else {
                //Load View with errors
                $this->view('posts/edit', $data);
            }

        } else {
            //Get Existing post from model
            $post=$this->postModel->getPostById($id);

            //check for owner
            if($post->user_id != $_SESSION['user_id']){
                redirect('posts');
            }

            $data = [
                'id' => $id,
                'title' => $post->title,
                'body' => $post->body
            ];

            $this->view('posts/edit', $data);
        }
    }

    public function comment($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST Array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'comment' => trim($_POST['comment']),
                'user_id' => $_SESSION['user_id'],
                'comment_err' => '',
            ];

            //Validate Title
//            if (empty($data['comment'])) {
//                $data['comment_err'] = 'Please Enter comment';
//            }

            //Validate Body

            //Make sure no error
            if (empty($data['comment_err'])) {
                //Validate
                if ($this->postModel->addComment($data)) {
                    flash('post_message', 'Comment Added');
                    redirect('posts');

                } else {
                    die('Something went wrong');
                }
            } else {
                //Load View with errors
                $this->view('posts/show', $data);
            }

        } else {
            $data = [
                'comment' => '',
            ];

            $this->view('posts/show'.$id , $data);
        }
    }

    public function show($id)
    {
        $post = $this->postModel->getPostById($id);
        $user = $this->userModel->getUserById($post->user_id);
        $comments=$this->postModel->getComments($id);

        $data = [
            'post' => $post,
            'user' => $user,
            'comments'=>$comments
        ];

        $this->view('posts/show', $data);
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $post=$this->postModel->getPostById($id);

            //check for owner
            if($post->user_id != $_SESSION['user_id']){
                redirect('posts');
            }
            if ($this->postModel->deletePost($id))
            {
                flash('post_message','Post removed');
                redirect('posts');
            }else{
                die('Something went wrong');
            }
        }else
        {
            redirect('posts');
        }
    }
    public function deleteComm($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $post=$this->postModel->getComments($id);

            //check for owner
            if($post->user_id != $_SESSION['user_id']){
                redirect('posts');
            }
            if ($this->postModel->deleteComment($id))
            {
                flash('post_message','Comment removed');
                redirect('posts');
            }else{
                die('Something went wrong');
            }
        }else
        {
            redirect('posts');
        }
    }

    public function replay($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST Array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'parent_comment_id'=>trim($_POST['parent_comment_id']),
                'comment' => trim($_POST['comment']),
                'user_id' => $_SESSION['user_id'],
                'comment_err' => '',
            ];

            //Validate Title
//            if (empty($data['comment'])) {
//                $data['comment_err'] = 'Please Enter comment';
//            }

            //Validate Body

            //Make sure no error
            if (empty($data['comment_err'])) {
                //Validate
                if ($this->postModel->addReplay($data)) {
                    flash('post_message', 'replay Added');
                    redirect('posts');

                } else {
                    die('Something went wrong');
                }
            } else {
                //Load View with errors
                $this->view('posts/show', $data);
            }

        } else {
            $data = [
                'comment' => '',
            ];

            $this->view('posts/show'.$id , $data);
        }
    }

}