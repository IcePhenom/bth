<?php
/**
 * Page API.
 */
class CPage extends CContent {

	public function __construct($db) {
		parent::__construct($db);
	}

	public function getPage($url) {
		$sql = "AND type = 'page' AND url = ?";
		return parent::getEntity($sql, array($url));
	}
}