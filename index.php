<?php
require_once __DIR__ . '/init.php';

// Sistema de roteamento
$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'home':
        require_once __DIR__ . '/controller/HomeController.php';
        $controller = new HomeController();
        $controller->index();
        break;
    
    case 'area':
        require_once __DIR__ . '/controller/AreaController.php';
        $controller = new AreaController();
        $controller->listar();
        break;
    
    case 'rg':
        require_once __DIR__ . '/controller/RegistroGeograficoController.php';
        $controller = new RegistroGeograficoController();
        $controller->listar();
        break;
    
    case 'imoveis':
        require_once __DIR__ . '/controller/ImovelController.php';
        $controller = new ImovelController();
        $controller->listar();
        break;
    
    case 'cadastro':
        require_once __DIR__ . '/controller/ImovelController.php';
        $controller = new ImovelController();
        $controller->cadastrar();
        break;
    
    case 'visita':
        require_once __DIR__ . '/controller/VisitaController.php';
        $controller = new VisitaController();
        $controller->criar();
        break;
    
    case 'deposito':
        require_once __DIR__ . '/controller/DepositoController.php';
        $controller = new DepositoController();
        $controller->salvar();
        break;
    
    case 'boletim':
        require_once __DIR__ . '/controller/BoletimController.php';
        $controller = new BoletimController();
        $controller->index();
        break;
    
    default:
        require_once __DIR__ . '/controller/HomeController.php';
        $controller = new HomeController();
        $controller->index();
        break;
}
?>
