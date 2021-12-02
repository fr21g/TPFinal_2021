<?php
class Compraestado{

    //Atributos de clase
    /** 
     * @var int $idcompraestado
     * @var object $objCompra
     * @var object $objCompraEstadoTipo
     * @var DataTime $cefechaini
     * @var DateTime $cefechafin
     * @var string $mensajeoperacion
     */

    private $idcompraestado;
    private $objCompra;
    private $objCompraEstadoTipo;
    private $cefechaini;
    private $cefechafin;
    private $mensajeoperacion;

    public function __construct(){
        $this->idcompraestado=0;
        $this->objCompra= new Compra();
        $this->objCompraEstadoTipo= new Compraestadotipo();
        $this->cefechaini="";
        $this->cefechafin="";
        $this->mensajeoperacion="";        
    }
    
    public function getIdCompraEstado(){
        return $this->idcompraestado;
    }

    public function setIdCompraEstado($idcompraestado){
        $this->idcompraestado = $idcompraestado;

    }

    /** @return object */
    public function getObjCompra(){
        return $this->objCompra;
    }

    public function setObjCompra($objCompra){
        $this->objCompra = $objCompra;

    }

    /** @return object */
    public function getObjCompraEstadoTipo(){
        return $this->objCompraEstadoTipo;
    }

    public function setObjCompraEstadoTipo($objCompraEstadoTipo){
        $this->objCompraEstadoTipo = $objCompraEstadoTipo;

    }

    public function getCeFechaIni(){
        return $this->cefechaini;
    }

    public function setCeFechaIni($cefechaini){
        $this->cefechaini = $cefechaini;

    }

    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }

    public function setMensajeoperacion($mensajeoperacion){
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function getCeFechaFin(){
        return $this->cefechafin;
    }

    public function setCeFechaFin($cefechafin){
        $this->cefechafin = $cefechafin;

    }

    public function setear($idcompraestado,$objCompra,$objCompraEstadoTipo,$cefechaini,$cefechafin){
        $this->setIdCompraEstado($idcompraestado);
        $this->setObjCompra($objCompra);
        $this->setObjCompraEstadoTipo($objCompraEstadoTipo);
        $this->setCeFechaIni($cefechaini);
        $this->setCeFechaFin($cefechafin);

    }

    public function cargar(){
        $resp = false;
        $base = new BaseDatos();
        $sql="SELECT * FROM compraestado WHERE idcompraestado = ".$this->getIdCompraEstado();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $idcompra = new Compra();
                    $idcompra->setIdcompra($row['idcompra']);
                    $idcompra->cargar();
                    $idcompraETipo = new Compraestadotipo();
                    $idcompraETipo->setidcompraestadotipo($row['idcompraestadotipo']);
                    $idcompraETipo->cargar();
                    $this->setear($row['idcompraestado'], $idcompra, $idcompraETipo, $row['cefechaini'],$row['cefechafin']);
                    $resp=true;
                }
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
        
    }

    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO compraestado(idcompra,idcompraestadotipo,cefechaini,cefechafin)
            VALUES(".$this->getObjCompra()->getIdcompra().",".$this->getObjCompraEstadoTipo()->getidcompraestadotipo().",'".$this->getCeFechaIni()."','".$this->getCeFechaFin()."' )";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
            
                $resp = true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE compraestado SET idcompraestado=".$this->getIdCompraEstado().",idcompra=". $this->getObjCompra()->getIdCompra().
        ",idcompraestadotipo=".$this->getObjCompraEstadoTipo()->getIdCompraEstadoTipo().",cefechaini='".$this->getCeFechaIni()."',cefechafin='".$this->getcefechafin()."'
        WHERE idcompraestado=".$this->getIdCompraEstado();
        echo $sql;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }
    
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM compraestado WHERE idcompraestado=".$this->getIdCompraEstado();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }
    
    public static function listar($parametro){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM compraestado ";
        
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new Compraestado();
                    $idcompra = new Compra();
                    $idcompra->setIdcompra($row['idcompra']);
                    $idcompra->cargar();
                    $idcompraETipo = new Compraestadotipo();
                    $idcompraETipo->setidcompraestadotipo($row['idcompraestadotipo']);
                    $idcompraETipo->cargar();
                    $obj->setear($row['idcompraestado'], $idcompra, $idcompraETipo, $row['cefechaini'],$row['cefechafin']);
                    array_push($arreglo, $obj);
                }
    
            }
            
        } else {
            $this->setmensajeoperacion($base->getError());
        }
    
        return $arreglo;
    }

    
}


?>