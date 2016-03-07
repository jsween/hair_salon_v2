<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once __DIR__ . '/../src/Stylist.php';
    // require_once __DIR__ . '/../src/Client.php';
    $server = 'mysql:host=localhost:8889;dbname=hair_salon_db_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);
    class StylistTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Stylist::deleteAll();
            // Client::deleteAll();
        }

        function test_get_name()
        {
            //Arrange
			$stylist_name = "Stylist";
            $test_Stylist = new Stylist($stylist_name);
            //Act
            $result = $test_Stylist->getName();
            //Assert
            $this->assertEquals("Stylist", $result);
        }

        function test_getId()
        {
            // Arrange
            $name = "Stylist";
            $id = 1;
            $test_Stylist = new Stylist($name, $id);
            // Act
            $result = $test_Stylist->getId();
            // Assert
            $this->assertEquals(1, $result);
        }

        function test_save()
        {
            // Arrange
            $name = "Stylist";
            $test_Stylist = new Stylist($name);
            // Act
            $test_Stylist->save();
            // Assert
            $result = Stylist::getAll();
            $this->assertEquals($test_Stylist, $result[0]);
        }

    }
 ?>
