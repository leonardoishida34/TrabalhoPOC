<?php

require_once 'Database.php';

class Compra {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function adicionarCompra($ativo, $quantidade, $valorUnitario, $dataCompra, $comprovante = null) {
    $sql = "INSERT INTO compras (ativo, quantidade, valor_unitario, data_compra, comprovante) 
            VALUES (:ativo, :quantidade, :valor_unitario, :data_compra, :comprovante)";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([
        'ativo' => $ativo,
        'quantidade' => $quantidade,
        'valor_unitario' => $valorUnitario,
        'data_compra' => $dataCompra,
        'comprovante' => $comprovante
    ]);
}

    public function listarCompras() {
        $sql = "SELECT * FROM compras";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
