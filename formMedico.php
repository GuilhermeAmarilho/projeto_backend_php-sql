<?php 
    require('base/header.php');

    require_once('back/medicodao.php');
    require_once('back/medico.php');

    $crm = ISSET($_GET['crm']);
    if ($crm) {
        $crm = $_GET['crm'];
        $mdao = new MedicoDao();
        $m = $mdao->buscar($crm);
    }
?>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="listaConsulta.php">Consultas</a></li>
                <li class="active"><a href="listaMedicos.php">Médicos<span class="sr-only">(current)</span></a></li>
                <li><a href="listaPacientes.php">Pacientes</a></li>
            </ul>
        </div>
    </div>
</nav>

<h2>Cadastro de médico</h2>

<form action="back/inserirMedico.php" method="POST">

    <div class="input-group input-group-lg" id="inputs">
        <span class="input-group-addon" id="basic-addon1">Nome: </span>
        <input type="text" class="form-control" placeholder="ex: José Silva dos Santos" aria-describedby="basic-addon1"
            name="nome" maxlength="100" value="<?php if($crm) echo $m->getNome()?>" required>
    </div>

    <div class="input-group input-group-lg" id="inputs">
        <span class="input-group-addon" id="basic-addon1">CPF: </span>
        <input type="text" class="form-control" placeholder="ex: XXXXXXXXXXX" aria-describedby="basic-addon1" name="cpf"
            maxlength="11" value="<?php if($crm) echo $m->getCpf()?>" required>
    </div>

    <div class="input-group input-group-lg" id="inputs">
        <span class="input-group-addon" id="basic-addon1">CRM: </span>
        <input type="text" class="form-control" placeholder="ex: 000000/RS" aria-describedby="basic-addon1" name="crm"
            maxlength="10" value="<?php if($crm) echo $m->getCrm()?>" required>
    </div>

    <div class="input-group input-group-lg" id="inputs">
        <span class="input-group-addon" id="basic-addon1">Salário: </span>
        <input type="number" class="form-control" placeholder="ex: 2000.00" aria-describedby="basic-addon1" name="salario"
            value="<?php if($crm) echo $m->getSalario()?>" required>
    </div>

    <div class="input-group input-group-lg" id="inputs">
        <span class="input-group-addon" id="basic-addon1">Telefone: </span>
        <input type="number" class="form-control" placeholder="ex: (xx)XXXXXXXXX" aria-describedby="basic-addon1" name="telefone"
            value="<?php if($crm) echo $m->getTelefone()?>">
    </div>

    <div class="input-group input-group-lg" id="inputs">
        <span class="input-group-addon" id="basic-addon1">E-mail: </span>
        <input type="email" class="form-control" placeholder="ex: nome@gmail.com" aria-describedby="basic-addon1" name="email"
            maxlength="50" value="<?php if($crm) echo $m->getEmail()?>">
    </div>

    <div class="input-group input-group-lg" id="inputs">
        <span class="input-group-addon" id="basic-addon1">Data de Nascimento: </span>
        <input type="text" class="form-control" placeholder="ex: 20/10/2000" aria-describedby="basic-addon1" name="dtNascimento"
            value="<?php if($crm) echo $m->getDataNascimento()?>" required>
    </div>

    <div class="botao">
        <div class="btn-group btn-group-lg">
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
    </div>

</form>
</body>

</html>