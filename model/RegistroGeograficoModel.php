<?php

class RegistroGeograficoModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function listarPorArea($cod_area) {
        $sql = "SELECT 
                    id_quarteirao,
                    numero_quarteirao,
                    cod_area,
                    nome_area,
                    cod_zona,
                    qtd_imoveis,
                    qtd_residencia,
                    qtd_terrenos_baldio,
                    qtd_ponto_estrategico,
                    qtd_outro,
                    qtd_comercio,
                    qtd_habitantes,
                    qtd_caes,
                    qtd_gatos
                FROM registro_geografico
                WHERE cod_area = ?
                ORDER BY numero_quarteirao ASC";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $cod_area);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $quarteiroes = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $quarteiroes[] = $row;
            }
        }
        
        $stmt->close();
        return $quarteiroes;
    }

    public function buscarPorId($id_quarteirao) {
        $sql = "SELECT id_quarteirao, numero_quarteirao, nome_area 
                FROM registro_geografico 
                WHERE id_quarteirao = ? 
                LIMIT 1";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_quarteirao);
        $stmt->execute();
        $result = $stmt->get_result();
        $quarteirao = $result->fetch_assoc();
        $stmt->close();
        
        return $quarteirao;
    }

    public function buscarNumeroQuarteirao($id_quarteirao) {
        $sql = "SELECT numero_quarteirao
                FROM registro_geografico
                WHERE id_quarteirao = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_quarteirao);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        
        return $row['numero_quarteirao'] ?? null;
    }

    public function listarTodos() {
        $sql = "SELECT id_quarteirao, numero_quarteirao, cod_area, nome_area
                FROM registro_geografico
                ORDER BY numero_quarteirao ASC";
        
        $result = $this->conn->query($sql);
        $quarteiroes = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $quarteiroes[] = $row;
            }
        }

        return $quarteiroes;
    }

    public function buscarDadosCompletos($id_quarteirao) {
        $sql = "SELECT 
                    id_quarteirao,
                    numero_quarteirao,
                    cod_area,
                    nome_area,
                    cod_zona
                FROM registro_geografico
                WHERE id_quarteirao = ?
                LIMIT 1";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_quarteirao);
        $stmt->execute();
        $result = $stmt->get_result();
        $dados = $result->fetch_assoc();
        $stmt->close();
        
        return $dados;
    }
}
?>

