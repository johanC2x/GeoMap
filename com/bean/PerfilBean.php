<?php 

	class PerfilBean{
		
		public $idPerfil;
		public $nombre;
		public $estado;
	
		//Ayuda
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
	     * Gets the value of nombre.
	     *
	     * @return mixed
	     */
	    public function getNombre()
	    {
	        return $this->nombre;
	    }

	    /**
	     * Sets the value of nombre.
	     *
	     * @param mixed $nombre the nombre
	     *
	     * @return self
	     */
	    public function setNombre($nombre)
	    {
	        $this->nombre = $nombre;

	        return $this;
	    }

	    /**
	     * Gets the value of estado.
	     *
	     * @return mixed
	     */
	    public function getEstado()
	    {
	        return $this->estado;
	    }

	    /**
	     * Sets the value of estado.
	     *
	     * @param mixed $estado the estado
	     *
	     * @return self
	     */
	    public function setEstado($estado)
	    {
	        $this->estado = $estado;

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