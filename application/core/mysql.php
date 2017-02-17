<?php

class Mysql {

    private static $instance = null;
    private $link;

    private function __construct() {
        $this->link = mysqli_connect("localhost", "root", "123456", "mvc");
    }

    public static function getInstance() {

        if (self::$instance == null){
            self::$instance = new self();
        }

        return self::$instance;

    }

    public function getTable($table, $options = []) {

        $query = "SELECT * FROM {$table} ";

        if(!empty($options['options']['where'])) {
            $query .= ' WHERE ' . $options['options']['where'][0] . ' = ' . $options['options']['where'][1] . ' ';
        }

        if(!empty($options['sort'])) {
            $query .= 'ORDER BY ' . $options['sort'];
            if(!empty($options['sort_route'])) {
                $query .= ' ' . $options['sort_route'];
            }
        }

        $result = mysqli_query($this->link, $query);
        $data_table = [];

        while($cur = mysqli_fetch_array($result)) {
            $data_table[] = $cur;
        }

        return $data_table;

    }

    public function inser_query($query) {
        mysqli_query($this->link, $query);
        return mysqli_insert_id($this->link);
    }

}
