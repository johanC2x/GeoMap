<?php 
	
	class TipoCodigoBean{
		
		public $idTipoCodigo;
		public $tipoCodigo;	

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

	    /**
	     * Gets the value of tipoCodigo.
	     *
	     * @return mixed
	     */
	    public function getTipoCodigo()
	    {
	        return $this->tipoCodigo;
	    }

	    /**
	     * Sets the value of tipoCodigo.
	     *
	     * @param mixed $tipoCodigo the tipo codigo
	     *
	     * @return self
	     */
	    public function setTipoCodigo($tipoCodigo)
	    {
	        $this->tipoCodigo = $tipoCodigo;

	        return $this;
	    }
}

 ?>