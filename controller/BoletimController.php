<?php
require_once __DIR__ . '/../init.php';
require_once __DIR__ . '/../model/EstatisticasModel.php';

class BoletimController {
    private $estatisticasModel;

    public function __construct() {
        global $conn;
        $this->estatisticasModel = new EstatisticasModel($conn);
    }

    public function index() {
        $data_filtro = isset($_POST['data_filtro']) && !empty($_POST['data_filtro']) ? $_POST['data_filtro'] : '';
        $rows = $this->estatisticasModel->buscarBoletimDiario($data_filtro);
        
        require_once __DIR__ . '/../view/boletim_diario.php';
    }
}
?>

