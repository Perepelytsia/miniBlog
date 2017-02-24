<?php
require_once('Controller.php');
class HomeController extends Controller
{
	public function __construct()
	{
		require_once('model/HomeModel.php');
		$this->model = new HomeModel(App::$db);
	}

	public function actionIndex()
	{
		$this->result = $this->model->listMessage();
		if (is_array($this->result)) {
			$this->render('Home');
		} else {
			$this->actionErrorDb();
		}
	}

	public function actionAdd()
	{
		if (empty(trim($_POST['message'])) or empty(trim($_POST['author'])))
		{
			header("Location: /");
		} else {
			$this->result = $this->model->addMessage(trim($_POST['message']), trim($_POST['author']));
			if ($this->result) {
				header("Location: /");
			} else {
				$this->actionErrorDb();
			}
		}	
	}
}
?>