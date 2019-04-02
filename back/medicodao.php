<?php
require_once('abstractdao.php');
Class MedicoDao extends Dao{
    public function inserir($medico){
        $conn = $this->getConexao();
        $sql = "INSERT INTO medico (nome,cpf,crm,salario,telefone,email,datanascimento) VALUES ($1,$2,$3,$4,$5,$6,$7)";
        $vetor = array($medico->getNome(),$medico->getCpf(),$medico->getCrm(),          $medico->getSalario(),$medico->getTelefone(),$medico->getEmail(),        $medico->getDataNascimento());
        $res = pg_query_params($conn, $sql,$vetor);
        pg_close($conn);
    }
    public function excluir($crm){
        $conn = $this->getConexao();
        $sql = "DELETE FROM medico WHERE crm = $1";
        $res = pg_query_params($conn,$sql,array($crm));
        pg_close($conn);
    }
    public function buscar($crm){
        $conn = $this->getConexao();
        $sql = "SELECT * FROM medico WHERE crm = $1";
        $res = pg_query_params($conn, $sql, array($crm));
        $linha = pg_fetch_assoc($res);

        $medico = new Medico($linha['nome'], $linha['cpf'],$linha['crm'], $linha['salario'], $linha['telefone'], $linha['email'],$linha['datanascimento']);
        pg_close($conn);
        return $medico;
    }
    public function listar(int $limit, int $offset){
        $conn = $this->getConexao();
        $sql = "SELECT * FROM medico LIMIT $1 OFFSET $2";
        $vetor = array($limit,$offset);
        $res = pg_query_params($conn,$sql,$vetor);
        $listamedicos = array();
        while($linha = pg_fetch_assoc($res)){
            $medico = new Medico($linha['nome'], $linha['cpf'],$linha['crm'], $linha['salario'], $linha['telefone'], $linha['email'],$linha['datanascimento']);
            array_push($listamedicos,$medico);
        }
        pg_close($conn);
        return $listamedicos;
    }
    public function alterar($medico){
		$conn = $this->getConexao();
        $sql = "UPDATE medico SET nome=$1, cpf=$2, salario=$3,telefone=$4,email=$5,                     datanascimento=$6 WHERE crm = $7";
        $vetor = array($medico->getNome(),$medico->getCpf(), $medico->getSalario(), $medico->getTelefone(), $medico->getEmail(), $medico->getDatanascimento(), $medico->getCrm());
		$res = pg_query_params($conn,$sql,$vetor);
		pg_close($conn);
	}
}
?>