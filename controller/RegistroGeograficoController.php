<?php
require_once __DIR__ . '/../init.php';
require_once __DIR__ . '/../model/RegistroGeograficoModel.php';

class RegistroGeograficoController {
    private $rgModel;

    public function __construct() {
        global $conn;
        $this->rgModel = new RegistroGeograficoModel($conn);
    }

    public function listar() {
        $cod_area = isset($_GET['cod_area']) ? intval($_GET['cod_area']) : 0;
        
        if ($cod_area <= 0) {
            header("Location: index.php?page=area");
            exit;
        }

        $quarteiroes = $this->rgModel->listarPorArea($cod_area);
        require_once __DIR__ . '/../view/rg.php';
    }
}
?>

