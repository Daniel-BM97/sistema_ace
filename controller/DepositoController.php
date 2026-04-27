<?php
require_once __DIR__ . '/../init.php';
require_once __DIR__ . '/../model/ImovelModel.php';
require_once __DIR__ . '/../model/VisitaModel.php';
require_once __DIR__ . '/../model/DepositoModel.php';

class DepositoController {
    private $imovelModel;
    private $visitaModel;
    private $depositoModel;

    public function __construct() {
        global $conn;
        $this->imovelModel = new ImovelModel($conn);
        $this->visitaModel = new VisitaModel($conn);
        $this->depositoModel = new DepositoModel($conn);
    }

    public function salvar() {
        $id_visita = isset($_GET['id_visita']) ? intval($_GET['id_visita']) : 0;

        if ($id_visita <= 0) {
            die("id_visita inválido");
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Atualizar dados do imóvel
        $dados_imovel = [
            'nome_rua' => $_POST['logradouro'] ?? '',
            'numero_imovel' => $_POST['numero'] ?? '',
            'tipo_imovel' => $_POST['tipo'] ?? '',
            'qtd_habitantes' => intval($_POST['h'] ?? 0),
            'qtd_caes' => intval($_POST['c'] ?? 0),
            'qtd_gatos' => intval($_POST['g'] ?? 0)
        ];

        $id_imovel = intval($_POST['id'] ?? 0);
        $this->imovelModel->atualizar($id_imovel, $dados_imovel);

        // Atualizar dados da visita
        $visita_tipo = $_POST['visita'] ?? 'Normal';
        $hora = $_POST['hora'] ?? '';
        $data = !empty($_POST['data']) ? $_POST['data'] : date("Y-m-d");

        $dados_visita = [
            'tipo' => $visita_tipo,
            'hora' => $hora,
            'data' => $data
        ];

        $this->visitaModel->atualizar($id_visita, $dados_visita);
        unset($_SESSION['visita_id']);

        // Inserir múltiplos depósitos
        $a1_array = isset($_POST['a1']) ? $_POST['a1'] : [];
        $focos_a1_array = isset($_POST['focos_a1']) ? $_POST['focos_a1'] : [];
        $larvicida_array = isset($_POST['larvicida']) ? $_POST['larvicida'] : [];

        $depositos = [];
        for ($i = 0; $i < count($a1_array); $i++) {
            $depositos[] = [
                'a1' => isset($a1_array[$i]) ? $a1_array[$i] : 0,
                'focos' => isset($focos_a1_array[$i]) ? $focos_a1_array[$i] : 0,
                'larvicida' => isset($larvicida_array[$i]) ? $larvicida_array[$i] : 0
            ];
        }

        $this->depositoModel->cadastrarMultiplos($id_visita, $depositos);

        $id_quarteirao = intval($_POST['id_quarteirao'] ?? 0);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['flash'] = 'Registro salvo com sucesso!';

        $cod_area = isset($_POST['cod_area']) ? '&cod_area=' . urlencode($_POST['cod_area']) : '';
        header("Location: index.php?page=imoveis&id_quarteirao=$id_quarteirao$cod_area");
        exit();
    }
}
?>

