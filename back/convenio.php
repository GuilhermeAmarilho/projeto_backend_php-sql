<?php

class Convenio {
    private $codigo;
    private $nome;

    public function Convenio($codigo) {
        $this->codigo = $codigo;
    }

    public function getCodigo() {
        return $this->codigo;
    }
    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getNome() {
        return $this->nome;
    }
    public function setNome($nome) {
        $this->nome = $nome;
    }
}
?>