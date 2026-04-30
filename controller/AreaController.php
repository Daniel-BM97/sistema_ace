<?php
require_once __DIR__ . '/../init.php';
require_once __DIR__ . '/../model/AreaModel.php';

use model\AreaModel;

class AreaController {
    private $areaModel;

    public function __construct($areaModel = null) {
        if ($areaModel) {
            $this->areaModel = $areaModel;
        } else {
            global $conn;
            $this->areaModel = new AreaModel($conn);
        }
    }

    public function listar() {
        $areas = $this->areaModel->listarTodas();
        //require __DIR__ . '/../view/area.php';
        return $areas; // Retorna os dados para o teste
    }

}
?>

