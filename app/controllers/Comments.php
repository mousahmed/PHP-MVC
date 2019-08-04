<?php

class Comments extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user_id'])) {
            redirect('users/login');
        }
        $this->commentModel = $this->model('Comment');
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        $comments = $this->commentModel->getComments();
        $data = [
            'comments' => $comments
        ];
        $this->view('comments/index', $data);
    }

    public function approve($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id' => $id,
                'status' => $_POST['status'],

            ];
            if ($this->commentModel->update($data)) {
                flash('success', 'The comment has been updated');
                redirect('/comments');
            } else {
                die('error in posts delete method');
            }
        } else {
            redirect('/comments');
        }
    }

    public function create()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'content' => trim($_POST['content']),
                'user_id' => $_POST['user_id'],
                'post_id' => $_POST['post_id'],
                'content_err' => '',
            ];

            if (empty($data['content'])) {
                $data['content_err'] = 'Please enter content';
            }

            if (empty($data['content_err'])) {
                if ($this->commentModel->create($data)) {
                    flash('success', 'The comment has been created and waiting for approval');
                    redirect('/posts/show/' . $_POST['post_id']);
                } else {
                    die('error with comment');
                }

            } else {
                flash('success', 'Please enter the comment Content', 'alert alert-danger');
                redirect('/posts/show/' . $_POST['post_id']);
            }

        }

    }
}