<?php 
include_once('abstractdao.php');
include_once('convenio.php');
include_once('paciente.php');
class PacienteDAO extends Dao{
    
    public function listar (int $limit, int $offset) {
        $con = $this->getConexao();
        $sql = 'SELECT * FROM paciente ORDER BY nome asc LIMIT $1 OFFSET $2 ';
        $vetor = array($limit, $offset);
    
        $res = pg_query_params($con, $sql, $vetor);
        $listPaciente = array();
        while ($linha = pg_fetch_assoc($res)) {
            $paciente = new Paciente ($linha['nome'], $linha['cpf'], $linha['datanascimento'], $linha['endereco']);
            $paciente->setTelefone($linha['telefone']);  
            $paciente->setEmail($linha['email']);  
            $paciente->setRg($linha['rg']);  
            
            array_push($listPaciente, $paciente);
        }

        pg_close($con);
        return $listPaciente;
    }

    public function buscar($cpf) {
        $con = $this->getConexao();
        $sql = 'SELECT  p.nome AS nome_paciente, p.cpf, p.telefone, p.email, p.datanascimento, p.rg, p.endereco, cp.codconvenio, c.nome AS nome_convenio  FROM paciente p LEFT JOIN conveniopaciente cp ON p.cpf = cp.cpfpaciente LEFT JOIN convenio c ON cp.codconvenio=c.codigo WHERE p.cpf= $1';
        $res = pg_query_params($con, $sql, array($cpf));
        $linha = pg_fetch_assoc($res);
        $paciente = new Paciente ($linha['nome_paciente'], $linha['cpf'], $linha['datanascimento'], $linha['endereco']);
        $paciente->setTelefone($linha['telefone']);
        $paciente->setEmail($linha['email']);
        $paciente->setRg($linha['rg']);
        if (ISSET($linha['codconvenio']) ) {
            $convenio = new Convenio($linha['codconvenio']);
            $convenio->setNome($linha['nome_convenio']);
            $paciente->addConvenio($convenio);
        }
        while ($linha = pg_fetch_assoc($res)) {
            if (ISSET($linha['codconvenio']) ) {
                $convenio = new Convenio($linha['codconvenio']);
                $convenio->setNome($linha['nome_convenio']);
                $paciente->addConvenio($convenio);
            }
        }
        pg_close($con);
        return $paciente;
    }

    public function inserir($paciente) {
        $con = $this->getConexao();
        $sql = 'INSERT INTO paciente (nome, cpf, telefone, email, datanascimento, rg, endereco)VALUES ($1, $2, $3, $4, $5, $6, $7)';
        $vetor = array($paciente->getNome(), $paciente->getCpf(), $paciente->getTelefone(), $paciente->getEmail(), $paciente->getDataNascimento(), $paciente->getRg(), $paciente->getEndereco());
        $res = pg_query_params($con, $sql, $vetor);
        
        foreach ($paciente->getConvenios() as $c) {
            $sql2 = 'INSERT INTO conveniopaciente (codconvenio, cpfpaciente) VALUES ($1, $2)';
            $vetor2 = array($c->getCodigo(),$paciente->getCpf()); 
            $res = pg_query_params($con, $sql2, $vetor2);
        }
        
        pg_close($con);
    }

    public function excluir($cpf) {
        $con = $this->getConexao();
        $sql = 'DELETE FROM paciente WHERE cpf=$1';
        $res = pg_query_params($con, $sql, array($cpf));
        
        pg_close($con);
    }

    public function alterar($paciente) {
        $con = $this->getConexao();
        $sql = 'UPDATE paciente SET nome = $1, telefone = $2, email = $3, datanascimento = $4, rg = $5, endereco = $6 WHERE cpf = $7';
        $vetor = array($paciente->getNome(), $paciente->getTelefone(), $paciente->getEmail(), $paciente->getDataNascimento(), $paciente->getRg(), $paciente->getEndereco(), $paciente->getCpf());

        $res = pg_query_params($con, $sql, $vetor);

        foreach ($paciente->getConvenios() as $c) {
            $sql2 = 'INSERT INTO conveniopaciente (codconvenio, cpfpaciente) VALUES ($1,$2)';
            $vetor2 = array($c->getCodigo(),$paciente->getCpf()); 
            $res = pg_query_params($con, $sql2, $vetor2);
        }
        pg_close($con);
    }
}
?>


