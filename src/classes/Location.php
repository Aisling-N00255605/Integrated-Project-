<?php
require_once 'DB.php';

class Location {

    public $id;
    public $name;

    public function __construct($props = null) {
        if ($props != null) {
            if (array_key_exists("id", $props)) {
                $this->id = $props["id"];
            }
            $this->name = $props["name"];
        }
    }

    public function save() {
        $db = null;
        try {
            $db = DB::getInstance()->getConnection();
        
            $params = [
                ":name" => $this->name
            ];

            if ($this->id === null) {
                $sql = "INSERT INTO locations (name) VALUES (:name)";
            }
            else {
                $sql = "UPDATE locations SET name = :name WHERE id = :id" ;
                $params[":id"] = $this->id;
            }
            $stmt = $db->prepare($sql);
            $status = $stmt->execute($params);
        
            if (!$status) {
                $error_info = $stmt->errorInfo();
                $message = "SQLSTATE error code = ".$error_info[0]."; error message = ".$error_info[2];
                throw new Exception("Database error executing database query: " . $message);
            }
        
            if ($stmt->rowCount() !== 1) {
                throw new Exception("Failed to save location.");
            }
        
            if ($this->id === null) {
                $this->id = $db->lastInsertId();
            }
        }
        finally {
            if ($db !== null) {
                $db = null;
            }
        }
    }

    public function delete() {
        $db = null;
        try {
            if ($this->id !== null) {
                $db = DB::getInstance()->getConnection();
        
                $sql = "DELETE FROM locations WHERE id = :id" ;
                $params = [
                    ":id" => $this->id
                ];
                $stmt = $db->prepare($sql);
                $status = $stmt->execute($params);
        
                if (!$status) {
                    $error_info = $stmt->errorInfo();
                    $message = "SQLSTATE error code = ".$error_info[0]."; error message = ".$error_info[2];
                    throw new Exception("Database error executing database query: " . $message);
                }
        
                if ($stmt->rowCount() !== 1) {
                    throw new Exception("Failed to delete location.");
                }
            }
        }
        finally {
            if ($db !== null) {
                $db = null;
            }
        }
    }

    public static function findAll() {
        $locations = array();
        $db = null;

        try {
            $db = DB::getInstance()->getConnection();

            $sql = "SELECT * FROM locations";
            $stmt = $db->prepare($sql);
            $status = $stmt->execute();

            if (!$status) {
                $error_info = $stmt->errorInfo();
                $message = "SQLSTATE error code = ".$error_info[0]."; error message = ".$error_info[2];
                throw new Exception("Database error executing database query: " . $message);
            }

            if ($stmt->rowCount() !== 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                while ($row !== FALSE) {
                    $location = new Location($row);
                    $locations[] = $location;

                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                }
            }
        }
        finally {
            if ($db !== null) {
                $db = null;
            }
        }

        return $locations;
    }

    public static function findById($id) {
        $location = null;
        $db = null;

        try {
            $db = DB::getInstance()->getConnection();

            $sql = "SELECT * FROM locations WHERE id = :id";
            $params = [
                ":id" => $id
            ];
            $stmt = $db->prepare($sql);
            $status = $stmt->execute($params);

            if (!$status) {
                $error_info = $stmt->errorInfo();
                $message = "SQLSTATE error code = ".$error_info[0]."; error message = ".$error_info[2];
                throw new Exception("Database error executing database query: " . $message);
            }

            if ($stmt->rowCount() !== 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $location = new Location($row);
            }
        }
        finally {
            if ($db !== null) {
                $db = null;
            }
        }

        return $location;
    }
}
?>
