<?php
    /**
     * Created by PhpStorm.
     * User: triest
     * Date: 01.05.2020
     * Time: 15:44
     */
    include "BaseController.php";

    class IndexController extends BaseController
    {

        public function index()
        {
            $this->setVar("test", "test32");
            return $this->view("1");
        }

        public function post()
        {
            echo "post";
        }

    }