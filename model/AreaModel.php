<?php

namespace model;

class AreaModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function listarTodas() {
        $sql = "SELECT * FROM `area` ORDER BY nome_area ASC";
        $result = $this->conn->query($sql);
        $areas = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $areas[] = $row;
            }
        }

        return $areas;
    }
}
?>

