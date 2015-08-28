<?php
	/**
	* @backupGlobals disabled
	* @backupStaticAttributes disabled
	*/

	  require_once "src/Store.php";
	  require_once "src/Brand.php";

	  $server = 'mysql:host=localhost:8889;dbname=shoes_test';
	  $username = 'root';
	  $password = 'root';
	  $DB = new PDO($server, $username, $password);

	class StoreTest extends PHPUnit_Framework_TestCase
	{
		protected function tearDown()
		{
			Store::deleteAll();
			Brand::deleteAll();
		}

		function test_getName()
		{
	        //Arrange
	        $name = "Shoe One";
	        $id = 1;
	        $test_store = new Store ($name, $id);
	        //Act
	        $result = $test_store->getName();
	        //Assert
	        $this->assertEquals ($name, $result);
		}
		function test_setName()
		{
	        //Arrange
	        $name = "Shoe One";
	        $id = 1;
	        $test_store = new Store ($name, $id);
	        //Act
	        $test_store->setName("Source Shoe");
	        $result = $test_store->getName();
	        //Assert
	        $this->assertEquals($result, "Source Shoe");
	 	}
		function test_getId()
		{
	        //Arrange
	        $id = 1;
	        $name = "Shoe One";
	        $test_store = new Store ($name, $id);
	        //Act
	        $result = $test_store->getId();
	        //Assert
	        $this->assertEquals(1, $result);
	    }
		function test_save()
		{
			//Arrange
			$name = "Shoe One";
			$id = 1;
			$test_store = new Store($name, $id);
			//Act
			$test_store->save();
			//Assert
			$result = Store::getAll();
			$this->assertEquals($result[0], $test_store);
		}
		function test_getAll()
		{
			//arrange
			$name = "Shoe Shoe";
			$id = 1;
			$test_store1 = new Store($name, $id);
			$test_store1->save();

			$name2 = "Blue Shoe";
			$id2 = 2;
			$test_store2 = new Store($name2, $id2);
			$test_store2->save();

			//act
			$result = Store::getAll();
			//assert
			$this->assertEquals([$test_store1, $test_store2], $result);
		}
		function test_deleteAll()
		{
			//arrange
			$name = "Shoe Shoe";
			$id = 1;
			$test_store1 = new Store($name, $id);
			$test_store1->save();
			//act
			$name2 = "Blue Shoe";
			$id2 = 2;
			$test_store2 = new Store($name2, $id2);
			$test_store2->save();
			Store::deleteAll();
			$result = Store::getAll();
			//assert
			$this->assertEquals([], $result);
		}
		function test_find()
		{	//arrange
			$name = "A Shoe Store";
			$id = 1;
			$test_store1 = new Store ($name, $id);
			$test_store1->save();

			$name2 = "Down by the riverside";
			$id2 = 2;
			$test_store2 = new Store ($name2, $id2);
			$test_store2->save();
			//act
			$result = Store::find($test_store2->getId());
			//assert
			$this->assertEquals($test_store2, $result);
		}
		function testUpdateName()
		{
			//arrange
			$name = "Store1";
			$id = 1;
			$test_store = new Store($name, $id);
			$test_store->save();
			$new_name = "Store2";
			//act
			$test_store->updateName($new_name);
			//arrange
			$this->assertEquals("Store2", $test_store->getName());
		}
		function testDeleteStore()
		{
			//arrange
			$name = "Store1";
			$id = 1;
			$test_store = new Store($name, $id);
			$test_store->save();
			$name2 = "Store2";
			$id2 = 2;
			$test_store2 = new Store($name2, $id2);
			$test_store2->save();
			//act
			$test_store->deleteStore();
			//assert
			$this->assertEquals([$test_store2], Store::getAll());
		}


        function testAddBrand()
        {
            //Arrange
            $name = "ShoeStore";
            $id = 1;
            $test_store = new Store ($name, $id);
            $test_store->save();

            $name = "Asics";
            $id2 = 2;
            $test_brand = new Brand ($name, $id2);
            $test_brand->save();
            //Act
            $test_store->addBrand($test_brand);
            $result = $test_store->getBrands();
            //Assert
            $this->assertEquals([$test_brand], $result);
        }
        function testGetBrands()
        {

            $name = "ShoeStore";
            $id = 1;
            $test_store = new Store ($name, $id);
            $test_store->save();

			$name = "Asics";
			$id3 = 3;
			$test_brand = new Brand($name, $id3);
			$test_brand->save();

			$name2 = "Nike";
			$id2 = 2;
			$test_brand2 = new Brand ($name2, $id2);
			$test_brand2->save();
            //Act
            $test_store->addBrand($test_brand);
            $test_store->addBrand($test_brand2);
            //Assert
            $this->assertEquals($test_store->getBrands(), [$test_brand, $test_brand2]);
        }
	}
?>
