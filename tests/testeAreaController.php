<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use model\AreaModel;

require_once __DIR__ . '/../controller/AreaController.php';

class AreaControllerTest extends TestCase
{
    public function testListar()
    {
        $areasFake = [
            ['id' => 1, 'nome' => 'Área 1']
        ];

        $mock = $this->createMock(AreaModel::class);
        $mock->method('listarTodas')->willReturn($areasFake);

        $controller = new AreaController($mock);

        $resultado = $controller->listar();

        $this->assertEquals($areasFake, $resultado);
    }
}