<?php

namespace model;

class DepositoModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function cadastrar($id_visita, $tipo, $foco, $qtd_larvicida) {
        $sql = "INSERT INTO deposito (id_visita, tipo, foco, qtd_larvicida) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("isid", $id_visita, $tipo, $foco, $qtd_larvicida);
        $sucesso = $stmt->execute();
        $stmt->close();
        
        return $sucesso;
    }

    public function cadastrarMultiplos($id_visita, $depositos) {
        if (empty($depositos)) {
            return true;
        }

        $sql = "INSERT INTO deposito (id_visita, tipo, foco, qtd_larvicida) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            return false;
        }

        $erros = [];
        foreach ($depositos as $deposito) {
            $a1 = isset($deposito['a1']) ? intval($deposito['a1']) : 0;
            $focos = isset($deposito['focos']) ? intval($deposito['focos']) : 0;
            $larvicida = isset($deposito['larvicida']) ? floatval($deposito['larvicida']) : 0;

            // Se todos os campos estão vazios, pula este item
            if ($a1 == 0 && $focos == 0 && $larvicida == 0) {
                continue;
            }

            $tipo = "A" . $a1;
            $foco = $focos > 0 ? 1 : 0;

            $stmt->bind_param("isid", $id_visita, $tipo, $foco, $larvicida);

            if (!$stmt->execute()) {
                $erros[] = $stmt->error;
            }
        }

        $stmt->close();
        return empty($erros);
    }
}
?>

