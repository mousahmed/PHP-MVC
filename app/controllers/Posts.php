<?php

class Posts extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user_id'])) {
            redirect('users/login');
        }
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
        $this->commentModel = $this->model('comment');
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $posts = $this->postModel->searchPosts($_POST['search']);
        }else {
            $posts = $this->postModel->getPosts();
        }
        $data = [
            'posts' => $posts,
            'search' => isset($_POST['search'])? $_POST['search'] : '' ,
        ];

        $this->view('posts/index', $data);
    }

    public function create()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => trim($_POST['title']),
                'content' => trim($_POST['content']),
                'user_id' => $_POST['user_id'],
                'title_err' => '',
                'content_err' => '',
            ];
            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter title';
            }

            if (empty($data['content'])) {
                $data['content_err'] = 'Please enter content';
            }

            if (empty($data['content_err']) && empty($data['title_err'])) {
                if ($this->postModel->create($data)) {
                    flash('success', 'The post has been created');
                    redirect('/posts');
                } else {
                    die('Something went wrong');
                }

            } else {

                $this->view('posts/create', $data);
            }

        } else {
            $data = [
                'title' => '',
                'content' => '',
                'user_id' => '',
                'title_err' => '',
                'content_err' => '',
            ];
            $this->view('posts/create', $data);
        }

    }

    public function show($id)
    {

        $post = $this->postModel->getPost($id);
        $user = $this->userModel->getUser($post->user_id);
        $comments = $this->commentModel->getPostComments($id);

        $data = [
            'post' => $post,
            'user' => $user,
            'comments' => $comments
        ];
        $this->view('/posts/show', $data);
    }

    public function edit($id)
    {
        $post = $this->postModel->getPost($id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'content' => trim($_POST['content']),
                'user_id' => $_POST['user_id'],
                'title_err' => '',
                'content_err' => '',
            ];
            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter title';
            }

            if (empty($data['content'])) {
                $data['content_err'] = 'Please enter content';
            }

            if (empty($data['content_err']) && empty($data['title_err'])) {
                if ($this->postModel->update($data)) {
                    flash('success', 'The post has been updated');
                    redirect('/posts');
                } else {
                    die('Something went wrong');
                }

            } else {

                $this->view('posts/edit', $data);
            }

        } else {
            $data = [
                'id' => $id,
                'title' => $post->title,
                'content' => $post->content,
                'user_id' => '',
                'title_err' => '',
                'content_err' => '',
            ];
            $this->view('posts/edit', $data);
        }

    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->postModel->delete($id)) {
                flash('success', 'The post has been deleted');
                redirect('/posts');
            } else {
                die('error in posts delete method');
            }
        } else {
            redirect('/posts');
        }
    }
}