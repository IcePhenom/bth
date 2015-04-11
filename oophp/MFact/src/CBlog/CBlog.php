<?php
/**
 * Blog API.
 */
class CBlog extends CContent {

	public function __construct($db) {
		parent::__construct($db);
	}

	public function getBlog($slug) {
		$slugSql = $slug ? 'slug = ?' : '1';
		$sql = "AND type = 'post' AND $slugSql ORDER BY updated DESC";
		return parent::getEntity($sql, array($slug));
	}
}