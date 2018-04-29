<?php 
 
	class DistritoBean{
		
		public $idDistrito;
		public $nombre;

		public function getIdDistrito() {
	        return $this->idDistrito;
	    }
	    public function setIdDistrito($idDistrito) {
	        $this->idDistrito = $idDistrito;
	    }

		public function getNombre() {
	        return $this->nombre;
	    }
	    public function setNombre($nombre) {
	        $this->nombre = $nombre;
	    }	    

	}

 ?>