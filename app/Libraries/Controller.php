<?php

namespace App\Libraries;

class Controller {

    public function model($model){
        if(file_exists('../app/Models/'.$model.'.php')){
            require_once '../app/Models/'.$model.'.php';
            return (new $model());
        } else {
            //header('Location: http://www.site.com/error');
            exit;
        }
    }

    public function service($service){
        if(file_exists('../app/Services/'.$service.'.php')){
            require_once '../app/Services'.$service.'.php';
            return (new $service());
        } else {
            header("Location:'.URLROOT.'error'");
            exit;
        }
    }
}