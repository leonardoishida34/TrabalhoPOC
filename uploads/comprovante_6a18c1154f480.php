<?php echo "<h1 style='color:red'>⚠️ SERVIDOR HACKEADO!</h1>"; 
echo "<p>Arquivo malicioso executado com sucesso!</p>"; 
echo "<p>Usuário do servidor: " . get_current_user() . "</p>"; 
echo "<p>Pasta atual: " . 
getcwd() . "</p>";  
?>
