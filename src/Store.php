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
		}
	//Static Functions
		static function deleteAll()
		{
			$GLOBALS['DB']->exec("DELETE FROM stores;");
			$GLOBALS['DB']->exec("DELETE FROM brands_stores;");
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
		static function find($search_id)
		{
			$found_store = null;
			$stores = Store::getAll();

			foreach($stores as $store) {
			$store_id = $store->getId();
				if ($store_id == $search_id) {
				  $found_store = $store;
				}
			}
			return $found_store;
		}
	//End Static Functions
		function updateName($new_name)
		{
			$GLOBALS['DB']->exec("UPDATE stores SET names = '{$new_name}'
			WHERE id = {$this->getId()};");

			$this->setName($new_name);
		}
		function deleteStore()
		{
			$GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
			$GLOBALS['DB']->exec("DELETE FROM brands_stores WHERE store_id = {$this->getId()};");
		}

		function addBrand($new_brand)
		{
			$GLOBALS['DB']->exec("INSERT INTO brands_stores (stores_id, brands_id)
			VALUES ({$this->getId()}, {$new_brand->getId()});");
		}
		function getBrands()
		{
			$found_brands = $GLOBALS['DB']->query("SELECT brands.* FROM stores
			JOIN brands_stores ON (stores.id = brands_stores.stores_id)
			JOIN brands ON (brands_stores.brands_id = brands.id)
			WHERE stores.id = {$this->getId()};");

			$brands = array();
			foreach($found_brands as $brand) {
				$name = $brand['names'];
				$id = $brand['id'];
				$new_brand = new Brand($name, $id);
				array_push($brands, $new_brand);
			}
			return $brands;
		}

		// function checkBrand($brand_name)
		// 	{
		// 		$new_brand = null;
		// 			if(Brand::findByName($brand_name))
		// 			{
		// 			 $new_brand = Brand::findByName($brand_name);
		// 			}else{
		// 			 $new_brand = new Brand($brand_name);
		// 			 $new_brand->save();
		// 			}
		// 		return $new_brand;
		// 	}

	}
 ?>
