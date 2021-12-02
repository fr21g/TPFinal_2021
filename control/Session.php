<?php

class Session {

    public function __construct(){
        session_start();
    }
            
    
    /**
     * Actualiza las variables de sesión con los valores ingresados
     */
    public function iniciar($usnombre,$uspass){  
        $ini=false;
        $uspass=md5($uspass);
        if($this->validar($usnombre,$uspass)){
            $ini=true;
        }   
        return $ini;
    }
    
    /**
     *  Valida si la sesión actual tiene usuario y psw válidos. Devuelve true o false.
     */
    public function validar($usnombre,$uspass){
        $valido=false;
        $abmUs=new ABMUsuario();
        $list=$abmUs->buscar(["usnombre"=>$usnombre,"uspass"=>$uspass]);
        if(count($list)>0){
            if($list[0]->getUsDeshabilitado()==NULL || $list[0]->getUsDeshabilitado()=="0000-00-00 00:00:00"){
                $_SESSION["idusuario"]=$list[0]->getIdUsuario();
                $valido=true;
            }            
        }
        return $valido;
    }

    /**
     * Devuelve el verdadero si hay una sesión activa y falso en caso contrario
     * 
     * @return boolean activa y false si no está activa o no se encuetra seteado
     */
    public function activa() {
        $retorno=false;
        if (isset($_SESSION['idusuario'])) {
            $retorno= true;
        } else {
            $this->ERROR = 'No tiene sesión activa';
            $retorno= false;
        }
        return $retorno;
    }

    /** devuelve el usuario logeado */

    public function getUsuario(){
        $Objusuario=null;
        $abmusuario=new ABMUsuario();
        $buscarusuario= $abmusuario->buscar(['idusuario'=>$_SESSION['idusuario']]);
        if(count($buscarusuario)>0){
            $Objusuario=$buscarusuario[0];
        }
        return $Objusuario;

    }

    /** devuelve una coleccion de arreglo de roles de usuario */
    public function getRol(){
        $idusuario=array();
        $idusuario['idusuario'] = $_SESSION['idusuario'];
        $abmusRol= new ABMUsuariorol();
        $roles= $abmusRol->buscar($idusuario);
        $rolesusuario=array();
        foreach($roles as $rolusuario){
            array_push($rolesusuario,$rolusuario->getObj_rol()->getRodescript());
        }

        return $rolesusuario;
    }



    /**
     * Cierra la session actual
     *
     * @return boolean
     */
    public function cerrar() {
        $sesion=true;
        if (!session_destroy()) {
            $this->ERROR = 'No se puede cerrar la sesion';
            $sesion=false;
        } 
        return $sesion;
    }

     


}


?>