<?php 

	class UsuarioBean{
		public $idUsuario;
		public $usuario;
		public $passw;
		public $estado;
		public $idPersona;	
 
	    public function getIdUsuario(){
	        return $this->idUsuario;
	    }
	    public function setIdUsuario($idUsuario){
	        $this->idUsuario = $idUsuario;
	        return $this;
	    }

	    public function getUsuario(){
	        return $this->usuario;
	    }
	    public function setUsuario($usuario){
	        $this->usuario = $usuario;
	        return $this;
	    }

	    public function getPassw(){
	        return $this->passw;
	    }

	    public function setPassw($passw){
	        $this->passw = $passw;
	        return $this;
	    }

	    public function getEstado(){
	        return $this->estado;
	    }

	    public function setEstado($estado){
	        $this->estado = $estado;
	        return $this;
	    }

	    public function getIdPersona(){
	        return $this->idPersona;
	    }

	    public function setIdPersona($idPersona){
	        $this->idPersona = $idPersona;
	        return $this;
	    }

}

?>