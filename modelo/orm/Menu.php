<?php

class Menu{
    private $idmenu;
    private $menombre;
    private $medescripcion;
    private $idpadre;
    private $medeshabilitado;
    private $mensajeoperacion;

    public function __construct(){
        $this->idmenu="";
        $this->menombre="";
        $this->medescripcion="";
        $this->idpadre="";
        $this->medeshabilitado="";
        $this->mensajeoperacion="";

    }

    public function getIdmenu()
    {
        return $this->idmenu;
    }

    public function setIdmenu($idmenu)
    {
        $this->idmenu = $idmenu;

        return $this;
    }

  
    public function getMenombre()
    {
        return $this->menombre;
    }

   
    public function setMenombre($menombre)
    {
        $this->menombre = $menombre;

        return $this;
    }

    
    public function getMedescripcion()
    {
        return $this->medescripcion;
    }

    
    public function setMedescripcion($medescripcion)
    {
        $this->medescripcion = $medescripcion;

        return $this;
    }

   
    public function getIdpadre()
    {
        return $this->idpadre;
    }

   
    public function setIdpadre($idpadre)
    {
        $this->idpadre = $idpadre;

        return $this;
    }

    
    public function getMedeshabilitado()
    {
        return $this->medeshabilitado;
    }

   
    public function setMedeshabilitado($medeshabilitado)
    {
        $this->medeshabilitado = $medeshabilitado;

        return $this;
    }

  
    public function getmensajeoperacion()
    {
        return $this->mensajeoperacion;
    }


    public function setmensajeoperacion($mensajedeoperacion)
    {
        $this->mensajeoperacion = $mensajedeoperacion;

        return $this;
    }

    public function setear($idmenu,$menombre,$medescripcion,$idpadre,$medeshabilitado){
        $this->setIdmenu($idmenu);
        $this->setMenombre($menombre);
        $this->setMedescripcion($medescripcion);
        $this->setIdpadre($idpadre);
        $this->setMedeshabilitado($medeshabilitado);

    }

 
    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM menu WHERE idmenu = ".$this->getIdmenu();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    
                    $this->setear($row['idmenu'], $row['menombre'], $row['medescripcion'], $row['idpadre'],$row['medeshabilitado']);
                    $resp=true;
                }
            }
        } else {
            $this->setmensajeoperacion("Menu->listar: ".$base->getError());
        }
        return $resp;
      
    }

    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO menu(menombre,medescripcion,medeshabilitado)
            VALUES('".$this->getMenombre()."','".$this->getMedescripcion()."','".$this->getMedeshabilitado()."')";
        echo $sql;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
              
                $resp = true;
            } else {
               $this->setmensajeoperacion("Menu->insertar: ".$base->getError());
            }
        } else {
           $this->setmensajeoperacion("Menu->insertar: ".$base->getError());
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE menu SET idmenu='".$this->getIdmenu()."',menombre='".$this->getMenombre().
        "',medescripcion='".$this->getMedescripcion()."',idpadre='".$this->getIdpadre()."',medeshabilitado='".$this->getMedeshabilitado()."'
         WHERE idmenu='".$this->getIdmenu()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Menu->modificar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Menu->modificar: ".$base->getError());
        }
        return $resp;
    }
    
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM menu WHERE idmenu=".$this->getIdmenu();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("menu->eliminar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("menu->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public static function listar($parametro){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM menu ";
        
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new Menu();
                    $obj->setear($row['idmenu'], $row['menombre'], $row['medescripcion'], $row['idpadre'],$row['medeshabilitado']);
                    array_push($arreglo, $obj);
                }
    
            }
            
        } else {
            $this->setmensajeoperacion("Menu->listar: ".$base->getError());
        }
    
        return $arreglo;
    }



}







?>