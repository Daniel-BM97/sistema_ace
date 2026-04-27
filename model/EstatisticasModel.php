<?php

class EstatisticasModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function contarAreas() {
        $sql = "SELECT COUNT(*) as total FROM area";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['total'] ?? 0;
    }

    public function contarImoveis() {
        $sql = "SELECT COUNT(*) as total FROM imovel";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['total'] ?? 0;
    }

    public function contarVisitas() {
        $sql = "SELECT COUNT(*) as total FROM visita";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['total'] ?? 0;
    }

    public function buscarBoletimDiario($data_filtro = null) {
        $where_data = "";
        if (!empty($data_filtro)) {
            $where_data = " AND DATE(v.data) = '" . $this->conn->real_escape_string($data_filtro) . "'";
        }

        $sql = "SELECT
                  rg.numero_quarteirao,
                  i.id_imovel,
                  i.nome_rua,
                  i.numero_imovel,
                  i.tipo_imovel,
                  COALESCE(SUM(CASE WHEN d.tipo = 'A1' THEN 1 ELSE 0 END),0) AS A1,
                  COALESCE(SUM(CASE WHEN d.tipo = 'A2' THEN 1 ELSE 0 END),0) AS A2,
                  COALESCE(SUM(CASE WHEN d.tipo = 'B'  THEN 1 ELSE 0 END),0) AS B,
                  COALESCE(SUM(CASE WHEN d.tipo = 'C'  THEN 1 ELSE 0 END),0) AS C,
                  COALESCE(SUM(CASE WHEN d.tipo = 'D1' THEN 1 ELSE 0 END),0) AS D1,
                  COALESCE(SUM(CASE WHEN d.tipo = 'D2' THEN 1 ELSE 0 END),0) AS D2,
                  COALESCE(SUM(d.qtd_larvicida),0) AS qtd_larvicida
                FROM imovel i
                JOIN registro_geografico rg ON i.id_quarteirao = rg.id_quarteirao
                LEFT JOIN visita v ON v.id_imovel = i.id_imovel
                LEFT JOIN deposito d ON d.id_visita = v.id_visita
                WHERE 1=1 $where_data
                GROUP BY i.id_imovel
                ORDER BY rg.numero_quarteirao ASC, i.nome_rua ASC";

        $rows = [];
        
        if (!empty($data_filtro)) {
            $res = $this->conn->query($sql);
            if ($res && $res->num_rows > 0) {
                while ($r = $res->fetch_assoc()) {
                    $rows[] = $r;
                }
            }
        }

        return $rows;
    }
}
?>

