<?php


use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../controller/AreaController.php';
class AreaControllerTest extends TestCase
{
    public function testListarOutputsView()
    {
        global $conn;
        $connMock = $this->createMock(PDO::class);

        $controller = new AreaController($connMock);

        ob_start();
        $controller->listar();
        $output = ob_get_clean();

        $this->assertNotEmpty($output);
    }
}