<?php

class Controller{
    public function model($model){
        if(file_exists('../app/models/'.$model.'.php')){
            require_once '../app/models/'.$model.'.php';
            return new $model;
        }else{
            echo $model . ' does not exist';
        }
    }

    public function view($view, $data=[]){
        if(file_exists('../app/views/'.$view.'.php')){
            require_once '../app/views/'.$view.'.php';
        }else{
            die('View is not found');
        }
    }
}
