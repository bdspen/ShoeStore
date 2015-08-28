<?php

	class Store
	{
		private $name;
		private $id;

		function __construct($name, $id = null)
		{
			$this->name = $name;
			$this->id = $id;
		}
		function setName($new_name)
		{
			$this->name = $new_name;
		}
		function getName()
		{
			return $this->name;
		}
		function getId()
		{
			return $this->id;
		}
		function save()
		{
			$GLOBALS['DB']->exec("INSERT INTO stores (names)
			VALUES ('{$this->getName()}');");
			$this->id = $GLOBALS['DB']->lastInsertId();
			$GLOBALS['DB']->exec("INSERT INTO copies (store_id) VALUES ({$this->getId()})");
		}
		static function deleteAll()
		{
			$GLOBALS['DB']->exec("DELETE FROM stores;");
			$GLOBALS['DB']->exec("DELETE FROM stores_authors;");
		}
		static function getAll()
		{
			$returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
			$stores = array();
			foreach($returned_stores as $store) {
			$name = $store['names'];
			$id = $store['id'];
			$new_store = new Store ($name, $id);
			array_push($stores, $new_store);
		}
			return $stores;
		}
	}
 ?>
