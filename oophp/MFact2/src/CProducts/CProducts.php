<?php
/**
 * Products API.
 */
class CProducts {
	private $db;
	private $perPage;
	private $page;
	private $order;
	private $o;
	private $hits;

	public function __construct($db) {
		$this->db = $db;
	}

	public function setup($perPage, $page, $order, $o){
		$this->perPage = $perPage;
		$this->page = $page;
		$this->order = $order;
		$this->o = $o;
		$this->hits = array(4, 8, 16);
	}

	public function oldQuery($options=array(), $prepend='?') {
		$query = array();
		parse_str($_SERVER['QUERY_STRING'], $query);
		$query = array_merge($query, $options);
		return $prepend . htmlentities(http_build_query($query));
	}

	public function pricePrint($price){
		return strlen($price)>5 ? substr_replace(substr_replace($price, " ", strlen($price)-5, 0), ".", strlen($price)-1, 0) : substr_replace($price, ".", strlen($price)-2, 0);
	}

	protected function pageNav($max, $min=1) {
		$ret = ($this->page != $min) ? "<a href='".self::oldQuery(array('page' => $min))."'>&lt;&lt;</a> " : '&lt;&lt; ';

		for($i=$min; $i<=$max; $i++)
			$ret .= $this->page == $i ? "$i ": "<a href='".self::oldQuery(array('page' => $i))."'>$i</a> ";

		$ret .= ($this->page != $max)? "<a href='".self::oldQuery(array('page' => $max))."'>&gt;&gt;</a> " : '&gt;&gt; ';
		return $ret;
	}

	public function listProducts($cat = null) {
		$var = array();
		$where = null;

		if($cat) {
			$where .= "AND category LIKE :cat";
			$var[':cat'] = "%".$cat."%";
		}

		$where = $where? "WHERE 1 {$where} " : null;

		$res1 = $this->db->query("SELECT COUNT(Id) AS rows FROM products ".$where, $var);
		$rows = $res1[0]->rows;
		$max = array($rows, ceil($rows / $this->perPage));

		$res = $this->db->query("SELECT * FROM products ".$where."ORDER BY ".$this->order." ".$this->o." LIMIT ".$this->perPage." OFFSET ".(($this->page - 1) * $this->perPage), $var);

		$data = array();
		$meta = array("max" => $max[0], "pageNav" => self::pageNav($max[1]), "oldQuery" => self::oldQuery(), "perPageNav" => "");
		foreach($this->hits AS $val)
			$meta['perPageNav'] .= $this->perPage == $val ? "$val " : "<a href='".self::oldQuery(array('perPage' => $val, 'page' => 1))."'>$val</a> ";

		if($this->db->numRows() > 0)
			foreach ($res as $row)
				$data[] = array("id" => $row->id, "img" => $row->img, "manufacture" => $row->manufacture, "prodName" => $row->prod_name, "cpu" => $row->cpu, "clock" => $row->cpu_clock, "hdd" => $row->hdd_size, "ram" => $row->ram, "price" => self::pricePrint($row->price));

		return array($meta, $data);
	}

	public function getProduct($id) {
		$row = $this->db->query("SELECT * FROM products WHERE id = :id", array(':id' => $id));

		$scr = ($row[0]->screen_size != null)? "Screen size: ".$row[0]->screen_size : "" ;
		$res = ($row[0]->screen_res != null)? "Screen resolution: ".$row[0]->screen_res : "" ;

		$ret = array("scr" => $scr, "res" => $res, "category" => $row[0]->category, "type" => $row[0]->type, "img" => $row[0]->img, "prodName" => $row[0]->prod_name, "cpu" => $row[0]->cpu, "clock" => $row[0]->cpu_clock, "ram" => $row[0]->ram, "hdd" => $row[0]->hdd_size, "price" => self::pricePrint($row[0]->price), "manufacture" => $row[0]->manufacture, "os" => $row[0]->os, "gpu" => $row[0]->gpu, "info" => nl2br($row[0]->description));

		return $ret;
	}

	public function frontProduct(){
		$res = $this->db->query("SELECT * FROM products ORDER BY id DESC LIMIT 4");
		$ret = array();

		foreach ($res as $row)
			$ret[] = array("id" => $row->id, "img" => $row->img, "manufacture" => $row->manufacture, "prodName" => $row->prod_name);

		return $ret;
	}
}
