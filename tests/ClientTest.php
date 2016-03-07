<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once __DIR__.'/../src/Stylist.php';
    require_once __DIR__.'/../src/Client.php';

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_db_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase
    {
        // protected function tearDown()
        // {
        //     Client::deleteAll();
        //     Stylist::deleteAll();
        // }

        function test_getName()
        {
            // Arrange
            $name = "Client";
            $stylist_id = 1;
            $id = 3;
            $test_Client = new Client($name, $stylist_id, $id);
            // Act
            $result = $test_Client->getName();
            // Assert
            $this->assertEquals("Client", $result);
        }

        function test_getId()
        {
            // Arrange
            $name = "Client";
            $stylist_id = 1;
            $id = 3;
            $test_Client = new Client($name, $stylist_id, $id);
            // Act
            $result = $test_Client->getId();
            // Assert
            $this->assertEquals(3, $result);
        }

        function test_getStylistId()
        {
            // Arrange
            $name = "Client";
            $stylist_id = 1;
            $id = 3;
            $test_Client = new Client($name, $stylist_id, $id);
            // Act
            $result = $test_Client->getStylistId();
            // Assert
            $this->assertEquals(1, $result);
        }


    }
 ?>
