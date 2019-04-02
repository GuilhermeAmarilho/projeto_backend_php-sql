<?php

abstract class Dao{
    
    protected function getConexao () {
        $strCon = "host=localhost port=5432 dbname=clinica user=postgres password=postgres";
        $conexao = pg_connect($strCon);
        return $conexao; 
    }

    abstract public function listar(int $limit, int $offset);
    abstract public function buscar($key);
    abstract public function inserir($obj);
    abstract public function excluir($key);
    abstract public function alterar($obj);


}


?>