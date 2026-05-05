<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use model\EstatisticasModel;

class EstatisticasModelTest extends TestCase
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

    public function testContarAreas(): void
    {
        $estatisticasModel = new EstatisticasModel($this->conn);

        $result = $estatisticasModel->contarAreas();

        $this->assertIsString($result);
        $this->assertGreaterThanOrEqual(0, (int)$result);
    }

    public function testContarImoveis(): void
    {
        $estatisticasModel = new EstatisticasModel($this->conn);

        $result = $estatisticasModel->contarImoveis();

        $this->assertIsString($result);
        $this->assertGreaterThanOrEqual(0, (int)$result);
    }

    public function testContarVisitas(): void
    {
        $estatisticasModel = new EstatisticasModel($this->conn);

        $result = $estatisticasModel->contarVisitas();

        $this->assertIsString($result);
        $this->assertGreaterThanOrEqual(0, (int)$result);
    }
}