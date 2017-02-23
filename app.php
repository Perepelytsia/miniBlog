<?php
class App
{
	public static $name;
	public static  $author;
	public static $db_not_error = true;
	public static $db=null;

	private function checkDb()
	{
		if (!file_exists('database/'.self::$db)) {
			require_once('model/Model.php');
			$model = new Model();
			self::$db_not_error = $model->createDb(self::$db);
		}
	}
	public function __construct()
	{
		require_once('config.php');
		self::$name=$config['name'];
		self::$author=$config['author'];
		self::$db=$config['db'];
		$this->checkDb();
	}
	public function run()
	{
		$url=$_SERVER['REQUEST_URI'];
		$arr_url=explode("/", $url);

		$controller = empty($arr_url[1]) ? 'HomeController' : ucfirst($arr_url[1]).'Controller';
		$file ='controller/'.$controller.'.php';
		$action = empty($arr_url[2]) ? 'actionIndex' :'action'.$arr_url[2];

		if (isset($arr_url[2])) {
			if(ucfirst($arr_url[1])==='Message' and preg_match('/^\d+$/', $arr_url[2])) {
				$action = 'actionIndex';
			}
		}

		if (file_exists($file)) {
		   require_once($file);
		   $contr_obj = new $controller();
		   if (!method_exists($contr_obj, $action)) {
		   	   $action = 'actionError404';
			}
		} else {
			 unset($file);
		}

		if (empty($file) or isset($arr_url[3])) {
			$file ='controller/Controller.php';
		   	require_once($file);
			$controller = 'Controller';
			$contr_obj = new $controller();
		    $action = 'actionError404';
		}

		if(!self::$db_not_error and $action !== 'actionError404') {
			$action = 'actionErrorDb';
			$controller = 'Controller';
		}

		$contr_obj->$action();
	}
}
?>