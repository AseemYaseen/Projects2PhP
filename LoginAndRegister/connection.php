<?php

class crud {
    public static function connection(){
        try {
        $con= new PDO('mysql:localhost=host; dbname=register_cruds','root','');
        return $con;
        }catch (PDOException $error) {
            echo 'Not Connected'.$error->getMessage();
        }
           
        }
        public static function Users(){
        $data = array();
        $p=crud::connection()->prepare('SELECT * FROM userstable');
        $p->execute();
        $data = $p->fetchAll(PDO::FETCH_ASSOC);
        return $data;
        }

        public static function Deleted(){
            $con=crud::connection()->prepare("UPDATE userstable SET is_deleted='1' WHERE id=:id");
            return $con;
        }

    }
