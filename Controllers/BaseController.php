<?php
    /**
     * Created by PhpStorm.
     * User: triest
     * Date: 01.05.2020
     * Time: 16:36
     */


    class BaseController
    {
        private $vars = array();
        private $controller;
        public $layouts;


        function __construct($layouts = 'main')
        {
            $this->layouts = $layouts;
        }


        public function vars($varname, $value)
        {
            if (isset($this->vars[$varname]) == true) {
                return false;
            }
            $this->vars[$varname] = $value;
            return true;
        }

        public function view($name)
        {
            $pathLayout = SITE_PATH . 'views/layouts/' . $this->layouts . '.php';
            $contentPage = SITE_PATH . 'views/' . $this->controller . "/" . $name . '.php';

            if (file_exists($pathLayout) == false) {
                echo $pathLayout;
                echo "<br>";
                trigger_error('Layout `' . $this->layouts . '` does not exist.', E_USER_NOTICE);
                return false;
            }

            if (file_exists($contentPage) == false) {
                trigger_error('Template `' . $name . '` does not exist.', E_USER_NOTICE);
                return false;
            }

            foreach ($this->vars as $key => $value) {
                $$key = $value;
            }

            include($pathLayout);
        }

        public function setVar($name, $value)
        {
            if (isset($this->vars[$name]) == true) {
                trigger_error('Unable to set var `' . $name . '`. Already set, and overwrite not allowed.',
                        E_USER_NOTICE);
                return false;
            }
            $this->vars[$name] = $value;
            return true;
        }

    }