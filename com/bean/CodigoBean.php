<?php 
	
	class CodigoBean{
		
		public $idCodigo;
		public $codigo;
		public $idTipoCodigo;

	    /**
	     * Gets the value of idCodigo.
	     *
	     * @return mixed
	     */
	    public function getIdCodigo()
	    {
	        return $this->idCodigo;
	    }

	    /**
	     * Sets the value of idCodigo.
	     *
	     * @param mixed $idCodigo the id codigo
	     *
	     * @return self
	     */
	    public function setIdCodigo($idCodigo)
	    {
	        $this->idCodigo = $idCodigo;

	        return $this;
	    }

	    /**
	     * Gets the value of codigo.
	     *
	     * @return mixed
	     */
	    public function getCodigo()
	    {
	        return $this->codigo;
	    }

	    /**
	     * Sets the value of codigo.
	     *
	     * @param mixed $codigo the codigo
	     *
	     * @return self
	     */
	    public function setCodigo($codigo)
	    {
	        $this->codigo = $codigo;

	        return $this;
	    }

	    /**
	     * Gets the value of idTipoCodigo.
	     *
	     * @return mixed
	     */
	    public function getIdTipoCodigo()
	    {
	        return $this->idTipoCodigo;
	    }

	    /**
	     * Sets the value of idTipoCodigo.
	     *
	     * @param mixed $idTipoCodigo the id tipo codigo
	     *
	     * @return self
	     */
	    public function setIdTipoCodigo($idTipoCodigo)
	    {
	        $this->idTipoCodigo = $idTipoCodigo;

	        return $this;
	    }
}

 ?>