<?php
	/**
	* @backupGlobals disabled
	* @backupStaticAttributes disabled
	*/

	  require_once "src/Store.php";

	  $server = 'mysql:host=localhost:8889;dbname=shoes_test';
	  $username = 'root';
	  $password = 'root';
	  $DB = new PDO($server, $username, $password);

	class StoreTest extends PHPUnit_Framework_TestCase
	{
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
		$name = "Shoe Shoe";
		$id = 1;
		$test_store1 = new Store($name, $id);
		$test_store1->save();
		$name2 = "Blue Shoe";
		$id2 = 2;
		$test_store2 = new Store($name2, $id2);
		$test_store2->save();
		Store::deleteAll();
		$result = Store::getAll();
		$this->assertEquals([], $result);
	}
	}
?>
