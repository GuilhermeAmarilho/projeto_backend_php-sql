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
         if ($cod) {
             $cod = $_GET['codigo'];
             $cdao = new ConsultaDao();
             $cons = $cdao->buscar(intval($cod));
         }
?>

<h2>Agendamento de consulta</h2>

<form action="formConsulta2.php">
    <div class="etapa1">
        <input type="hidden" name="codigo" value="<?php if($cod) echo $cons->getCodigo()?>">
        <div class="input-group input-group-lg" id="inputs">
            <span class="input-group-addon" id="basic-addon1">Dia da consulta: </span>
            <input type="datetime-local" class="form-control" aria-describedby="basic-addon1" name="dtConsulta" value="<?php if($cod) echo $cons->getDataHora()->format('d-m-Y h:i A')?>"
                required>
        </div>
        <div class="input-group input-group-lg" id="inputs">
            <span class="input-group-addon" id="basic-addon1">CPF: </span>
            <select name="cpfPaciente" id="input" class="form-control" required>
                <option value=""></option>
                <?php 
                    // include_once('back/convenio.php');
                    // include_once('back/conveniodao.php');

                    $pacientedao = new PacienteDAO();
                    $paciente = $pacientedao->listar(20,0);

                    foreach ($paciente as $p) {?>
                <option value="<?php echo $p->getCpf()?>" <?php if($cod&&$cons->getPac()->getCpf() === $p->getCpf()
                    )echo "selected";?>>
                    <?php echo $p->getNome()?> ( CPF:
                    <?php echo $p->getCpf()?>)
                </option>
                <?php }?>
            </select>
        </div>
        <div class="btn-group btn-group-lg">
            <button id="proximo" type="submit" class="btn btn-primary">Ir para proxima parte</button>
        </div>
    </div>
</form>
<script src="back/add.js"></script>
</body>

</html>