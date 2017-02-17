<?php

require_once(BASEPATH.'/application/common/image.php');

class Controller_Ajax extends Controller
{

	function action_addtask()
	{

		$form = $_POST['form'];

		$params = array();
		parse_str($_POST['form'], $params);

		$model_task = new Model_Tasks();
		$model_files = new Model_Files();

		$model_task->load([
			'username' => $params['username'],
			'email' => $params['email'],
			'message' => $params['message'],
		]);

		$task_id = $model_task->insert();

		if(isset($_POST['gallery']) && is_array($_POST['gallery'])) {
			$gallery = $_POST['gallery'];
			foreach($gallery as $index => $img) {

				$ext = end(explode(".", $img['name']));

				$i_name = md5($img['name'] . time()) . '.' . $ext;
				$i_data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $img['data']));

				file_put_contents(BASEPATH . '/web/img/upload/' . $i_name, $i_data);

				$model_files->load([
					'task_id' => $task_id,
					'name' => $i_name
				]);

				$model_files->insert();

			}
		}

	}

	function action_edittask()
	{

		$done = $_POST['done'];
		$message = $_POST['message'];
		$id = $_POST['id'];

		$model_task = new Model_Tasks();

		$model_task->load([
			'done' => $done,
			'message' => $message,
		]);

		$task_id = $model_task->update($id);

	}

}
