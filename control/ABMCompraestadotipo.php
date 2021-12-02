<?php

class ABMCompraestadotipo{
   
    private function cargarObjeto($param){
        $obj = null;
           
        if( array_key_exists('idcompraestadotipo', $param)
        and array_key_exists('cetdescripcion',$param)
        and array_key_exists('cetdetalle',$param)){
            $obj = new Compraestadotipo();
            $obj->setear($param['idcompraestadotipo'],$param['cetdescripcion'],$param['cetdetalle']);
        }
        return $obj;
    }
    
    private function cargarObjetoConClave($param){
        $obj = null;
        
        if( isset($param['idcompraestadotipo']) ){
            $obj = new Compraestadotipo();
            $obj->setear($param['idcompraestadotipo'],null,null,null,null);
        }
        return $obj;
    }

    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idcompraestadotipo']))
            $resp = true;
        return $resp;
    }
    
    public function alta($param){
        $resp = false;
        $elObjtTabla = $this->cargarObjeto($param);

        if ($elObjtTabla!=null and $elObjtTabla->insertar()){
            $resp = true;
        }
        return $resp;
        
    }

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
    
    public function buscar($param){
        $where = " true ";
        if ($param<>NULL){
            if  (isset($param['idcompraestadotipo']))
                $where.=" and idcompraestadotipo =".$param['idcompraestadotipo'];
            if  (isset($param['cetdescripcion']))
            $where.=" and cetdescripcion ='".$param['cetdescripcion']."'";
            if  (isset($param['cetdetalle']))
                $where.=" and cetdetalle ='".$param['cetdetalle']."'";
            }
        $arreglo = Compraestadotipo::listar($where);
        return $arreglo;
    }

}

?>