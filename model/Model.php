<?php
class Model
{
	public function createDb($db)
	{	
		try {
			$db = new PDO("sqlite:database/".$db);
			$db->exec("CREATE TABLE IF NOT EXISTS messages (
                 		mess_id INTEGER PRIMARY KEY, 
                    	message TEXT NOT NULL, 
                    	author_id INTEGER NOT NULL, 
                    	date INTEGER NOT NULL)");
			$db->exec("CREATE TABLE IF NOT EXISTS comments (
                 		comm_id INTEGER PRIMARY KEY,
                 		mess_id INTEGER NOT NULL, 
                    	message TEXT NOT NULL, 
                    	author_id INTEGER NOT NULL, 
                    	date INTEGER NOT NULL)");
			$db->exec("CREATE TABLE IF NOT EXISTS authors (
                 		author_id INTEGER PRIMARY KEY,
                    	name TEXT NOT NULL)");
			$db = null;
		}
		catch (PDOException $Exception) {
			return false;
		}
		return true;
	}
}
?>