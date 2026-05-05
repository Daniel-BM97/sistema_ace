<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use model\VisitaModel;

class TesteVisitaModel extends TestCase
{
    private $conn;

    protected function setUp(): void
    {
        // Conectar ao banco real para testes de integração
        $this->conn = new mysqli('localhost', 'root', '', 'sistema_ace', 3306);
        if ($this->conn->connect_error) {
            $this->fail('Falha na conexão com o banco: ' . $this->conn->connect_error);
        }
    }

    protected function tearDown(): void
    {
        $this->conn->close();
    }

    public function testBuscarVisitaAberta(): void
    {
        $visitaModel = new VisitaModel($this->conn);

        // Assumindo que há visitas no banco
        $result = $visitaModel->buscarVisitaAberta(1); // ID de imóvel existente

        // Pode ser null se não houver visita aberta
        $this->assertTrue(is_array($result) || is_null($result));
    }

    public function testCriarVisita(): void
    {
        $visitaModel = new VisitaModel($this->conn);

        $result = $visitaModel->criar(1); // ID de imóvel

        $this->assertIsInt($result); // Deve retornar o ID da visita inserida
    }
}