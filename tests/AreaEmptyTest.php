<?php


use PHPUnit\Framework\TestCase;
use model\AreaModel;

class testeAreaEmpty extends TestCase
{
    public function testListarTodasVazio(): void
    {
        // Mock da conexão
        $connMock = $this->createMock(mysqli::class);

        // Mock do resultado
        $resultMock = $this->createMock(mysqli_result::class);

        // Simula que não tem nenhum registro
        $resultMock->method('fetch_assoc')
            ->willReturn(null);

        // Query retorna o mock
        $connMock->method('query')->willReturn($resultMock);

        // Instancia o model
        $areaTeste = new AreaModel($connMock);

        // Executa
        $result = $areaTeste->listarTodas();

        // Verifica se retorna array vazio
        $this->assertEmpty($result);
    }
}