
<?php
require_once('pacientedao.php');    
require_once('paciente.php');
$cpf = $_POST['cpf'];

$pac = new Paciente($_POST['nome'], $_POST['cpf'], $_POST['dtNascimento'], $_POST['endereco']);
$pac->setTelefone($_POST['telefone']);
$pac->setEmail($_POST['email']);
$pac->setRg($_POST['rg']);

$pdao = new PacienteDAO();
$x=1;
while (ISSET($_POST['conv'.$x])) {

    $convenio = new Convenio($_POST['conv'.$x]);
    
    $pac->addConvenio($convenio);
    $x++;    
}
$pacientelist = $pdao->listar(20,0);
$var = 1;
foreach ($pacientelist as $p) { 
    if ($p->getCpf() === $cpf) {
        $pdao->alterar($pac);
        $var = 0;
    } 
}
// print_r($pac)
if ($var = 1) {
    $pdao->inserir($pac);
}

//redireciona para o listar.php
header("Location: /../listaPacientes.php");

?>