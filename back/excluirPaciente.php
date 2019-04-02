<?php
    include_once('pacientedao.php');
    include_once('paciente.php');
    
    $cpf = $_GET['cpf'];
    $pdao = new PacienteDAO();
    $p = $pdao->buscar($cpf);    
    
    $pdao->excluir($p->getCpf());

    header('Location: /../listaPacientes.php');
?>