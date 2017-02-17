<?php

abstract class Model {

	protected $bd;
	protected $table_name;
	protected $fields = [];

	public function __construct() {
		$this->bd = Mysql::getInstance();
		$table_name = strtolower(
			preg_replace("#^Model_#", '', get_class($this))
		);
		$this->table_name = $table_name;
	}

	function get_data($options = []) {

		$sort = isset($_GET['sort']) ? $_GET['sort'] : '';
		$sort_route = isset($_GET['sort_route']) ? $_GET['sort_route'] : '';

		return $this->bd->getTable($this->table_name, [
			'sort' => $sort,
			'sort_route' => $sort_route,
			'options' => $options
		]);
	}

	function load($data) {

		foreach($data as $key => $val)
			$this->fields[$key] = $val;

	}

	function insert() {

		$query = "INSERT INTO {$this->table_name} SET ";

		$counter = 0;
		foreach($this->fields as $field => $value) {
			$query .= $field . "='{$value}'";
			if(++$counter < count($this->fields))
				$query .= ", ";
		}

		return $this->bd->inser_query($query);

	}

	function update($id) {

		$query = "UPDATE {$this->table_name} SET ";

		$counter = 0;
		foreach($this->fields as $field => $value) {
			$query .= $field . "='{$value}'";
			if(++$counter < count($this->fields))
				$query .= ", ";
		}

		$query .= " WHERE id = " . $id;

		return $this->bd->inser_query($query);

	}

}
