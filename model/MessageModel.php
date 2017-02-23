<?php
class MessageModel
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
	public function singleMessage($mess_id)
	{	
		try {
		    $result_arr=array();
		    $query = "SELECT messages.mess_id, messages.message,  messages.date, authors.name FROM messages INNER JOIN authors ON messages.author_id = authors.author_id WHERE messages.mess_id = :mess_id";
    		$stmt = $this->db->prepare($query);
		    $stmt->bindParam(':mess_id', $mess_id);
		    $stmt->execute();
		    $row = $stmt->fetch(PDO::FETCH_ASSOC);
		    if ($row['date']) {
		    	$row['date'] = date("m.d.y", $row['date']);
		    }
			$result_arr[] = $row;

			$query = "SELECT comments.message,  comments.date, authors.name FROM comments INNER JOIN authors ON comments.author_id = authors.author_id WHERE comments.mess_id = :message_id ORDER BY comments.date DESC";
    		$stmt = $this->db->prepare($query);
		    $stmt->bindParam(':message_id', $mess_id);
		    $stmt->execute();
		    $commes = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    foreach ($commes as &$comm) {
		    	if ($comm['date']) {
		    		$comm['date'] = date("m.d.y", $comm['date']);
		    	}
			} 
			$result_arr[] = $commes;

			$this->db = null;
		}
		catch (PDOException $Exception) {
			return false;
		}
		return $result_arr;
	}
	public function addComment($mess_id, $comment, $author)
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

			$insert = "INSERT INTO comments (mess_id, message, author_id, date) 
                	VALUES (:mess_id, :message, :author_id, :date)";
    		$stmt = $this->db->prepare($insert);
    		$stmt->bindParam(':mess_id', $mess_id);
		    $stmt->bindParam(':message', $comment);
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