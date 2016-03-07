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

        function test_getAll()
        {
            // Arrange
            $name1 = "Stylist";
            $test_Stylist1 = new Stylist($name1);
            $test_Stylist1->save();
            $name2 = "Stylist 2";
            $test_Stylist2 = new Stylist($name2);
            $test_Stylist2->save();
            // Act
            $result = Stylist::getAll();
            // Assert
            $this->assertEquals([$test_Stylist1, $test_Stylist2], $result);
        }

        function test_deleteAll()
        {
            // Arrange
            $name1 = "Stylist";
            $test_Stylist1 = new Stylist($name1);
            $test_Stylist1->save();
            $name2 = "Stylist 2";
            $test_Stylist2 = new Stylist($name2);
            $test_Stylist2->save();
            // Act
            Stylist::deleteAll();
            $result = Stylist::getAll();
            // Assert
            $this->assertEquals([], $result);
        }

        function test_update()
        {
            // Arrange
            $name = "Stylist";
            $test_Stylist = new Stylist($name);
            $test_Stylist->save();
            $new_name = "Stylist Updated";
            // Act
            $test_Stylist->update($new_name);
            $result = $test_Stylist->getName();
            // Assert
            $this->assertEquals($new_name, $result);
        }

        function test_find()
        {
            // Arrange
            $name1 = "Stylist";
            $test_Stylist1 = new Stylist($name);
            $test_Stylist1->save();
            $name2 = "Stylist 2";
            $test_Stylist2 = new Stylist($name2);
            $test_Stylist2->save();
            // Act
            $id = $test_Stylist1->getId();
            $result = Stylist::find($id);
            // Assert
            $this->assertEquals($test_Stylist1, $result);
        }

        function test_delete()
        {
            // Arrange
            $name1 = "Stylist";
            $test_Stylist1 = new Stylist($name);
            $test_Stylist1->save();
            $name2 = "Stylist 2";
            $test_Stylist2 = new Stylist($name2);
            $test_Stylist2->save();
            // Act
            $test_Stylist1->delete();
            // Assert
            $this->assertEquals([$test_Stylist2], Stylist::getAll());
        }

    }
 ?>
