<?php
    /**
     * Created by PhpStorm.
     * User: triest
     * Date: 01.05.2020
     * Time: 23:16
     */

    class Model
    {

        public $id = null;

        /**
         * Get the table associated with the model.
         *
         * @return string
         */
        public function getTable()
        {
            return $this->table;
        }

        /**
         * Set the table associated with the model.
         *
         * @param  string $table
         * @return $this
         */
        public function setTable($table)
        {
            $this->table = $table;

            return $this;
        }


        public function save()
        {
            $vars = get_object_vars($this);

            $table = $vars["table"];

            unset($vars["table"]);

            if ($this->id == null) {
                $qwery_string = 'insert into `' . $table . '` (`' . implode("`,`",
                                array_keys($vars)) . '`) values ("' . implode("\",\"", array_values($vars)) . '")';
            } else {

                $valueSets = array();
                foreach ($vars as $key => $value) {
                    $valueSets[] = $key . " = '" . $value . "'";
                }
                $qwery_string = "UPDATE $table SET " . join(",", $valueSets) . " WHERE id=$this->id";
            }


            global $mysqli;

            $mysqli->query($qwery_string);

            if ($mysqli->errno == 0) {
                return true;
            } else {
                return $mysqli->errno;
            }

        }

    }