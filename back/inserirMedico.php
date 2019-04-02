<?php
    require_once('medicodao.php');    
    require_once('medico.php');
    $crm = $_POST['crm'];
    $med = new Medico($_POST['nome'], $_POST['cpf'], $_POST['crm'], intval($_POST['salario']), $_POST['telefone'], $_POST['email'], $_POST['dtNascimento']);

    $mdao = new MedicoDAO();

    $medicolist = $mdao->listar(20,0);
    $var = 1;
    foreach ($medicolist as $m) { 
        if ($m->getCrm() === $crm) {
            $mdao->alterar($med);
            $var = 0;
        } 
    }
    if ($var = 1) {
        $mdao->inserir($med);
    }

    //redireciona para o listar.php
    header("Location: /../listaMedicos.php");

?>