<?php
    require_once 'classes/Compra.php';
    require_once 'classes/Uploader.php';
    require_once 'functions.php';  
    validarSessao();  

    $mensagem = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            $nomeComprovante = null;
            if (!empty($_FILES['comprovante']['name'])) {
                $uploader = new Uploader();
                //$nomeComprovante = $uploader->enviar($_FILES['comprovante']);
                $nomeComprovante = $uploader->enviarSemProtecao($_FILES['comprovante']);
            }

            $compra = new Compra();
            $compra->adicionarCompra(
                $_POST['ativo'],
                $_POST['quantidade'],
                $_POST['valor_unitario'],
                $_POST['data_compra'],
                $nomeComprovante
            );

            $mensagem = "Compra cadastrada com sucesso!";
            if ($nomeComprovante) {
                $mensagem .= " Comprovante: " . $nomeComprovante;
            }

        } catch (Exception $e) {
            $mensagem = "Erro: " . $e->getMessage();
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Compra</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Cadastrar Compra</h1>

    <?php if ($mensagem): ?>
        <p><?= $mensagem ?></p>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <label>Ativo:</label>
        <input type="text" name="ativo" required><br><br>

        <label>Quantidade:</label>
        <input type="number" name="quantidade" required><br><br>

        <label>Valor Unitário:</label>
        <input type="number" step="0.01" name="valor_unitario" required><br><br>

        <label>Data da Compra:</label>
        <input type="date" name="data_compra" required><br><br>

        <label>Comprovante (opcional - JPG, PNG, GIF):</label>

        <input type="file" name="comprovante" ><br><br>

        <button type="submit">Cadastrar</button>
    </form>
    <br>
    <a href="index.php">Voltar ao início</a>
</body>
</html>