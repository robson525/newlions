<?php 

class InscricaoConvencao {
    
    private $id;
    private $usuario_id;
    private $convencao_id;
    private $pago;
    private $comprovante;
    private $db;
    
    public function getId() {
        return $this->id;
    }

    public function getUsuario_id() {
        return $this->usuario_id;
    }

    public function getConvencao_id() {
        return $this->convencao_id;
    }

    public function getPago() {
        return $this->pago;
    }
    
    public function getComprovante() {
        return $this->comprovante;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setUsuario_id($usuario_id) {
        $this->usuario_id = $usuario_id;
    }

    public function setConvencao_id($convencao_id) {
        $this->convencao_id = $convencao_id;
    }

    public function setPago($pago) {
        $this->pago = $pago;
    }

    public function setComprovante($comprovante) {
        $this->comprovante = $comprovante;
    }
    
    public function setConnection($db){
        $this->db = $db;
    }

    public function getNinscricao() {        
        return InscricaoConvencao::getSNinscricao($this->id);
    }

    public function save(){
        if(!$this->getId()){
            return $this->insert();
        }else{
            return $this->update();
        } 
    }
    
    private function insert(){
        $sql  = "INSERT INTO __inscricao_convencao (usuario_id, convencao_id) VALUES ( ";
        $sql .= Persistencia::prepare($this->getUsuario_id(), Persistencia::FK) . ", ";
        $sql .= Persistencia::prepare($this->getConvencao_id(), Persistencia::FK) . "); ";
      
        $this->db->setQuery($sql);
        $this->db->execute();
       
        if($this->db->getErrorNum()){
            return false;
        }
        $this->id = $this->db->insertid();
        return true;
    }
    
    private function update(){
        $sql  = "UPDATE __inscricao_convencao SET ";
        $sql .= "pago = " . Persistencia::prepare($this->getPago(), Persistencia::BIT) . ", ";
        $sql .= "comprovante = " . Persistencia::prepare($this->getComprovante(), Persistencia::FK) . " ";
        $sql .= "WHERE id = " . $this->getId();
        $this->db->setQuery($sql);
        $this->db->execute();
        if($this->db->getErrorNum()){
            return false;
        }
        return true;
    }
    
    public static function getById($inscricao_id = 0, $db = null){
        if(!$inscricao_id){
            $inscricao_id = '0';
        }
        $sql = "SELECT * FROM __inscricao_convencao WHERE id = " . Persistencia::prepare($inscricao_id, Persistencia::INT) . " ORDER BY id;";

        $result = false;
        if($db)
        {
            $db->setQuery($sql);
            $db->execute();
            $inscricoes = $db->loadObjectList();
            foreach ($inscricoes as $insc){
                 $result = (new InscricaoConvencao())->load($insc);
            }
        }else
        {
            $query = mysql_query($sql);
            $array = new InscricaoConvencao();
            while ($result = mysql_fetch_object($query)){
                $result = self::load($result);
            }
        }
        $result->setConnection($db);
        return $result;
    }
    
    public static function getByUsuario($usuario_id = 0 , $db = null){
        if(!$usuario_id){
            $usuario_id = '0';
        }
        $sql = "SELECT * FROM __inscricao_convencao WHERE usuario_id = " . Persistencia::prepare($usuario_id, Persistencia::INT) . " ORDER BY id;";
        $array = array();
        
        if($db){
            $db->setQuery($sql);
            $db->execute();
            $inscricoes = $db->loadObjectList();
            foreach ($inscricoes as $insc){
                 $array[] = (new InscricaoConvencao())->load($insc);
            }
            
        }else{
            $query = mysql_query($sql);
            while ($result = mysql_fetch_object($query)){
                $array[] = (new InscricaoConvencao())->load($result);
            }
        }
        
        return $array;
    }
    
    public static function verificaCadastro($usuario_id, $convencao_id, $db = null)
    {
        $sql = "SELECT * FROM __inscricao_convencao WHERE usuario_id = " . Persistencia::prepare($usuario_id, Persistencia::INT) . " AND convencao_id = " . Persistencia::prepare($convencao_id, Persistencia::INT) . ";";
        
        $numRows = 0;
        if($db)
        {
            $db->setQuery($sql);
            $db->execute();
            $numRows = $db->getNumRows();
        }
        else
        {
            $query = mysql_query($sql);
            $numRows = mysql_num_rows($query); 
        }

        if($numRows)        
            return true;
        else
            return false;         
    }
    
    public function InsereComprovante(Comprovante $comprovante){
        
        if($this->getPago()){
            if(!Comprovante::deletaComprovante($this->getComprovante(), $this->db)){
                return false;
            }
        }
        //var_dump($comprovante);die();
        $comprovante->save();
        if($comprovante->getId()){
            $this->setComprovante($comprovante->getId());
            $this->setPago('1');
            return $this->save();
        }else{
            return false;
        }
        
    }
    
    public static function getInscricoesGerencia($convencaoId = 0, $estado, $cidade, $clube, $db = null){
        $sql  = "SELECT u.*, us.name, us.email, us.username as cpf, count(*) as inscricoes ";
        $sql .= "FROM __inscricao_convencao ic ";
        $sql .= "INNER JOIN __usuario u ON u.id = ic.usuario_id ";
        $sql .= "INNER JOIN jom1__users us ON us.id = u.user_id ";
        $sql .= "INNER JOIN jom1__user_usergroup_map ugm ON ugm.user_id = us.id ";
        $sql .= "WHERE ugm.group_id IN (2, 13) AND ic.convencao_id = ".Persistencia::prepare($convencaoId, Persistencia::FK) . " ";
        
        $sql .= ($estado) ? "AND u.estado = " . Persistencia::prepare($estado, Persistencia::STRING) . " " : "";
        $sql .= ($cidade) ? "AND u.cidade = " . Persistencia::prepare($cidade, Persistencia::STRING) . " ": "";
        $sql .= ($clube) ? "AND u.clube  = " . Persistencia::prepare($clube,  Persistencia::STRING) . " ": "";
        
        $sql .= "GROUP BY us.name ";
        $sql .= "ORDER BY ic.id ";
                
        $inscritos = array();

        if($db)
        {
            $db->setQuery($sql);
            $db->execute();
            $inscritos = $db->loadObjectList();
            foreach ($inscritos as $inscrito) {
                $inscrito->inscricoes = array();
            }
        }
        else
        {
            $query = mysql_query($sql);        
            
            if(mysql_num_rows($query)){
                while($inscrito = mysql_fetch_object($query)){
                    $inscrito->inscricoes = array();
                    $inscritos[] = $inscrito;
                }
            }        
        }

        $sql2 = "SELECT * FROM __inscricao_convencao WHERE convencao_id = " . Persistencia::prepare($convencaoId, Persistencia::FK) . " ORDER BY id;";

        $inscricoes = array();

        if($db)
        {
            $db->setQuery($sql2);
            $db->execute();
            $inscricoes = $db->loadObjectList();
        }
        else
        {
            $query2 = mysql_query($sql2);            
            
            if(mysql_num_rows($query2)){
                while($inscricao = mysql_fetch_object($query2)){
                    $inscricoes[] = $inscricao;
                }
            }
        }
        
        foreach($inscricoes as $inscricao){
            foreach ($inscritos as $inscrito){
                if($inscrito->id == $inscricao->usuario_id){
                    $inscrito->inscricoes[] = $inscricao;
                }
            }
        }
        //var_dump($inscritos);die();
        return $inscritos;
    }
    
    public static function fetInscritosSemana($convencaoId = 0, $geral = false){
        $sql  = "SELECT COUNT(us.id) AS quantidade ";
        $sql .= "FROM jom1__users us ";
        $sql .= "INNER JOIN __usuario u ON u.user_id = us.id ";
        $sql .= "INNER JOIN __inscricao_convencao ic ON ic.usuario_id = u.id ";
        $sql .= "INNER JOIN jom1__user_usergroup_map ugm ON ugm.user_id = us.id ";
        $sql .= "WHERE registerDate > (NOW() - INTERVAL 7 DAY) AND ugm.group_id IN (2, 13) ";
        $sql .= "AND ic.convencao_id = " . Persistencia::prepare($convencaoId, Persistencia::FK) . " ";
        if($geral ==  false){
            $sql .= (isset($_POST['estado']) && $_POST['estado']) ? "AND u.estado = " . Persistencia::prepare($_POST['estado'], Persistencia::STRING) . " " : "";
            $sql .= (isset($_POST['cidade']) && $_POST['cidade']) ? "AND u.cidade = " . Persistencia::prepare($_POST['cidade'], Persistencia::STRING) . " ": "";
            $sql .= (isset($_POST['clube'])  && $_POST['clube'] ) ? "AND u.clube  = " . Persistencia::prepare($_POST['clube'],  Persistencia::STRING) . " ": "";
        }
        $query = mysql_query($sql);
        return mysql_fetch_object($query)->quantidade;
    }
    
    public static function getTotalInscritos($convencaoId = 0){
        $sql  = "SELECT COUNT(distinct ic.usuario_id) AS total_inscritos, COUNT(*) AS total_incricoes ";
        $sql .= "FROM jom1__users us ";
        $sql .= "INNER JOIN __usuario u ON u.user_id = us.id ";
        $sql .= "INNER JOIN __inscricao_convencao ic ON ic.usuario_id = u.id ";
        $sql .= "INNER JOIN jom1__user_usergroup_map ugm ON ugm.user_id = us.id ";
        $sql .= "WHERE ic.convencao_id = " . Persistencia::prepare($convencaoId, Persistencia::FK) . " ";
        
        $query = mysql_query($sql);
        if(mysql_num_rows($query))
            return mysql_fetch_object($query);
        else
            return false;
    }

    private function load($inscricao_){
        $inscricao = new InscricaoConvencao();
        $inscricao->setId($inscricao_->id);
        $inscricao->setUsuario_id($inscricao_->usuario_id);
        $inscricao->setConvencao_id($inscricao_->convencao_id);
        $inscricao->setPago($inscricao_->pago);
        $inscricao->setComprovante($inscricao_->comprovante);
        return $inscricao;
    }
    
    public function __construct($connection = null) {
        $this->db = $connection;
    }
    

    public static function getSNinscricao($id) {
        $inscricao = $id - 2456;
        if(strlen($inscricao) == 1){
            return '00' . $inscricao;
        }else if(strlen($inscricao) == 2){
            return '0' . $inscricao;
        }
        return $inscricao;
    }


    public static function move(){

        $sql  = "SELECT *";
        $sql .= "FROM __inscricao_convencao ";
        //$sql .= "WHERE ic.convencao_id = " . Persistencia::prepare($convencaoId, Persistencia::FK) . " ";
        
        $query = mysql_query($sql);
        $inscricoes = mysql_fetch_object($query);

        var_dump($inscricoes);
    }

}
