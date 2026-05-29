<?php

class Uploader {
    private $pastaDestino = 'uploads/';
    private $tamanhoMaximo = 2 * 1024 * 1024;
    private $tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif'];

    // SEM proteção 
    public function enviarSemProtecao($arquivo) {
        $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
        $nomeNovo = uniqid('comprovante_') . '.' . $extensao;
        $destino = $this->pastaDestino . $nomeNovo;

        move_uploaded_file($arquivo['tmp_name'], $destino);
        return $nomeNovo;
    }

    // COM proteção
    public function enviar($arquivo) {
        if ($arquivo['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("Erro ao receber o arquivo.");
        }

        if ($arquivo['size'] > $this->tamanhoMaximo) {
            throw new Exception("Arquivo muito grande. Máximo: 2MB.");
        }

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeReal = $finfo->file($arquivo['tmp_name']);

        if (!in_array($mimeReal, $this->tiposPermitidos)) {
            throw new Exception("Tipo de arquivo não permitido: " . $mimeReal);
        }

        $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
        $nomeNovo = uniqid('comprovante_') . '.' . $extensao;
        $destino = $this->pastaDestino . $nomeNovo;

        move_uploaded_file($arquivo['tmp_name'], $destino);
        return $nomeNovo;
    }
}