<?php
require_once('Controller.php');
class MessageController extends Controller
{
	public function __construct()
	{
		require_once('model/MessageModel.php');
		$this->model = new MessageModel(App::$db);
	}
	public function actionIndex()
	{
		$message_id=explode("/", $_SERVER['REQUEST_URI']);
		if (empty($message_id[2]) or !preg_match('/^\d+$/', $message_id[2])) {
			$this->actionError404();
		} else {
			$this->result = $this->model->singleMessage($message_id[2]);
			if (is_array($this->result)) {
				if (empty($this->result[0])) {
					$this->actionError404();
				} else {
					$this->render('Message');
				} 
			} else {
				$this->actionErrorDb();
			}
		}
	}
	public function actionAdd()
	{
		$url_page='/message/'.$_POST['mess_id'];
		if (empty(trim($_POST['comment'])) or empty(trim($_POST['user'])))
		{
			header("Location: $url_page");
		} else {
			$this->result = $this->model->addComment(trim($_POST['mess_id']), trim($_POST['comment']), trim($_POST['user']));
			if ($this->result) {
				header("Location: $url_page");
			} else {
				$this->actionErrorDb();
			}
		}	
	}
}
?>