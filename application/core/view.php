<?php

class View
{

	private $js = [];

	function generate($content_view, $template_view, $data = null)
	{

		$content = $this->requireToVar('application/views/'.$content_view, $data);
		include 'application/views/'.$template_view;

	}

	private function requireToVar($file, $data = []){

		ob_start();

		extract($data, EXTR_PREFIX_SAME, "wddx");

		require($file);
		return ob_get_clean();

	}

	function registerJs($name) {

		$this->js[] = $name;

	}

	function endPage() {

		foreach($this->js as $jsfile) {
			echo '<script type="text/javascript" src="/web/js/'.$jsfile.'"></script>';
		}

	}

}
