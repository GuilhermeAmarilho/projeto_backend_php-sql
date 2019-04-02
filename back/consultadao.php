<?php
require_once('abstractdao.php');
require_once('medico.php');
require_once('paciente.php');
require_once('convenio.php');
require_once('consulta.php');
Class ConsultaDao extends Dao{
    
    public function inserir($consulta){
        $conn = $this->getConexao();
        $sql = "INSERT INTO consulta (data_hora,crmmedico,cpfpaciente,codconvenio) VALUES ($1,$2,$3,$4)";
        $vetor = array($consulta->getDataHora()->format('Y-m-d H:i:s'), $consulta->getMed()->getCrm(), $consulta->getPac()->getCpf(), $consulta->getConve()->getCodigo());
        $res = pg_query_params($conn, $sql,$vetor);
        pg_close($conn);
    }
    
    public function excluir($codigo){
        $conn = $this->getConexao();
        $sql = "DELETE FROM consulta WHERE codigo = $1";
        $res = pg_query_params($conn,$sql,array($codigo));
        pg_close($conn);
    }
    
    public function buscar($codigo){
        $conn = $this->getConexao();
        $sql = "SELECT m.nome as nome_medico, m.crm as crm_medico, m.cpf as cpf_medico, m.salario, m.telefone as telefone_medico, 
        m.email as email_medico, m.datanascimento as dtnascimento_medico, c.data_hora, c.codconvenio, c.codigo as codigo_consulta,
        c.cpfpaciente as cpf_paciente, p.nome as nome_paciente, p.telefone as telefone_paciente, p.email as email_paciente,
        p.datanascimento as dtnascimento_paciente, p.rg as rg_paciente, p.endereco as endereco_paciente, co.nome as nome_convenio from medico m right join consulta c 
            on m.crm = c.crmmedico left join paciente p 
            on c.cpfpaciente = p.cpf left join conveniopaciente cp 
            on p.cpf = cp.cpfpaciente left join convenio co
            on cp.codconvenio = co.codigo
            where c.codigo = $1";
        $vetor = array($codigo);
        $res = pg_query_params($conn, $sql, $vetor);
        $linha = pg_fetch_assoc($res);

        $consulta = new Consulta(new DateTime($linha['data_hora']));

        $medico = new Medico($linha['nome_medico'], $linha['cpf_medico'], $linha['crm_medico'], $linha['salario'], $linha['telefone_medico'], $linha['email_medico'], $linha['dtnascimento_medico']);

        $paciente = new Paciente($linha['nome_paciente'], $linha['cpf_paciente'], $linha['dtnascimento_paciente'], $linha['endereco_paciente']);
        $paciente->setRg($linha['rg_paciente']);
        $paciente->setTelefone($linha['telefone_paciente']);
        $paciente->setEmail($linha['email_paciente']);

        if (ISSET($linha['codconvenio'])) {
            $convenio = new Convenio($linha['codconvenio']);
            $convenio->setNome($linha['nome_convenio']);
            $consulta->setConvenio($convenio);
            $paciente->addConvenio($convenio);
        }
        $consulta->setMed($medico);
        $consulta->setPac($paciente);
        $consulta->setCodigo($linha['codigo_consulta']);
        pg_close($conn);
        return $consulta;
    }
    
    public function listar(int $limit, int $offset){
        $conn = $this->getConexao();
        $sql= "SELECT m.nome AS nome_medico, m.crm AS crm_medico,m.cpf AS cpf_medico, m.salario,
        m.telefone AS telefone_medico, m.email AS email_medico, m.datanascimento as dtnascimento_medico,
        c.data_hora, c.codconvenio, c.codigo AS codigo_consulta,
        c.cpfpaciente AS cpf_paciente, p.nome AS nome_paciente, p.telefone AS telefone_paciente, p.email AS email_paciente, 
        p.datanascimento AS dtnascimento_paciente, p.rg AS rg_paciente, p.endereco AS endereco_paciente, co.nome AS nome_convenio 
        from medico AS m INNER JOIN consulta AS c ON m.crm=c.crmmedico 
        left join convenio AS co ON c.codconvenio= co.codigo INNER JOIN paciente AS p ON c.cpfpaciente = p.cpf ORDER BY c.data_hora LIMIT $1 OFFSET $2";
        $vetor = array($limit,$offset);
        $res = pg_query_params($conn,$sql,$vetor);
        $listaconsultas = array();
        
        while($linha = pg_fetch_assoc($res)){
            $consulta = new Consulta(new DateTime($linha['data_hora']));

            $medico = new Medico($linha['nome_medico'], $linha['cpf_medico'], $linha['crm_medico'], $linha['salario'], $linha['telefone_medico'], $linha['email_medico'], $linha['dtnascimento_medico']);

            $paciente = new Paciente($linha['nome_paciente'], $linha['cpf_paciente'], $linha['dtnascimento_paciente'], $linha['endereco_paciente']);

            if (ISSET($linha['codconvenio']) ) {
                $convenio = new Convenio($linha['codconvenio']);
                $convenio->setNome($linha['nome_convenio']);
                $consulta->setConvenio($convenio);
            }

            $consulta->setMed($medico);
            $consulta->setPac($paciente);
            $consulta->setCodigo($linha['codigo_consulta']);
            array_push($listaconsultas,$consulta);
        }
        pg_close($conn);
        return $listaconsultas;
    }

    public function alterar($consulta){
		$conn = $this->getConexao();
        $sql = "UPDATE consulta SET data_hora=$1, crmmedico=$2, cpfpaciente=$3 WHERE codigo=$4";
        $vetor = array($consulta->getDataHora()->date, $consulta->getMed()->getCrm(), $consulta->getPac()->getCpf(), $consulta->getConve()->getCodigo());
		$res = pg_query_params($conn,$sql,$vetor);
        
        pg_close($conn);
    }
    
    public function listarMedicos($data_hora){
        $conn = $this->getConexao();
        $sql = 'SELECT * FROM medico WHERE crm NOT IN (SELECT crmmedico FROM consulta WHERE data_hora=$1)';
        $vetor = array($data_hora);
        $res = pg_query_params($conn,$sql,$vetor);
        $listamedicos = array();
        
        while($linha = pg_fetch_assoc($res)){
            $consulta = new Consulta(new DateTime($linha['data_hora']));

            $medico = new Medico($linha['nome'], $linha['cpf'], $linha['crm'], $linha['salario'], $linha['telefone'], $linha['email'], $linha['datanascimento']);

            $consulta->setMed($medico);
            array_push($listamedicos,$consulta);
        }
        pg_close($conn);
        return $listamedicos;
    }
}
?>