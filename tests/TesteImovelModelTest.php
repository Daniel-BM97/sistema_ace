<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use model\ImovelModel;

class TesteImovelModel extends TestCase
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

    public function testListarPorQuarteiraoComDadosReais(): void
    {
        $imovelModel = new ImovelModel($this->conn);

        // Assumindo que há dados no banco (de script.sql ou inseridos)
        $result = $imovelModel->listarPorQuarteirao(1); // ID de quarteirão existente

        $this->assertIsArray($result);
        // Verificar se retorna array, mesmo se vazio
    }

    public function testCadastrarImovel(): void
    {
        $imovelModel = new ImovelModel($this->conn);

        $dados = [
            'id_quarteirao' => 1,
            'nome_rua' => 'Rua Teste',
            'numero_imovel' => '123',
            'tipo_imovel' => 'Casa',
            'qtd_habitantes' => 4,
            'qtd_caes' => 1,
            'qtd_gatos' => 0
        ];

        $result = $imovelModel->cadastrar($dados);

        $this->assertTrue($result);
    }
}