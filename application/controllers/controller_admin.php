<?php

class Controller_Admin extends Controller
{

    function action_index()
    {

        if(isset($_GET['logout'])) {
            Authorize::logout();
            //Route::redirect('/');
        }

        if(!empty($_POST)) {

            if(Authorize::check($_POST['username'], $_POST['password']))
                Route::redirect('/');

        }

        if(Authorize::is_logged())
            Route::redirect('/');

        $model = new Model_Tasks();
        $table = $model->get_data();

        $this->view->generate('main_admin.php', 'template_view.php', [
            'table' => $table
        ]);

    }

    function action_edit() {

        $id = isset($_GET['id']) ? $_GET['id'] : '';

        $model = new Model_Tasks();
        $table = $model->get_data(['where' => ['id', $id]]);

        $files = new Model_Files();
        $tfiles = $files->get_data([
            'where' => ['task_id', $id]
        ]);

        $this->view->generate('main_edit.php', 'template_view.php', [
            'id' => (int)$id,
            'table' => $table,
            'files' => $tfiles
        ]);

    }

}