<?php
require_once 'DB.php';

class Author {

    public $id;
    public $first_name;
    public $last_name;

    public function __construct($props = null) {
        if ($props != null) {
            if (array_key_exists("id", $props)) {
                $this->id = $props["id"];
            }
            $this->first_name = $props["first_name"];
            $this->last_name  = $props["last_name"];
        }
    }

    public function save() {
        $db = null;
        try {
            $db = DB::getInstance()->getConnection();
        
            $params = [
                ":first_name" => $this->first_name,
                ":last_name"  => $this->last_name
            ];

            if ($this->id === null) {
                $sql = "INSERT INTO authors (first_name, last_name) VALUES (:first_name, :last_name)";
            }
            else {
                $sql = "UPDATE authors SET " .
                       "first_name = :first_name, " .
                       "last_name = :last_name " .
                       "WHERE id = :id" ;

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
                throw new Exception("Failed to save author.");
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
        
                $sql = "DELETE FROM authors WHERE id = :id" ;
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
                    throw new Exception("Failed to delete author.");
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
        $authors = array();
        $db = null;

        try {
            $db = DB::getInstance()->getConnection();

            $sql = "SELECT * FROM authors";
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
                    $author = new Author($row);
                    $authors[] = $author;

                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                }
            }
        }
        finally {
            if ($db !== null) {
                $db = null;
            }
        }

        return $authors;
    }

    public static function findById($id) {
        $author = null;
        $db = null;

        try {
            $db = DB::getInstance()->getConnection();

            $sql = "SELECT * FROM authors WHERE id = :id";
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
                $author = new Author($row);
            }
        }
        finally {
            if ($db !== null) {
                $db = null;
            }
        }

        return $author;
    }
}
?>
