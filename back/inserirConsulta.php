<?php

include_once('consulta.php');
include_once('consultadao.php');
include_once('paciente.php');
include_once('pacientedao.php');
include_once('medico.php');
include_once('medicodao.php');
include_once('convenio.php');
include_once('conveniodao.php');

$codigo = $_POST['codigo'];

    $consultadao = new ConsultaDao();
    $cons = new Consulta(new DateTime($_POST['dtConsulta']));
    
    $pacientedao = new PacienteDAO();
    $pac = $pacientedao->buscar($_POST['cpfPaciente']);
    $cons->setPac($pac);    
    
    $medicodao = new MedicoDAO();
    $med = $medicodao->buscar($_POST['crmMedico']);
    $cons->setMed($med);
    
    $conveniodao = new ConvenioDAO();
    $conv = $conveniodao->buscar($_POST['convenio']);
    $cons->setConvenio($conv);
    
    $consultalist = $consultadao->listar(50,0);   

    $consultadao->inserir($cons);
    
    header('Location: /../listaConsulta.php');
?>