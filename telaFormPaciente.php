<?php 
    include_once('base/header.php');
    include_once('back/paciente.php');
    include_once('back/pacientedao.php');
    include_once('back/convenio.php');
    include_once('back/conveniodao.php');

    $cpf = ISSET($_GET['cpf']);
    if ($cpf) {
        $cpf = $_GET['cpf'];
        $pdao = new PacienteDAO();
        $pac = $pdao->buscar($cpf);
    }
?>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="listaConsulta.php">Consultas</a></li>
                <li><a href="listaMedicos.php">Médicos</a></li>
                <li><a href="listaPacientes.php">Pacientes</a></li>
            </ul>
        </div>
    </div>
</nav>

<h2>Cadastro de paciente</h2>

<form action="back/inserirPaciente.php" method="POST">

    <div class="input-group input-group-lg" id="inputs">
        <span class="input-group-addon" id="basic-addon1">Nome: </span>
        <input type="text" class="form-control" placeholder="ex: José Silva dos Santos" aria-describedby="basic-addon1"
            name="nome" maxlength="100" value="<?php if($cpf) echo $pac->getNome();?>" required>
    </div>

    <div class="input-group input-group-lg" id="inputs">
        <span class="input-group-addon" id="basic-addon1">CPF: </span>
        <input type="text" class="form-control" placeholder="ex: XXXXXXXXXXX" aria-describedby="basic-addon1" name="cpf"
            maxlength="11" value="<?php if($cpf) echo $pac->getCpf();?>" required>
    </div>

    <div class="input-group input-group-lg" id="inputs">
        <span class="input-group-addon" id="basic-addon1">RG: </span>
        <input type="text" class="form-control" placeholder="ex: xxxxxxxxxx" aria-describedby="basic-addon1" name="rg"
            maxlength="10" value="<?php if($cpf) echo $pac->getRg();?>" required>
    </div>

    <div class="input-group input-group-lg" id="inputs">
        <span class="input-group-addon" id="basic-addon1">Telefone: </span>
        <input type="number" class="form-control" placeholder="ex: (xx)XXXXXXXXX" aria-describedby="basic-addon1" name="telefone"
            value="<?php if($cpf) echo $pac->getTelefone();?>">
    </div>

    <div class="input-group input-group-lg" id="inputs">
        <span class="input-group-addon" id="basic-addon1">E-mail: </span>
        <input type="email" class="form-control" placeholder="ex: nome@gmail.com" aria-describedby="basic-addon1" name="email"
            maxlength="50" value="<?php if($cpf) echo $pac->getEmail();?>">
    </div>

    <div class="input-group input-group-lg" id="inputs">
        <span class="input-group-addon" id="basic-addon1">Data de Nascimento: </span>
        <input type="text" class="form-control" placeholder="ex: 20/10/2000" aria-describedby="basic-addon1" name="dtNascimento"
            value="<?php if($cpf) echo $pac->getDataNascimento()?>" required>
    </div>

    <div class="input-group input-group-lg" id="inputs">
        <span class="input-group-addon" id="basic-addon1">Endereço: </span>
        <input type="text" class="form-control" placeholder="ex: Rua Duque de Caxias, 223" aria-describedby="basic-addon1"
            name="endereco" maxlength="100" value="<?php if($cpf) echo $pac->getEndereco();?>" required>
    </div>

    <div class="input-group input-group-lg grupoconv" id="inputs">
        <span class="input-group-addon" id="basic-addon1">Convênio: </span>
        <select name="conv1" id="input" class="form-control conv" id="primeiro">
            <option value=""></option>
            <?php 

                $conveniodao = new ConvenioDAO();
                $convenio = $conveniodao->listar(20,0);

                foreach ($convenio as $c) {?>
            <option value=<?php echo $c->getCodigo()?>>
                <?php echo $c->getNome()?>
            </option>
            <?php }?>
        </select>
        <div class="mais">
            <div class="btn-group btn-group-lg maisbutton" role="group" aria-label="...">
                <button type="button" class="btn" id="maisbutton">+ </button>
            </div>
        </div>
        <div class="menos">
            <div class="btn-group btn-group-lg menosbutton" role="group" aria-label="...">
                <button type="button" class="btn" id="menosbutton">-</button>
            </div>
        </div>
    </div>

    <div class="botao">
        <div class="btn-group btn-group-lg">
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
    </div>

</form>
<script src="back/add.js"></script>
</body>

</html>