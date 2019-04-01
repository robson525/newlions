<?php 
require_once 'Persistencia.php';

class Convencao {
   
    private $id;
    private $titulo;
    private $aberta;
    
    public function getId() {
        return $this->id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getAberta() {
        return $this->aberta;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setAberta($aberta) {
        $this->aberta = $aberta;
    }

    public static function getAbertas($db){
       
        $sql = "SELECT * FROM __convencao WHERE aberta = '1' ORDER BY id;";
        $array = array();
        
        if($db){
            $db->setQuery($sql);
            $db->execute();
            $convencoes = $db->loadObjectList();
            foreach ($convencoes as $conv){
                 $array[] = (new Convencao())->load($conv);
            }
            
        }else{
            $query = mysql_query($sql);
            while ($result = mysql_fetch_object($query)){
                $array[] = (new Convencao())->load($result);
            }
        }
        
        return $array;
    }
    
    public static function getById($id = 0, $db = null){
        $sql = "SELECT * FROM __convencao WHERE id = " . Persistencia::prepare($id, Persistencia::PK);
        
        if($db){
            $db->setQuery($sql);
            $db->execute();
            $conv = $db->loadObject();
        }else{
            $query = mysql_query($sql);
            $conv = mysql_fetch_object($query);            
        }
        
        if($conv){
            $convencao = new Convencao();
            $convencao->setId($conv->id);
            $convencao->setTitulo($conv->titulo);
            $convencao->setAberta($conv->aberta);
            return $convencao;
        }else{
            return false;
        }
    }

    private function load($convencao_){
        $convencao = new Convencao();
        $convencao->setId($convencao_->id);
        $convencao->setTitulo($convencao_->titulo);
        $convencao->setAberta($convencao_->aberta);
        return $convencao;
    }
    
}


?>
