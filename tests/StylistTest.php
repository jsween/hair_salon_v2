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

    }
 ?>
