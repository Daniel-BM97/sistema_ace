<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use model\RegistroGeograficoModel;

class RegistroGeograficoModelTest extends TestCase
{
    private $conn;

    protected function setUp(): void
    {
        $this->conn = new mysqli('localhost', 'root', '', 'sistema_ace', 3306);
        if ($this->conn->connect_error) {
            $this->fail('Falha na conexão com o banco: ' . $this->conn->connect_error);
        }
    }

    protected function tearDown(): void
    {
        $this->conn->close();
    }

    public function testListarPorArea(): void
    {
        $rgModel = new RegistroGeograficoModel($this->conn);

        $result = $rgModel->listarPorArea(1); // Assumindo cod_area 1 existe

        $this->assertIsArray($result);
    }

    public function testBuscarPorId(): void
    {
        $rgModel = new RegistroGeograficoModel($this->conn);

        $result = $rgModel->buscarPorId(1); // Assumindo id_quarteirao 1 existe

        $this->assertTrue(is_array($result) || is_null($result));
    }
}