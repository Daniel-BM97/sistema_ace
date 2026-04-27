<?php
require_once __DIR__ . '/../init.php';
require_once __DIR__ . '/../model/ImovelModel.php';
require_once __DIR__ . '/../model/RegistroGeograficoModel.php';
require_once __DIR__ . '/../model/VisitaModel.php';

class VisitaController {
    private $imovelModel;
    private $rgModel;
    private $visitaModel;

    public function __construct() {
        global $conn;
        $this->imovelModel = new ImovelModel($conn);
        $this->rgModel = new RegistroGeograficoModel($conn);
        $this->visitaModel = new VisitaModel($conn);
    }

    public function criar() {
        $id_imovel = isset($_GET['id_imovel']) ? intval($_GET['id_imovel']) : 0;

        if ($id_imovel <= 0) {
            die("Erro: ID do imóvel inválido ou não recebido. Volte e tente novamente.");
        }

        $dados_imovel = $this->imovelModel->buscarPorId($id_imovel);
        if (!$dados_imovel) {
            die("Erro: Imóvel não encontrado.");
        }

        $id_quarteirao = $dados_imovel['id_quarteirao'];
        $dados_quarteirao = $this->rgModel->buscarDadosCompletos($id_quarteirao);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        unset($_SESSION['visita_id']);

        if (!isset($_SESSION['visita_id'])) {
            $visita_existente = $this->visitaModel->buscarVisitaAberta($id_imovel);

            if ($visita_existente) {
                $_SESSION['visita_id'] = $visita_existente['id_visita'];
            } else {
                $id_visita = $this->visitaModel->criar($id_imovel);
                
                if (!$id_visita || $id_visita == 0) {
                    die("Erro ao criar visita: ID inválido");
                }
                
                $_SESSION['visita_id'] = $id_visita;
            }
        }

        $id_visita = $_SESSION['visita_id'];
        
        require_once __DIR__ . '/../view/visita.php';
    }
}
?>

