<?php 
	
	class ModuloBean{
		
		public $idModulo;
		public $idModuloPadre;
		public $objeto;
		public $recurso;
		public $estado;
		public $descripcion;
		public $dependencia;

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
	     * Gets the value of idModuloPadre.
	     *
	     * @return mixed
	     */
	    public function getIdModuloPadre()
	    {
	        return $this->idModuloPadre;
	    }

	    /**
	     * Sets the value of idModuloPadre.
	     *
	     * @param mixed $idModuloPadre the id modulo padre
	     *
	     * @return self
	     */
	    public function setIdModuloPadre($idModuloPadre)
	    {
	        $this->idModuloPadre = $idModuloPadre;

	        return $this;
	    }

	    /**
	     * Gets the value of objeto.
	     *
	     * @return mixed
	     */
	    public function getObjeto()
	    {
	        return $this->objeto;
	    }

	    /**
	     * Sets the value of objeto.
	     *
	     * @param mixed $objeto the objeto
	     *
	     * @return self
	     */
	    public function setObjeto($objeto)
	    {
	        $this->objeto = $objeto;

	        return $this;
	    }

	    /**
	     * Gets the value of recurso.
	     *
	     * @return mixed
	     */
	    public function getRecurso()
	    {
	        return $this->recurso;
	    }

	    /**
	     * Sets the value of recurso.
	     *
	     * @param mixed $recurso the recurso
	     *
	     * @return self
	     */
	    public function setRecurso($recurso)
	    {
	        $this->recurso = $recurso;

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
	     * Gets the value of descripcion.
	     *
	     * @return mixed
	     */
	    public function getDescripcion()
	    {
	        return $this->descripcion;
	    }

	    /**
	     * Sets the value of descripcion.
	     *
	     * @param mixed $descripcion the descripcion
	     *
	     * @return self
	     */
	    public function setDescripcion($descripcion)
	    {
	        $this->descripcion = $descripcion;

	        return $this;
	    }

	    /**
	     * Gets the value of dependencia.
	     *
	     * @return mixed
	     */
	    public function getDependencia()
	    {
	        return $this->dependencia;
	    }

	    /**
	     * Sets the value of dependencia.
	     *
	     * @param mixed $dependencia the dependencia
	     *
	     * @return self
	     */
	    public function setDependencia($dependencia)
	    {
	        $this->dependencia = $dependencia;

	        return $this;
	    }
	}

?>