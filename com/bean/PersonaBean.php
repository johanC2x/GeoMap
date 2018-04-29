<?php 
	
	class PersonaBean{

		public $idPersona;
		public $nombre;
		public $apePat;
		public $apeMat;
		public $edad;
		public $nroDoc;
		public $idTipoDoc;
		public $sexo;
		public $fechaNac;


    public function getIdPersona(){
        return $this->idPersona;
    }

    public function setIdPersona($idPersona){
        $this->idPersona = $idPersona;
        return $this;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
        return $this;
    }

    public function getApePat(){
        return $this->apePat;
    }

    public function setApePat($apePat){
        $this->apePat = $apePat;
        return $this;
    }

    public function getApeMat(){
        return $this->apeMat;
    }

    public function setApeMat($apeMat){
        $this->apeMat = $apeMat;
        return $this;
    }

    public function getEdad(){
        return $this->edad;
    }

    public function setEdad($edad){
        $this->edad = $edad;
        return $this;
    }

    public function getNroDoc(){
        return $this->nroDoc;
    }

    public function setNroDoc($nroDoc){
        $this->nroDoc = $nroDoc;
        return $this;
    }

    public function getIdTipoDoc(){
        return $this->idTipoDoc;
    }

    public function setIdTipoDoc($idTipoDoc){
        $this->idTipoDoc = $idTipoDoc;
        return $this;
    }

    public function getSexo(){
        return $this->sexo;
    }

    public function setSexo($sexo){
        $this->sexo = $sexo;
        return $this;
    }

    public function getFechaNac(){
        return $this->fechaNac;
    }

    public function setFechaNac($fechaNac){
        $this->fechaNac = $fechaNac;
        return $this;
    }
}

?>