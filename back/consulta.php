<?php
class Consulta{
    private $codigo;
    private $data_hora;
    private $paciente;
    private $medico;
    private $convenio;

    public function Consulta(DateTime $data_hora){
        $this->data_hora = $data_hora;
    }

    public function getDataHora(){
        return $this->data_hora;
    }

    public function getCodigo(){
        return $this->codigo;
    }

    public function getPac(){
        return $this->paciente;
    }

    public function getMed(){
        return $this->medico;
    }

    public function getConve(){
        return $this->convenio;
    }

    public function setPac(Paciente $paciente){
        $this->paciente = $paciente;
    }

    public function setDataHora(DateTime $data){
        $this->data_hora = $datas;
    }

    public function setMed(Medico $medico){
        $this->medico = $medico;
    }

    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }

    public function setConvenio(Convenio $convenio){
        $this->convenio = $convenio;
    } 
}
?>