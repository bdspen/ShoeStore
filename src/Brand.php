<?php

	class Brand
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
            $GLOBALS['DB']->exec("INSERT INTO brands (names)
            VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }
    //Static Functions
        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands;");
            $GLOBALS['DB']->exec("DELETE FROM brands_brands;");
        }
        static function getAll()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
            $brands = array();
            foreach($returned_brands as $brand) {
            $name = $brand['names'];
            $id = $brand['id'];
            $new_brand = new Brand ($name, $id);
            array_push($brands, $new_brand);
        }
            return $brands;
        }
        static function find($search_id)
        {
            $found_brand = null;
            $brands = Brand::getAll();

            foreach($brands as $brand) {
            $brand_id = $brand->getId();
                if ($brand_id == $search_id) {
                  $found_brand = $brand;
                }
            }
        return $found_brand;
        }

		function addStore($new_store)
		{
			$GLOBALS['DB']->exec("INSERT INTO brands_stores (stores_id, brands_id)
			VALUES ({$new_store->getId()},
			 {$this->getId()});");
		}
		function getStores()
		{
			$found_stores = $GLOBALS['DB']->query("SELECT stores.* FROM brands
			JOIN brands_stores ON (brands.id = brands_stores.brands_id)
			JOIN stores ON (brands_stores.stores_id = stores.id)
			WHERE brands.id = {$this->getId()};");

			$stores = array();
			foreach($found_stores as $store) {
				$name = $store['names'];
				$id = $store['id'];
				$new_store = new Store($name, $id);
				array_push($stores, $new_store);
			}
			return $stores;
		}

    //End Static Functions
    }
?>
