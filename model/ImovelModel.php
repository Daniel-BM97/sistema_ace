<?php

class ImovelModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function listarPorQuarteirao($id_quarteirao) {
        $sql = "SELECT * 
                FROM imovel
                WHERE id_quarteirao = ?
                ORDER BY nome_rua ASC";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_quarteirao);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $imoveis = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $imoveis[] = $row;
            }
        }
        
        $stmt->close();
        return $imoveis;
    }

    public function buscarPorId($id_imovel) {
        $sql = "SELECT * 
                FROM imovel 
                WHERE id_imovel = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_imovel);
        $stmt->execute();
        $result = $stmt->get_result();
        $imovel = $result->fetch_assoc();
        $stmt->close();
        
        return $imovel;
    }

    public function cadastrar($dados) {
        $sql = "INSERT INTO imovel 
                (id_quarteirao, nome_rua, numero_imovel, tipo_imovel, qtd_habitantes, qtd_caes, qtd_gatos)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            "isssiii",
            $dados['id_quarteirao'],
            $dados['nome_rua'],
            $dados['numero_imovel'],
            $dados['tipo_imovel'],
            $dados['qtd_habitantes'],
            $dados['qtd_caes'],
            $dados['qtd_gatos']
        );

        $sucesso = $stmt->execute();
        $stmt->close();
        
        return $sucesso;
    }

    public function atualizar($id_imovel, $dados) {
        $sql = "UPDATE imovel 
                SET nome_rua = ?,
                    numero_imovel = ?,
                    tipo_imovel = ?,
                    qtd_habitantes = ?,
                    qtd_caes = ?,
                    qtd_gatos = ?
                WHERE id_imovel = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            "sssiiii",
            $dados['nome_rua'],
            $dados['numero_imovel'],
            $dados['tipo_imovel'],
            $dados['qtd_habitantes'],
            $dados['qtd_caes'],
            $dados['qtd_gatos'],
            $id_imovel
        );

        $sucesso = $stmt->execute();
        $stmt->close();
        
        return $sucesso;
    }
}
?>

