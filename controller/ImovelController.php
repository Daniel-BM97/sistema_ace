<?php
require_once __DIR__ . '/../init.php';
require_once __DIR__ . '/../model/ImovelModel.php';
require_once __DIR__ . '/../model/RegistroGeograficoModel.php';

class ImovelController {
    private $imovelModel;
    private $rgModel;

    public function __construct() {
        global $conn;
        $this->imovelModel = new ImovelModel($conn);
        $this->rgModel = new RegistroGeograficoModel($conn);
    }

    public function listar() {
        $id_quarteirao = isset($_GET['id_quarteirao']) ? intval($_GET['id_quarteirao']) : 0;
        
        if ($id_quarteirao <= 0) {
            header("Location: index.php?page=area");
            exit;
        }

        $imoveis = $this->imovelModel->listarPorQuarteirao($id_quarteirao);
        $numero_quarteirao = $this->rgModel->buscarNumeroQuarteirao($id_quarteirao);
        
        // Passar variáveis para a view
        $cod_area = isset($_GET['cod_area']) ? $_GET['cod_area'] : '';
        
        require_once __DIR__ . '/../view/imoveis.php';
    }

    public function cadastrar() {
        $id_quarteirao = isset($_GET['id_quarteirao']) ? intval($_GET['id_quarteirao']) : 0;
        
        if ($id_quarteirao <= 0) {
            header("Location: index.php?page=area");
            exit;
        }

        $quarteirao = $this->rgModel->buscarPorId($id_quarteirao);
        $mensagem = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'id_quarteirao' => $id_quarteirao,
                'nome_rua' => $_POST['nome_rua'] ?? null,
                'numero_imovel' => $_POST['numero_imovel'] ?? null,
                'tipo_imovel' => $_POST['tipo_imovel'] ?? null,
                'qtd_habitantes' => $_POST['qtd_habitantes'] ?? 0,
                'qtd_caes' => $_POST['qtd_caes'] ?? 0,
                'qtd_gatos' => $_POST['qtd_gatos'] ?? 0
            ];

            if ($dados['nome_rua']) {
                if ($this->imovelModel->cadastrar($dados)) {
                    $cod_area = isset($_GET['cod_area']) ? '&cod_area=' . urlencode($_GET['cod_area']) : '';
                    header("Location: index.php?page=imoveis&id_quarteirao=$id_quarteirao$cod_area&ok=1");
                    exit;
                } else {
                    $mensagem = "❌ Erro ao cadastrar imóvel";
                }
            }
        }

        // Passar variáveis para a view
        require_once __DIR__ . '/../view/cadastro.php';
    }
}
?>

