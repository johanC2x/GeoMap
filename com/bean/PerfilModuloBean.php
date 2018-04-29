<?php 

	class PerfilModuloBean{
		
		public $idModulo;
		public $idPerfil;

	    /**
	     * Gets the value of idModulo.
	     *
	     * @return mixed
	     */
	    public function getIdModulo()
	    {
	        return $this->idModulo;
	    }

	    /**
	     * Sets the value of idModulo.
	     *
	     * @param mixed $idModulo the id modulo
	     *
	     * @return self
	     */
	    public function setIdModulo($idModulo)
	    {
	        $this->idModulo = $idModulo;

	        return $this;
	    }

	    /**
	     * Gets the value of idPerfil.
	     *
	     * @return mixed
	     */
	    public function getIdPerfil()
	    {
	        return $this->idPerfil;
	    }

	    /**
	     * Sets the value of idPerfil.
	     *
	     * @param mixed $idPerfil the id perfil
	     *
	     * @return self
	     */
	    public function setIdPerfil($idPerfil)
	    {
	        $this->idPerfil = $idPerfil;

	        return $this;
	    }
	}

?>