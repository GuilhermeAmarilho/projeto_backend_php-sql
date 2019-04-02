<?php
    include_once('medicodao.php');
    include_once('medico.php');
    
    $crm = $_GET['crm'];
    $mdao = new MedicoDao();
    $m = $mdao->buscar($crm);    
    
    $mdao->excluir($m->getCrm());

    header('Location: /../listaMedicos.php');
?>