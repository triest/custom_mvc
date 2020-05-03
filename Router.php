<?php
    /**
     * Created by PhpStorm.
     * User: triest
     * Date: 01.05.2020
     * Time: 11:46
     */


    class Router
    {
        public $get_array;

        public $post_array;

        public $patch = null;

        public $controller;

        public $function;

        public $controller_file;

        /**
         * Router constructor.
         * @param null $patch
         */
        public function __construct()
        {
            $this->get_array = array();
            $this->post_array = array();
            $url = $_SERVER['REQUEST_URI'];

            $patch = parse_url($url, PHP_URL_PATH);
            //  var_dump($patch);

            $method = $_SERVER['REQUEST_METHOD'];
            include("web.php");

            /*autolaad classes*/
            /*
             * читаем выйды из папки
             * */

            $class_array = scandir("Models");

            spl_autoload_register(function ($item2) {
                $str = "Models/Model.php";
                include $str;
            });

            foreach ($class_array as $item) {
                if ($item != "." && $item != ".." && $item != "Model.php") {
                    /*
                     *
                     * */
                    $item2 = substr($item, 0, strpos($item, "."));
                    $str = "Models/" . $item2 . ".php";
                    include "$str";
                }
            }


            if ($method == "GET") {
                /*
                 * ищим в массиве путь
                 * */
                foreach ($this->get_array as $item) {
                    if ($item["root"] == $patch) {
                        include("Controllers/" . $item["controller"] . ".php");

                        $controller = new $item["controller"]();
                        $action = $item["action"];
                        $controller->$action();
                        return;
                    }
                }
                echo "Method Not Found";

            } elseif ($method == "POST") {
                foreach ($this->post_array as $item) {
                    if ($item["root"] == $patch) {
                        //      echo "\n found";
                        include("Controllers/" . $item["controller"] . ".php");

                        $controller = new $item["controller"]();
                        $action = $item["action"];
                        $controller->$action();
                        return;
                    }
                }
                echo "Method Not Found";
            }


        }

        public function get($root, $controller)
        {
            //  echo "<br>";
            $arr = explode("@", $controller);

            $temp = array("root" => $root, "controller" => $arr[0], "action" => $arr[1]);
            array_push($this->get_array, $temp);
        }

        public function post($root, $controller)
        {
            $arr = explode("@", $controller);

            $temp = array("root" => $root, "controller" => $arr[0], "action" => $arr[1]);
            array_push($this->post_array, $temp);
        }

    }