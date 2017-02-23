<?php 
class Controller
{
	protected $model;
	protected $result;
	protected function render($view)
	{
		require_once('view/'.$view.'.php');
	}
	public function actionError404()
	{
		$this->render('Error404');
	}
	public function actionErrorDb()
	{
		$this->render('ErrorDb');
	}
}	
?>
