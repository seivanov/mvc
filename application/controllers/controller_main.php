<?php

class Controller_Main extends Controller
{

	function action_index()
	{

		$model = new Model_Tasks();
		$table = $model->get_data();

		$sort_route = isset($_GET['sort_route']) ? $_GET['sort_route'] : '';

		$this->view->generate('main_view.php', 'template_view.php', [
			'table' => $table,
			'sort_route' => $sort_route
		]);

	}

	function action_add() {

		$this->view->generate('main_add.php', 'template_view.php', [
		]);

	}

}