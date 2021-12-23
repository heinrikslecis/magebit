<?php

namespace App\Libraries;

/*
* Base Controller
* Load the models and views
*/
class Controller {
    // Load model
    public function model($model) {
        // Model file
        $modelObject = "App\Models\\" . $model;

        // Instantiate model
        return new $modelObject();
    }

    // Load view
    public function view($view, $data = []) {
        // Check for view file
        if (file_exists("../app/Views/" . $view . ".php")) {
            require_once "../app/Views/" . $view . ".php";
        } else {
            // View does not exist
            die("View does not exist");
        }
    }
}