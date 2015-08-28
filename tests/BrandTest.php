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

	class BrandTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
		{
    		Store::deleteAll();
            Brand::deleteAll();
		}

		function test_getName()
		{
	        //Arrange
	        $name = "Running";
	        $id = 1;
	        $test_brand = new Brand ($name, $id);
	        //Act
	        $result = $test_brand->getName();
	        //Assert
	        $this->assertEquals ($name, $result);
		}
		function test_setName()
		{
	        //Arrange
	        $name = "Running";
	        $id = 1;
	        $test_brand = new Brand ($name, $id);
	        //Act
	        $test_brand->setName("work");
	        $result = $test_brand->getName();
	        //Assert
	        $this->assertEquals($result, "work");
	 	}
		function test_getId()
		{
	        //Arrange
	        $id = 1;
	        $name = "Running";
	        $test_brand = new Brand ($name, $id);
	        //Act
	        $result = $test_brand->getId();
	        //Assert
	        $this->assertEquals(1, $result);
	    }
        function test_save()
        {
            //Arrange
            $name = "Running";
            $id = 1;
            $test_brand = new Brand($name, $id);
            //Act
            $test_brand->save();
            //Assert
            $result = Brand::getAll();
            $this->assertEquals($result[0], $test_brand);
        }
        function test_getAll()
        {
            //arrange
            $name = "Running";
            $id = 1;
            $test_brand1 = new Brand($name, $id);
            $test_brand1->save();

            $name2 = "work";
            $id2 = 2;
            $test_brand2 = new Brand($name2, $id2);
            $test_brand2->save();

            //act
            $result = Brand::getAll();
            //assert
            $this->assertEquals([$test_brand1, $test_brand2], $result);
        }
        function test_deleteAll()
        {
            //arrange
            $name = "Running";
            $id = 1;
            $test_brand1 = new Brand($name, $id);
            $test_brand1->save();
            //act
            $name2 = "work";
            $id2 = 2;
            $test_brand2 = new Brand($name2, $id2);
            $test_brand2->save();
            Brand::deleteAll();
            $result = Brand::getAll();
            //assert
            $this->assertEquals([], $result);
        }

    }
?>
