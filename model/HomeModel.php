<?php
class HomeModel
{
	private $db;
	public function __construct($db)
	{
		try {
			$this->db = new PDO("sqlite:database/".$db);
		}
		catch (PDOException $Exception) {
			App::$db_not_error = false;
		}
	}
	public function listMessage()
	{	
		try {
		    $result_arr=array();
			$result_pop = $this->db->query("SELECT new.mess_id, new.message, new.date, new.name, count(comments.message) AS quan_comm FROM (SELECT messages.mess_id, messages.message,  messages.date, authors.name FROM messages INNER JOIN authors ON messages.author_id = authors.author_id) AS new LEFT JOIN comments ON new.mess_id = comments.mess_id GROUP BY new.mess_id,  new.message, new.date, new.name ORDER BY quan_comm DESC LIMIT 5");
			$result_pop = $result_pop->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result_pop as &$arr) {
				if ($arr['new.date']) {
					$arr['new.date'] = date("m.d.y", $arr['new.date']);
					$arr['new.message'] = substr($arr['new.message'], 0, 100);
				}
			} 
			$result_arr[] = $result_pop;

			$result_date = $this->db->query("SELECT new.mess_id, new.message, new.date, new.name, count(comments.message) AS quan_comm FROM (SELECT messages.mess_id, messages.message, messages.date, authors.name FROM messages INNER JOIN authors ON messages.author_id = authors.author_id) AS new LEFT JOIN comments ON new.mess_id = comments.mess_id GROUP BY new.mess_id, new.message, new.date, new.name ORDER BY new.date DESC");
			$result_date=$result_date->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result_date as &$arr) {
				if ($arr['new.date']) {
					$arr['new.date'] = date("m.d.y", $arr['new.date']);
					$arr['new.message'] = substr($arr['new.message'], 0, 100);
				}
			}
			$result_arr[] = $result_date;

			$this->db = null;
		}
		catch (PDOException $Exception) {
			return false;
		}
		return $result_arr;
	}
	public function addMessage($message, $author)
	{	
		try {

			$date=time();

			$query = "SELECT author_id FROM authors WHERE name = :name";
    		$stmt = $this->db->prepare($query);
		    $stmt->bindParam(':name', $author);
		    $stmt->execute();
			$author_id = $stmt->fetch(PDO::FETCH_ASSOC);

			if (empty($author_id)) {
				$insert = "INSERT INTO authors (name) VALUES (:name)";
    			$stmt = $this->db->prepare($insert);
		    	$stmt->bindParam(':name', $author);
		    	$stmt->execute();

		    	$query = "SELECT author_id FROM authors WHERE name = :name";
    			$stmt = $this->db->prepare($query);
		    	$stmt->bindParam(':name', $author);
		    	$stmt->execute();
				$author_id = $stmt->fetch(PDO::FETCH_ASSOC);	
			}

			$insert = "INSERT INTO messages (message, author_id, date) 
                	VALUES (:message, :author_id, :date)";
    		$stmt = $this->db->prepare($insert);
		    $stmt->bindParam(':message', $message);
		    $stmt->bindParam(':author_id', $author_id['author_id']);
		    $stmt->bindParam(':date', $date);
		    $stmt->execute();
    		$this->db = null;
		}
		catch (PDOException $Exception) {
			return false;
		}
		return true;
	}
}
?>