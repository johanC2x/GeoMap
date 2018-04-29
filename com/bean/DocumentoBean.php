<?php 
	class DocumentoBean{
		
		public $idDocumento;
		public $nombre;
		public $estado;
		public $creaPor;
		public $creaFecha;

		public function getIdDocumento() {
	        return $this->idDocumento;
	    }
	    public function setIdDocumento($idDocumento) {
	        $this->idDocumento = $idDocumento;
	    }

	    public function getNombre() {
	        return $this->nombre;
	    }
	    public function setNombre($nombre) {
	        $this->nombre = $nombre;
	    }

	    public function getEstado() {
	        return $this->estado;
	    }
	    public function setEstado($estado) {
	        $this->estado = $estado;
	    }

	    public function getCreaPor() {
	        return $this->creaPor;
	    }
	    public function setCreaPor($creaPor) {
	        $this->creaPor = $creaPor;
	    }

	    public function getCreaFecha() {
	        return $this->creaFecha;
	    }
	    public function setCreaFecha($creaFecha) {
	        $this->creaFecha = $creaFecha;
	    }

	}
 ?>