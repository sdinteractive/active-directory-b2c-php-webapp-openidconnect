<?php

class Database {
	
	private function setUp() {
		require "settings.php";
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $conn;
	}
	
	public function fetchBlogPosts() {
		require "settings.php";
		
		$conn = $this->setUp();
	
		$sth = $conn->prepare("SELECT title, content, reg_date FROM blogPosts ORDER BY reg_date DESC");
		$sth->execute();
		$result = $sth->fetchAll();
		$conn = null;
		return $result;
	}
	
	public function newBlogPost($title, $content) {
		$conn = $this->setUp();
		$sql = "INSERT INTO blogPosts (title, content)
				VALUES ('".$title."', '".$content."')";
		$conn->exec($sql);
		
	}
}

?>