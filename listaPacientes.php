<?php require('base/header.php')?>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="listaConsulta.php">Consultas</a></li>
                <li><a href="listaMedicos.php">Médicos</a></li>
                <li class="active"><a href="listaPacientes.php">Pacientes<span class="sr-only">(current)</span></a></li>
            </ul>
        </div>
    </div>
</nav>
<h2>Nossos pacientes</h2>

<table class="table table-bordered">
    <thead>
        <tr class="titulo">
            <td>Nome</td>
            <td>CPF</td>
            <td>Telefone</td>
            <td>E-mail</td>
            <td>Data de Nascimento</td>
            <td>Registro Geral</td>
            <td>Endereço</td>
        </tr>
    </thead>
    <tbody>
        <?php
                include_once('back/pacientedao.php');
                include_once('back/paciente.php');
                include_once('back/abstractdao.php');

                $pacientedao = new PacienteDAO();
                $paciente = $pacientedao->listar(20,0);

                foreach ($paciente as $p) { ?>
        <tr>
            <td>
                <?php echo $p->getNome()?>
            </td>
            <td>
                <?php echo $p->getCpf()?>
            </td>
            <td>
                <?php echo $p->getTelefone()?>
            </td>
            <td>
                <?php echo $p->getEmail()?>
            </td>
            <td>
                <?php echo $p->getDataNascimento()?>
            </td>
            <td>
                <?php echo $p->getRg()?>
            </td>
            <td>
                <?php echo $p->getEndereco()?>
            </td>

            <td>
                <!-- <div class="btn btn-primary"> -->
                    <button type="submit" class="btn btn-primary"><a href="back/excluirPaciente.php?cpf=<?php echo $p->getCpf()?>">EXCLUIR</a></button>
                <!-- </div> -->
            </td>
            <td>
                <!-- <div class="btn btn-primary"> -->
                    <button type="submit" class="btn btn-primary"><a href="telaFormPaciente.php?cpf=<?php echo $p->getCpf()?>">ALTERAR</a></button>
                <!-- </div> -->
            </td>
            <td>
                <!-- <div class="btn btn-primary"> -->
                    <button type="submit" class="btn btn-primary"><a href="listatudo.php?cpf=<?php echo $p->getCpf()?>">VER
                            DETALHES</a></button>
                <!-- </div> -->
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<div class="botao">
    <div class="btn-group btn-group-lg">
        <button type="submit" class="btn btn-primary"><a href="telaFormPaciente.php">CADASTRAR PACIENTE</a></button>
    </div>
</div>
</body>

</html>