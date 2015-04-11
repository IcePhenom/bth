<?php
/**
 * User API.
 */
class CMovieDB extends CHTMLTable {
	private $query;
	private $variable;

	public function __construct($db){
		parent::__construct($db);
		$this->skip = array('Image','Genre');
		$this->editPage = 'eDB.php';
	}

	public function genres($genre){
		$res = $this->db->query('SELECT DISTINCT G.name FROM Genre AS G INNER JOIN Movie2Genre AS M2G ON G.id = M2G.idGenre');
		$genres = null;
		foreach($res as $val)
			$genres .= $val->name == $genre ? "$val->name ": "<a href='" . self::oldQuery(array('genre' => $val->name, 'page' => 1)) . "'>{$val->name}</a> ";
		return $genres;
	}

	public function movieMonth(){
		$month = date('n');
		$res = $this->db->SingleSelect('SELECT Title FROM VMovie WHERE Id = :id', array(':id' => $month));
		return $res['Title'];
	}

	public function showQuery(){
		return $this->query;
	}

	public function showVariable(){
		return print_r($this->variable, true);
	}

	public function show($orderBy, $order, $title, $from, $to, $genre, $perPage, $page){
		$query = "SELECT * FROM VMovie";
		$this->variable = array();

		$where = null;
		$limit = null;
		$sort  = " ORDER BY ".$orderBy." ".$order;

		if($title){
			$where .= " AND Title LIKE :title";
			$this->variable[':title'] = $title;
		}
		if($from) {
			$where .= " AND Year >= :from";
			$this->variable[':from'] = $from;
		}
		if($to) {
			$where .= " AND Year <= :to";
			$this->variable[':to'] = $to;
		}
		if($genre){
			$where .= " AND Genre LIKE :genre";
			$this->variable[':genre'] = "%".$genre."%";
		}

		if($perPage && $page)
		  $limit .= " LIMIT $perPage OFFSET ".(($page - 1) * $perPage);

		$where = $where? " WHERE 1{$where}" : null;
		$this->query = $query.$where.$sort.$limit;

		$maxPages = parent::maxPages("SELECT COUNT(Id) AS rows FROM VMovie".$where, $this->variable);

		return parent::printTable($this->query, $this->variable, $maxPages);
	}
}