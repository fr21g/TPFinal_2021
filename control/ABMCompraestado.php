<?php

class ABMCompraestado{

    private function cargarObjeto($param){
        $obj = null;
        
        if( array_key_exists('idcompraestado',$param)
        and array_key_exists('idcompra',$param)
        and array_key_exists('idcompraestadotipo',$param)
        and array_key_exists('cefechaini',$param)
        and array_key_exists('cefechafin',$param)){
            $obj= new Compraestado();
            $idcompra= new Compra();
            $idcompra->setIdcompra($param['idcompra']);
            $idcompra->cargar();
            $idcompraETipo= new Compraestadotipo();
            $idcompraETipo->setidcompraestadotipo($param['idcompraestadotipo']);
            //$idcompraETipo->cargar();
            $obj->setear($param['idcompraestado'], $idcompra, $idcompraETipo, $param['cefechaini'], $param['cefechafin']);
        }
        return $obj;
    }
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres
     *  de las variables instancias del objeto que son claves
     * @param array $param
     * @return Compraestado
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        
        if( isset($param['idcompraestado']) ){
            $obj= new Compraestado();
            $obj->setear($param['idcompraestado'],null,null,null,null);
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
        if (isset($param['idcompraestado']))
            $resp = true;
        return $resp;
    }
    
    /**
     * 
     * @param array $param
     */
    public function alta($param){
        $resp = false;
        $elObjURol = $this->cargarObjeto($param);
        if ($elObjURol!=null and $elObjURol->insertar()){
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
            $elObjRol = $this->cargarObjetoConClave($param);
            if ($elObjRol!=null and $elObjRol->eliminar()){
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
        //echo "hola";
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtTabla = $this->cargarObjeto($param);
            //print_r($elObjtTabla);
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
            if(isset($param['idcompraestado']))
                $where.=" and idcompraestado =".$param['idcompraestado'];
            if(isset($param['idcompra']))
                $where.=" and idcompra =".$param['idcompra'];
            if(isset($param['idcompraestadotipo']))
                $where.=" and idcompraestadotipo =".$param['idcompraestadotipo'];
            if(isset($param['cefechaini']))
                $where.=" and cefechaini ='".$param['cefechaini']."'";
            if(isset($param['cefechafin']))
                $where.=" and cefechafin ='".$param['cefechafin']."'";
        }
        $arreglo = Compraestado::listar($where);
        return $arreglo;
    }

}


?>