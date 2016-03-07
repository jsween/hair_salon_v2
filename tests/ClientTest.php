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
        protected function tearDown()
        {
            Client::deleteAll();
            Stylist::deleteAll();
        }

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

        function test_save()
        {
            // Arrange
            $name = "Client";
            $stylist_id = 1;
            $test_Client = new Client($name, $stylist_id);
            // Act
            $test_Client->save();
            // Assert
            $result = Client::getAll();
            $this->assertEquals($test_Client, $result[0]);
        }

        function test_getAll()
        {
            // Arrange
            $name1 = "Client";
            $stylist_id = 2;
            $test_Client1 = new Client($name1, $stylist_id);
            $test_Client1->save();
            $name2 = "Client 2";
            $test_Client2 = new Client($name2, $stylist_id);
            $test_Client2->save();
            // Act
            $result = Client::getAll();
            // Assert
            $this->assertEquals([$test_Client1, $test_Client2], $result);
        }

        function test_deleteAll()
        {
            // Arrange
            $name1 = "Client";
            $stylist_id = 2;
            $test_Client1 = new Client($name1, $stylist_id);
            $test_Client1->save();
            $name2 = "Client 2";
            $test_Client2 = new Client($name2, $stylist_id);
            $test_Client2->save();
            // Act
            Client::deleteAll();
            $result = Client::getAll();
            // Assert
            $this->assertEquals([], $result);
        }


    }
 ?>
