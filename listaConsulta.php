<?php require('base/header.php')?>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="listaConsulta.php">Consultas<span class="sr-only">(current)</span></a></li>
                <li><a href="listaMedicos.php">Médicos</a></li>
                <li><a href="listaPacientes.php">Pacientes</a></li>
            </ul>
        </div>
    </div>
</nav>
<h2>Consultas agendadas</h2>

<table class="table table-bordered">
    <thead>
        <tr class="titulo">
            <td>Codigo</td>
            <td>Médico</td>
            <td>CRM do médico</td>
            <td>Paciente</td>
            <td>CPF do paciente</td>
            <td>Convênio</td>
            <td>Data e hora</td>
        </tr>
    </thead>
    <tbody>
        <?php
                include_once('back/consultadao.php');
                include_once('back/consulta.php');
                include_once('back/abstractdao.php');

                $consultadao = new consultaDAO();
                $consulta = $consultadao->listar(20,0);

                foreach ($consulta as $c) { ?>
        <tr>
            <td>
                <?php echo $c->getCodigo()?>
            </td>
            <td>
                <?php echo $c->getMed()->getNome()?>
            </td>
            <td>
                <?php echo $c->getMed()->getCrm()?>
            </td>
            <td>
                <?php echo $c->getPac()->getNome()?>
            </td>
            <td>
                <?php echo $c->getPac()->getCpf()?>
            </td>
            <?php
                if($c->getConve() != null){ ?>
            <td>
                <?php echo $c->getConve()->getNome()?>
            </td>
            <?php } else { ?>
            <td></td>
            <?php } ?>
            <td>
                <?php echo $c->getDataHora()->format('d-m-Y H:i')?>
            </td>

            <td>
                <div class="btn-group btn-group-lg">
                    <button type="submit" class="btn btn-primary"><a href="back/excluirConsulta.php?codigo=<?php echo $c->getCodigo()?>">EXCLUIR</a></button>
                </div>
            </td>
            
        </tr>
        <?php } ?>

    </tbody>
</table>
<div class="botao">
    <div class="btn-group btn-group-lg">
        <button type="submit" class="btn btn-primary"><a href="formConsulta.php">MARCAR CONSULTA</a></button>
    </div>
</div>
</body>

</html>