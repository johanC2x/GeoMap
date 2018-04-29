<?php 
	
	class PerfilUsuarioBean{
		
		public $idPerfil;
		public $idUsuario;

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

	    /**
	     * Gets the value of idUsuario.
	     *
	     * @return mixed
	     */
	    public function getIdUsuario()
	    {
	        return $this->idUsuario;
	    }

	    /**
	     * Sets the value of idUsuario.
	     *
	     * @param mixed $idUsuario the id usuario
	     *
	     * @return self
	     */
	    public function setIdUsuario($idUsuario)
	    {
	        $this->idUsuario = $idUsuario;

	        return $this;
	    }
	}

 ?>