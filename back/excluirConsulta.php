<?php
    include_once('consultadao.php');
    include_once('consulta.php');
    
    $cod = $_GET['codigo'];
    $cdao = new ConsultaDao();
    $c = $cdao->buscar($cod);    
    
    $cdao->excluir($c->getCodigo());

    header('Location: /../listaConsulta.php');
?>