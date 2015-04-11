<?php
/**
 * User API.
 */
class CHTMLTable {
	protected $db;
	protected $skip;
	protected $editPage;
	private $perPage;
	private $page;
	private $user;

	public function __construct($db){
		$this->db = $db;
	}

	public function setup($perPage, $page, $user){
		$this->perPage = $perPage;
		$this->page = $page;
		$this->user = $user;
	}

	protected function oldQuery($options=array(), $prepend='?') {
		$query = array();
		parse_str($_SERVER['QUERY_STRING'], $query);
		$query = array_merge($query, $options);
		return $prepend . htmlentities(http_build_query($query));
	}

	protected function perPage() {
		$hits = array(2, 4, 8);
		$ret = "Results per page: ";
		foreach($hits AS $val)
			$ret .= $this->perPage == $val ? "$val ": "<a href='".self::oldQuery(array('perPage' => $val, 'page' => 1))."'>$val</a> ";
		return $ret;
	}

	protected function pageNav($max, $min=1) {
		$ret  = ($this->page != $min) ? "<a href='".self::oldQuery(array('page' => $min))."'>&lt;&lt;</a> " : '&lt;&lt; ';
		$ret .= ($this->page > $min) ? "<a href='".self::oldQuery(array('page' => ($this->page > $min ? $this->page - 1 : $min)))."'>&lt;</a> " : '&lt; ';

		for($i=$min; $i<=$max; $i++)
			$ret .= $this->page == $i ? "$i ": "<a href='".self::oldQuery(array('page' => $i))."'>$i</a> ";

		$ret .= ($this->page < $max)? "<a href='".self::oldQuery(array('page' => ($this->page < $max ? $this->page + 1 : $max) ))."'>&gt;</a> " : '&gt; ';
		$ret .= ($this->page != $max)? "<a href='".self::oldQuery(array('page' => $max))."'>&gt;&gt;</a> " : '&gt;&gt; ';
		return $ret;
	}

	protected function order($col){
		$old = self::oldQuery();
		return "<a href='{$old}&amp;order={$col}&amp;o=asc'>&#8659;</a><a href='{$old}&amp;order={$col}&amp;o=desc'>&#8657;</a>";
	}

	protected function printHead($row){
		$ret = "<th>Row</th>";
		foreach ($row as $key => $value)
			$ret .= !in_array($key, $this->skip)?"<th>".$key.self::order($key)."</th>" : "<th>".$key."</th>";
		if($this->user->login_check())
			$ret .= "<th>Edit</th><th>Delete</th>";
		return $ret;
	}

	protected function printRows($rows){
		$ret = "<tr>".self::printHead($rows[0])."</tr>";
		$count = 0;
		foreach ($rows as $row) {
			$ret .= "<tr><td>".$count++."</td>";
			$id = null;
			foreach ($row as $key => $value){
				if($key == "Id")
					$id = $value;
				$ret .= $key == "Image"? "<td><img class='logo' src='".$value."' alt='image'></td>":"<td>".$value."</td>";
			}
			if($this->user->login_check())
				$ret .= "<th><a href='".$this->editPage."?edit=".$id."'><img src='img/edit.png' alt='edit'></a></th><th><a href='".$this->editPage."?del=".$id."'><img src='img/delete.png' alt='delete'></a></th>";
			$ret .= "</tr>";
		}
		return $ret;
	}

	protected function maxPages($Q, $variable){
		$res = $this->db->query($Q, $variable);
		$rows = $res[0]->rows;
		return array($rows, ceil($rows / $this->perPage));
	}

	public function printTable($query, $variable = array(), $maxPages){
		$res = $this->db->query($query, $variable);
		$nbr = $this->db->numRows();

		$ret = "<div class='dbtable'>
		<div class='center'>".$maxPages[0]." hits. ".self::perPage()."</div>
			<table>";

		$ret .= $nbr > 0 ? self::printRows($res): "<tr><td>No result found with search parameters</td></tr>";

		$ret .= "</table>
				<div class='center'>".self::pageNav($maxPages[1])."</div>
				</div>
		";
		return $ret;
	}
}