<?php 
	class MapBean {
		public $idMap;
		public $solicitud;
		public $actividad;
		public $nombreContratista;
		public $cliente;
		public $dirObra;
		public $distrito;
		public $rolLiquidador;
		public $tecnico;
		public $finReal;
		public $mes;
		public $ruta;
		public $codigo;
		public $contratista;
		public $flgEstado;
		public $descripcion;
		public $fechaFin;
		public $fechaIni;
		public $lat;
		public $lng;
		public $access_code;
		public $idUser;

		//AYUDA
		public $anio;

		public function getIdMap() {
	        return $this->idMap;
	    }
	    public function setIdMap($idMap) {
	        $this->idMap = $idMap;
	    }

	    public function getSolicitud() {
	        return $this->solicitud;
	    }
	    public function setSolicitud($solicitud) {
	        $this->solicitud = $solicitud;
	    }

	    public function getActividad() {
	        return $this->actividad;
	    }
	    public function setActividad($actividad) {
	        $this->actividad = $actividad;
	    }

	    public function getNombreContratista() {
	        return $this->nombreContratista;
	    }
	    public function setNombreContratista($nombreContratista) {
	        $this->nombreContratista = $nombreContratista;
	    }

	    public function getCliente() {
	        return $this->cliente;
	    }
	    public function setCliente($cliente) {
	        $this->cliente = $cliente;
	    }

	    public function getDirObra() {
	        return $this->dirObra;
	    }
	    public function setDirObra($dirObra) {
	        $this->dirObra = $dirObra;
	    }

	    public function getDistrito() {
	        return $this->distrito;
	    }
	    public function setDistrito($distrito) {
	        $this->distrito = $distrito;
	    }

	    public function getRolLiquidador() {
	        return $this->rolLiquidador;
	    }
	    public function setRolLiquidador($rolLiquidador) {
	        $this->rolLiquidador = $rolLiquidador;
	    }

	    public function getTecnico() {
	        return $this->tecnico;
	    }
	    public function setTecnico($tecnico) {
	        $this->tecnico = $tecnico;
	    }

	    public function getFinReal() {
	        return $this->finReal;
	    }
	    public function setFinReal($finReal) {
	        $this->finReal = $finReal;
	    }

	    public function getMes() {
	        return $this->mes;
	    }
	    public function setMes($mes) {
	        $this->mes = $mes;
	    } 
	    public function getRuta(){
	        return $this->ruta;
	    }
	    public function setRuta($ruta){
	        $this->ruta = $ruta;
	        return $this;
	    }
	    public function getCodigo(){
	        return $this->codigo;
	    }
	    public function setCodigo($codigo){
	        $this->codigo = $codigo;
	        return $this;
	    }
	    public function getContratista(){
	        return $this->contratista;
	    }
	    public function setContratista($contratista){
	        $this->contratista = $contratista;
	        return $this;
	    } 
	    public function getFlgEstado(){
	        return $this->flgEstado;
	    }
	    public function setFlgEstado($flgEstado){
	        $this->flgEstado = $flgEstado; 
	        return $this;
	    }
	    public function getDescripcion(){
	        return $this->descripcion;
	    }
	    public function setDescripcion($descripcion){
	        $this->descripcion = $descripcion;
	        return $this;
	    } 
	    public function getFechaFin(){
	        return $this->fechaFin;
	    } 
	    public function setFechaFin($fechaFin){
	        $this->fechaFin = $fechaFin;
	        return $this;
	    }
	    public function getAnio(){
	        return $this->anio;
	    } 
	    public function setAnio($anio){
	        $this->anio = $anio;
	        return $this;
		}
		
	    /**
	     * @return mixed
	     */
	    public function getFechaIni()
	    {
	        return $this->fechaIni;
	    }

	    /**
	     * @param mixed $fechaIni
	     *
	     * @return self
	     */
	    public function setFechaIni($fechaIni)
	    {
	        $this->fechaIni = $fechaIni;

	        return $this;
	    }

	    /**
	     * @return mixed
	     */
	    public function getLat()
	    {
	        return $this->lat;
	    }

	    /**
	     * @param mixed $lat
	     *
	     * @return self
	     */
	    public function setLat($lat)
	    {
	        $this->lat = $lat;

	        return $this;
	    }


	    /**
	     * @return mixed
	     */
	    public function getLng()
	    {
	        return $this->lng;
	    }

	    /**
	     * @param mixed $lng
	     *
	     * @return self
	     */
	    public function setLng($lng)
	    {
	        $this->lng = $lng;

	        return $this;
		}
		
    /**
     * Gets the value of access_code.
     *
     * @return mixed
     */
    public function getAccess_code()
    {
        return $this->access_code;
    }

    /**
     * Sets the value of access_code.
     *
     * @param mixed $access_code the access_code
     *
     * @return self
     */
    public function setAccess_code($access_code)
    {
        $this->access_code = $access_code;

        return $this;
    }




    /**
     * Gets the value of idUser.
     *
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Sets the value of idUser.
     *
     * @param mixed $idUser the id user
     *
     * @return self
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }
    
}
?>