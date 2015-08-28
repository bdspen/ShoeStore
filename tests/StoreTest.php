<?php
	/**
	* @backupGlobals disabled
	* @backupStaticAttributes disabled
	*/

	  require_once "src/Store.php";

	  $server = 'mysql:host=localhost;dbname=shoes_test';
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
	}
?>
