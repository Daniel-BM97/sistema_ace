<?php
declare(strict_types=1);

use Dba\Connection;
use PHPUnit\Framework\TestCase;
use model\VisitaModel;

class VisitaModelTest extends TestCase
{
    public function testebuscarVisitaAberta()
    {
        // Mock da conexão
        $connMock = $this->createMock(mysqli::class);

        // Mock do resultado da consulta
        $resultMock = $this->createMock(mysqli_result::class);
        $resultMock->method('fetch_assoc')->willReturn(
            ['id_visita' => 10]);

        // Mock do statement que retorna o mock do resultado
        $stmtMock = $this->createMock(mysqli_stmt::class);

        $connMock->method('prepare')->willReturn($stmtMock); // Simula o prepare retornando o mock do statement

        $stmtMock->method('bind_param')->willReturn(true); //Simula o bind_param
        $stmtMock->method('execute')->willReturn(true); //Simula a execução da query
        $stmtMock->method('get_result')->willReturn($resultMock);  //Simula o get_result retornando o mock do resultado
        $stmtMock->method('close')->willReturn(true); //Simula o fechamento do statement

        // Instancia da classe VisitaModel com conexão $connMock
        $visitaTeste = new VisitaModel($connMock);

        // Resultado do método buscarVisitaAberta()
        $result = $visitaTeste->buscarVisitaAberta($id_imovel = 1);

        $this->assertEquals(
            ['id_visita' => 10]
            , $result);

    }

    public function testecriar(){
        // Mock da conexão
        $connMock = $this->createMock(mysqli::class);
        
        // Mock do statement que retorna o mock do resultado
        $stmtMock = $this->createMock(mysqli_stmt::class);

        $connMock->method('prepare')->willReturn($stmtMock); // Simula o prepare retornando o mock do statement

        $stmtMock->method('bind_param')->willReturn(true); //Simula o bind_param
        $stmtMock->method('execute')->willReturn(true); //Simula a execução da query
        $stmtMock->method('insert_id')->willReturn(10);  //Simula o insert_id retornando um id de visita
        $stmtMock->method('close')->willReturn(true); //Simula o fechamento do statement

        // Instancia da classe VisitaModel com conexão $connMock
        $visitaTeste = new VisitaModel($connMock);

        // Resultado do método criar()
        $result = $visitaTeste->criar($id_imovel = 1);

        $this->assertEquals(
            10, $result);


    }
}