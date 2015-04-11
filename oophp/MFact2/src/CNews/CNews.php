<?php
/**
 * Content API.
 */
class CNews {
	private $db;
	private $filter;

	public function __construct($db) {
		$this->db = $db;
		$this->filter = new CFilter();
	}

	public function oldQuery($options=array(), $prepend='?') {
		$query = array();
		parse_str($_SERVER['QUERY_STRING'], $query);
		return $prepend . htmlentities(http_build_query(array_merge($query, $options)));
	}

	public function getAllNews($category = null){
		$var = array();
		$where = "";

		if($category) {
			$where = "AND category LIKE :cat ";
			$var[':cat'] = "%".$category."%";
		}

		$res = $this->db->query("SELECT * FROM news WHERE published <= NOW() ".$where."ORDER BY published DESC", $var);
		$ret = array();

		if(isset($res))
			foreach ($res as $cont)
				$ret[] = array("id" => $cont->id, "title" => htmlentities($cont->title, null, 'UTF-8'), "data" => $this->filter->doFilter(htmlentities($cont->short, null, 'UTF-8'), $cont->filter));

		return $ret;
	}

	public function getNews($id){
		$row = $this->db->query("SELECT * FROM news WHERE id = :id", array(':id' => $id));
		$ret = array("category" => $row[0]->category, "title" => htmlentities($row[0]->title, null, 'UTF-8'), "text" => $this->filter->doFilter(htmlentities($row[0]->long, null, 'UTF-8'), $row[0]->filter));
		return $ret;
	}
}