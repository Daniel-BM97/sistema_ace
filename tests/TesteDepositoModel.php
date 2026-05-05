<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use model\DepositoModel;

class TesteDepositoModel extends TestCase
{
    public function testCadastrar(): void
    {
        $connMock = $this->createMock(mysqli::class);
        $stmtMock = $this->createMock(mysqli_stmt::class);

        $connMock->method('prepare')->willReturn($stmtMock);
        $stmtMock->method('bind_param');
        $stmtMock->method('execute')->willReturn(true);
        $stmtMock->method('close');

        $depositoModel = new DepositoModel($connMock);
        $result = $depositoModel->cadastrar(1, 'A1', 1, 2.5);

        $this->assertTrue($result);
    }

    public function testCadastrarMultiplos(): void
    {
        $connMock = $this->createMock(mysqli::class);
        $stmtMock = $this->createMock(mysqli_stmt::class);

        $connMock->method('prepare')->willReturn($stmtMock);
        $stmtMock->method('bind_param');
        $stmtMock->method('execute')->willReturn(true);
        $stmtMock->method('close');

        $depositoModel = new DepositoModel($connMock);
        $depositos = [
            ['a1' => 1, 'focos' => 2, 'larvicida' => 1.5],
            ['a1' => 2, 'focos' => 0, 'larvicida' => 0]
        ];
        $result = $depositoModel->cadastrarMultiplos(1, $depositos);

        $this->assertTrue($result);
    }
}