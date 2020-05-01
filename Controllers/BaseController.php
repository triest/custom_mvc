<?php
    /**
     * Created by PhpStorm.
     * User: triest
     * Date: 01.05.2020
     * Time: 16:36
     */

    private
    $vars = array();
    private
    $controller;

    class BaseController
    {

        function vars($varname, $value)
        {
            if (isset($this->vars[$varname]) == true) {
                return false;
            }
            $this->vars[$varname] = $value;
            return true;
        }

        function view($name)
        {

        }

    }