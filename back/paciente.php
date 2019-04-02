<?php

class Paciente {
    private $nome;
    private $cpf;
    private $telefone;
    private $email;
    private $datanascimento;
    private $rg;
    private $endereco;
    private $convenios;

    public function Paciente (string $nome, string $cpf, string $datanascimento, string $endereco){
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->datanascimento = $datanascimento;
        $this->endereco = $endereco;
        $this->convenios = array();
    }

    public function getNome() {
        return $this->nome;
    }
    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getCpf() {
        return $this->cpf;
    }
    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getTelefone() {
        return $this->telefone;
    }
    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }

    public function getDataNascimento() {
        return $this->datanascimento;
    }
    public function setDataNascimento($datanascimento) {
        $this->datanascimento = $datanascimento;
    }

    public function getRg() {
        return $this->rg;
    }
    public function setRg($rg) {
        $this->rg = $rg;
    }

    public function getEndereco() {
        return $this->endereco;
    }
    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function getConvenios() {
        return $this->convenios;
    }
    public function setConvenios($convenios) {
        $this->convenios = $convenios;
    }
    public function addConvenio(Convenio $convenio) {
        array_push($this->convenios,$convenio);
    }
}

?>