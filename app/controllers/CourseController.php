<?php

use core\Controller;

class CourseController extends Controller
{
    public function index()
    {
        $this->render('course/index', []);
    }

    public function create()
    {
        $this->render('course/create', []);
    }

    public function update($id)
    {
        
        $this->render('course/update', []);
    }

    public function delete($id)
    {
        $this->render('course/update', []);
    }

    private function loadModel($id)
    {
        // @todo load the model
    }
}