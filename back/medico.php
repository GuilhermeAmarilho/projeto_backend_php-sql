<?php
class Medico{
    private $nome;
    private $cpf;
    private $crm;
    private $salario;
    private $telefone;
    private $email;
    private $dataNascimento;

    public function Medico(String $nome,String $cpf,String $crm, int $salario, String $telefone, String $email, string $dataNascimento){
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->crm = $crm;
        $this->salario = $salario;
        $this->telefone = $telefone;
        $this->email = $email;
        $this->dataNascimento = $dataNascimento;
    }
    public function getNome(){
        return $this->nome;
    }

    public function getCpf(){
        return $this->cpf;
    }

    public function getCrm(){
        return $this->crm;
    }

    public function getSalario(){
        return $this->salario;
    }

    public function getTelefone(){
        return $this->telefone;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getDataNascimento(){
        return $this->dataNascimento;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function setCpf($cpf){
        $this->cpf = $cpf;
    }

    public function setCrm($crm){
        $this->crm = $crm;
    }

    public function setSalario($salario){
        $this->salario = $salario;
    }

    public function setTelefone($telefone){
        $this->cpf = $telefone;
    }

    public function setEmail($email){
        $this->email = $email;
    }
    
    public function setDataNascimento($datanascimento){
        $this->dataNascimento = $datanascimento;
    }
}
?>