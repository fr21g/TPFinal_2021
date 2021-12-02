<?php

class ABMMenu{

    private function cargarObjeto($param){
        $obj = null;
           
        if( array_key_exists('idmenu', $param)
        and array_key_exists('menombre',$param)
        and array_key_exists('medescripcion',$param) 
        and array_key_exists('idpadre',$param)
        and array_key_exists('medeshabilitado',$param)){
            $obj = new Menu();
            $obj->setear($param['idmenu'],$param['menombre'],$param['medescripcion'], $param['idpadre'], $param['medeshabilitado']);
        }
        return $obj;
    }
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres
     *  de las variables instancias del objeto que son claves
     * @param array $param
     * @return Tabla
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        
        if( isset($param['idmenu']) ){
            $obj = new Menu();
            $obj->setear($param['idmenu'],null,null,null,null);
        }
        return $obj;
    }
    
    
    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idmenu']))
            $resp = true;
        return $resp;
    }
    
    /**
     * 
     * @param array $param
     */
    public function alta($param){
        $resp = false;
        $param['idmenu'] = null;
        $elObjtTabla = $this->cargarObjeto($param);
        //verEstructura($elObjtTabla);
        if ($elObjtTabla!=null and $elObjtTabla->insertar()){
            $resp = true;
        }
        return $resp;
        
    }
    /**
     * permite eliminar un objeto 
     * @param array $param
     * @return boolean
     */
    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtTabla = $this->cargarObjetoConClave($param);
            if ($elObjtTabla!=null and $elObjtTabla->eliminar()){
                $resp = true;
            }
        }
        
        return $resp;
    }
    
    /**
     * permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($param){
       
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtTabla = $this->cargarObjeto($param);
            if($elObjtTabla!=null and $elObjtTabla->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }
    
    /**
     * permite buscar un objeto
     * @param array $param
     * @return 
     */
    public function buscar($param){
        $where = " true ";
        if ($param<>NULL){
            if  (isset($param['idmenu']))
                $where.=" and idmenu =".$param['idmenu'];
            if  (isset($param['menombre']))
                $where.=" and menombre ='".$param['menombre']."'";
            if  (isset($param['medescripcion']))
                $where.=" and medescripcion ='".$param['medescripcion']."'";
                if  (isset($param['idpadre']))
                $where.=" and idpadre =".$param['idpadre'];
                if  (isset($param['medeshabilitado']))
                $where.=" and medeshabilitado ='".$param['medeshabilitado']."'";
        }
        $arreglo = Menu::listar($where);
        return $arreglo;
    }


    public function buscarHref($idmenu){
        $filtro['menombre'] = $idmenu;

        $array = $this->buscar($filtro);

        $href = $array[0]->getMedescripcion();

        return $href;
    }




}


?>