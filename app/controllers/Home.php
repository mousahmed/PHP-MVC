<?php
class Home extends Controller {
    public function __construct()
    {
        $this->userModel = $this->model('Post');
    }

    public function index(){
        $data = [
            'title' => 'PHP Blog',
            'description' => 'Simple Blog built on PHP MVC'
        ];
        return $this->view('index',$data);
    }

}