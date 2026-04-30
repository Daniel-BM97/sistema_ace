<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use model\AreaModel;

class AreaTest extends TestCase
{
    public function testeArealistarTodas(): void

    {
        // Mock da conexã
        $connMock = $this->createMock(mysqli::class);

        // Mock do resultado da consulta
        $resultMock = $this->createMock(mysqli_result::class);
        $resultMock->method('fetch_assoc')->willReturn(
            ['id_area' => 0, 'nome_area' => 'Area 1'], null
            );

        //Mock da query que retorna o Mock do resultado
        $connMock->method('query')->willReturn($resultMock);


        //instacia da classe AreaModel com conexão $connMock
        $areaTeste = new AreaModel($connMock);
         
        //Resultado do método listarTodas()
        $result = $areaTeste->listarTodas();

        $this->assertEquals([
            ['id_area' => 0, 'nome_area' => 'Area 1']
            ],$result);

        $this->assertEmpty(!$result);
        
    }
}
