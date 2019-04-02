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
<?php
       require_once('back/paciente.php');
       require_once('back/pacientedao.php');
       require_once('back/medico.php');
       require_once('back/medicodao.php');
       require_once('back/consulta.php');
       require_once('back/consultadao.php');

        $cod = ISSET($_GET['codigo']);
?>

<h2>Agendamento de consulta</h2>
<form action="back/inserirConsulta.php" method="POST">
    <div class="input-group input-group-lg" id="inputs">
        <input type="hidden" name="codigo" value="<?php  echo $_GET['codigo']?>">
        <input type="hidden" name="dtConsulta" value="<?php echo $_GET['dtConsulta']?>">
        <input type="hidden" name="cpfPaciente" value="<?php echo $_GET['cpfPaciente']?>">
        <span class="input-group-addon" id="basic-addon1">Nome do médico: </span>
        <select name="crmMedico" id="input" class="form-control" required>
            <option value=""></option>
            <?php 
                include_once('back/consulta.php');
                include_once('back/consultadao.php');

                $consultadao = new ConsultaDao();
                $consulta = $consultadao->listarMedicos($_GET['dtConsulta']);
                foreach($consulta as $con){ ?>
            <option value=<?php echo $con->getMed()->getCrm();?>>
                <?php echo $con->getMed()->getNome();?>
            </option>
            <?php }?>
        </select>
    </div>
    <div class="input-group input-group-lg grupoconv" id="inputs">
        <span class="input-group-addon" id="basic-addon1">Convênio: </span>
        <select name="convenio" id="input" class="form-control conv">
            <option value=""></option>
            <?php 
                    include_once('back/paciente.php');
                    include_once('back/pacientedao.php');
                    $cpf = $_GET['cpfPaciente'];
                    $pacientedao = new PacienteDao();
                    $paciente = $pacientedao->buscar($cpf);

                        foreach($paciente->getConvenios() as $p){ ?>
            <option value=<?php echo $p->getCodigo();?>>
                <?php echo $p->getNome();?>
            </option>
            <?php } ?>
        </select>
    </div>
    <div class="botao">
        <div class="btn-group btn-group-lg">
            <button type="submit" class="btn btn-primary">Marcar consulta</button>
        </div>
    </div>
</form>
<script src="back/add.js"></script>
</body>

</html>