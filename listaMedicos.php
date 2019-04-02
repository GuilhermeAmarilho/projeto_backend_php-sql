<?php require('base/header.php')?>

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
<h2>Nossos médicos</h2>

<table class="table table-bordered">
    <thead>
        <tr class="titulo">
            <td>CPF</td>
            <td>CRM</td>
            <td>Nome</td>
            <td>Data de nascimento</td>
            <td>Telefone</td>
            <td>E-mail</td>
            <td>Salário</td>
        </tr>
    </thead>
    <tbody>
        <?php
                include_once('back/medicodao.php');
                include_once('back/medico.php');
                include_once('back/abstractdao.php');

                $medicodao = new MedicoDAO();
                $medico = $medicodao->listar(20,0);

                foreach ($medico as $m) { ?>
        <tr>
            <td>
                <?php echo $m->getCpf()?>
            </td>
            <td>
                <?php echo $m->getCrm()?>
            </td>
            <td>
                <?php echo $m->getNome()?>
            </td>
            <td>
                <?php echo $m->getDataNascimento()?>
            </td>
            <td>
                <?php echo $m->getTelefone()?>
            </td>
            <td>
                <?php echo $m->getEmail()?>
            </td>
            <td>
                <?php echo $m->getSalario()?>
            </td>

            <td>
                <div class="btn-group btn-group-lg">
                    <button type="submit" class="btn btn-primary"><a href="back/excluirMedico.php?crm=<?php echo $m->getCrm()?>">EXCLUIR</a></button>
                </div>
            </td>
            <td>
                <div class="btn-group btn-group-lg">
                    <button type="submit" class="btn btn-primary"><a href="formMedico.php?crm=<?php echo $m->getCrm()?>">ALTERAR</a></button>
                </div>
            </td>
        </tr>
        <?php } ?>

    </tbody>
</table>
<div class="botao">
    <div class="btn-group btn-group-lg">
        <button type="submit" class="btn btn-primary"><a href="formMedico.php">CADASTRAR MÉDICO</a></button>
    </div>
</div>
</body>

</html>