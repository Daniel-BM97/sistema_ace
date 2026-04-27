<?php

class VisitaModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function buscarVisitaAberta($id_imovel) {
        $sql = "SELECT id_visita
                FROM visita
                WHERE id_imovel = ? AND estado = 1 
                LIMIT 1";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_imovel);
        $stmt->execute();
        $result = $stmt->get_result();
        $visita = $result->fetch_assoc();
        $stmt->close();
        
        return $visita;
    }

    public function criar($id_imovel) {
        $sql = "INSERT INTO visita(id_imovel, tipo, estado) VALUES (?, 'Normal', 1)";
        $stmt = $this->conn->prepare($sql);
        
        if ($stmt) {
            $stmt->bind_param("i", $id_imovel);
            
            if ($stmt->execute()) {
                $id_visita = $stmt->insert_id;
                $stmt->close();
                return $id_visita;
            } else {
                $stmt->close();
                return false;
            }
        }
        
        return false;
    }

    public function atualizar($id_visita, $dados) {
        $sql = "UPDATE visita
                SET tipo = ?,
                    hora = ?,
                    data = ?,
                    estado = 0
                WHERE id_visita = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            "sssi",
            $dados['tipo'],
            $dados['hora'],
            $dados['data'],
            $id_visita
        );

        $sucesso = $stmt->execute();
        $stmt->close();
        
        return $sucesso;
    }
}
?>

