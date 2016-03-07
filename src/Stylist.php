<?php
    class Stylist
    {
        private $id;
        private $name;

        function __construct($name, $id=null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        function setName($name)
        {
            $this->name = (string) $name;
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
            $GLOBALS['DB']->exec("INSERT INTO stylists (name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists;");
            $stylists = array();
            foreach ($returned_stylists as $stylist) {
                $name = $stylist['name'];
                $id = $stylist['id'];
                $new_stylist = new Stylist($name, $id);
                array_push($stylists, $new_stylist);
            }
            return $stylists;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->query("DELETE FROM stylists;");
            // $GLOBALS['DB']->query("DELETE FROM clients;");
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE stylists SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        static function find($search_id)
        {
            $found_stylist = NULL;
            $stylists = Stylist::getAll();
            foreach ($stylists as $stylist) {
                if ($stylist->getId() == $search_id) {
                    $found_stylist = $stylist;
                }
            }
            return $found_stylist;
        }



    }
 ?>
