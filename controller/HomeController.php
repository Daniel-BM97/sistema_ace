<?php
require_once __DIR__ . '/../init.php';
require_once __DIR__ . '/../model/EstatisticasModel.php';

class HomeController {
    private $estatisticasModel;

    public function __construct() {
        global $conn;
        $this->estatisticasModel = new EstatisticasModel($conn);
    }

    public function index() {
        $total_areas = $this->estatisticasModel->contarAreas();
        $total_imoveis = $this->estatisticasModel->contarImoveis();
        $total_visitas = $this->estatisticasModel->contarVisitas();

        require_once __DIR__ . '/../view/index.php';
    }
}
?>

