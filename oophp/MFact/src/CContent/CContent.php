<?php
/**
 * Content API.
 */
class CContent {
	private $database;

	public function __construct($database) {
		$this->database = $database;
	}

	public function createDatabase() {
		$sql = "CREATE TABLE Content
				(
				  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
				  slug CHAR(80) UNIQUE,
				  url CHAR(80) UNIQUE,

				  TYPE CHAR(80),
				  title VARCHAR(80),
				  DATA TEXT,
				  FILTER CHAR(80),

				  published DATETIME,
				  created DATETIME,
				  updated DATETIME,
				  deleted DATETIME

				) ENGINE INNODB CHARACTER SET utf8;";
		$this->database->query($sql);
	}

	public function resetDatabase() {
		$sql = "DROP TABLE IF EXISTS Content;";
		$this->database->query($sql);
		self::createDatabase();
	}

	/**
	 * Create a link to the content, based on its type.
	 *
	 * @param object $content to link to.
	 * @return string with url to display content.
	 */
	public function getUrlToContent($content) {
	 	switch($content->TYPE) {
	    	case 'page': return "page.php?url={$content->url}"; break;
		    case 'post': return "blog.php?slug={$content->slug}"; break;
		    default: return null; break;
	  	}
	}

	public function getAllContent() {
		$sql = "SELECT *, IF(published >= NOW(), 'unpublished', 'published') AS stat FROM Content WHERE deleted IS NULL";
		return $this->database->query($sql);
	}

	public function getContent() {
		$sql = 'SELECT * FROM Content WHERE published <= NOW() AND deleted IS NULL';
		return $this->database->query($sql);
	}

	protected function getEntity($cond, $param = array()) {
		$sql = "SELECT * FROM Content WHERE published <= NOW() ".$cond;
		return $this->database->query($sql, $param);
	}

	public function add($param) {
		$sql = "INSERT INTO Content SET title = ?, slug = ?, url = ?, data = ?, type = ?, filter = ?, published = ?, created = NOW()";
		return $this->database->Insert($sql, $param);
	}

	public function save($param) {
		$sql = "UPDATE Content SET title = ?, slug = ?, url = ?, data = ?, type = ?, filter = ?, published = ?, updated = NOW() WHERE id = ?";
		return $this->database->Insert($sql, $param);
	}

	public function remove($param) {
		$sql = "UPDATE Content SET deleted = NOW() WHERE id = ?";
		return $this->database->Insert($sql, $param);
	}

	public function load($id) {
		$sql = 'SELECT * FROM Content WHERE id = ?';
		return $this->database->singleSelect($sql, array($id));
	}
}