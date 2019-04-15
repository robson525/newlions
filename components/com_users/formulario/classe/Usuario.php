<?php 

require_once 'Persistencia.php';
/**
 * Description of Usuario
 *
 * @author Robson
 */
class Usuario {
    private $id;
    private $user_id;
    private $matricula;
    private $nascimento;
    private $endereco;
    private $complemento;
    private $estado;
    private $cidade;
    private $clube;
    private $delegado;
    private $cargo_clube;
    private $qual_cc;
    private $cargo_distrito;
    private $qual_cd;
    private $cl_mj;
    private $prefixo;
    private $camisa;
    private $error;
    
    public function getId() {
        return $this->id;
    }

    public function getUser_id() {
        return $this->user_id;
    }

    public function getMatricula() {
        return $this->matricula;
    }

    public function getNascimento() {
        return $this->nascimento;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function getComplemento() {
        return $this->complemento;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function getClube() {
        return $this->clube;
    }

    public function getDelegado() {
        return $this->delegado;
    }

    public function getCargo_clube() {
        return $this->cargo_clube;
    }

    public function getQual_cc() {
        return $this->qual_cc;
    }

    public function getCargo_distrito() {
        return $this->cargo_distrito;
    }

    public function getQual_cd() {
        return $this->qual_cd;
    }

    public function getCl_mj() {
        return $this->cl_mj;
    }

    public function getPrefixo() {
        return $this->prefixo;
    }

    public function getCamisa() {
        return $this->camisa;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setUser_id($user_id) {
        $this->user_id = $user_id;
    }

    public function setMatricula($matricula) {
        $this->matricula = $matricula;
    }

    public function setNascimento($nascimento) {
        $this->nascimento = $nascimento;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function setClube($clube) {
        $this->clube = $clube;
    }

    public function setDelegado($delegado) {
        $this->delegado = $delegado;
    }

    public function setCargo_clube($cargo_clube) {
        $this->cargo_clube = $cargo_clube;
    }

    public function setQual_cc($qual_cc) {
        $this->qual_cc = $qual_cc;
    }

    public function setCargo_distrito($cargo_distrito) {
        $this->cargo_distrito = $cargo_distrito;
    }

    public function setQual_cd($qual_cd) {
        $this->qual_cd = $qual_cd;
    }

    public function setCl_mj($cl_mj) {
        $this->cl_mj = $cl_mj;
    }

    public function setPrefixo($prefixo) {
        $this->prefixo = $prefixo;
    }

    public function setCamisa($camisa) {
        $this->camisa = $camisa;
    }
    
    public function setConnection($db){
        $this->db = $db;
    }
    
    
    public function getError(){
        return $this->error;
    }
    
    public function save(){
        if($this->getId()){
            return $this->update();
        }else{
            return $this->insert();
        }
    }
    
    private function insert(){
        $sql  = "INSERT INTO __usuario ";
        $sql .= "(user_id, matricula, nascimento, endereco ,complemento ,estado ,cidade ,clube ,delegado ,cargo_clube ,qual_cc ,cargo_distrito ,qual_cd ,cl_mj ,prefixo ,camisa ) ";
        $sql .= "VALUES ( ";
        $sql .= Persistencia::prepare($this->getUser_id(), Persistencia::FK) . ", ";
        $sql .= Persistencia::prepare($this->getMatricula(), Persistencia::STRING) . ", ";
        $sql .= Persistencia::prepare($this->getNascimento(), Persistencia::STRING) . ", ";
        $sql .= Persistencia::prepare($this->getEndereco(), Persistencia::STRING) . ", ";
        $sql .= Persistencia::prepare($this->getComplemento(), Persistencia::STRING) . ", ";
        $sql .= Persistencia::prepare($this->getEstado(), Persistencia::STRING) . ", ";
        $sql .= Persistencia::prepare($this->getCidade(), Persistencia::STRING) . ", ";
        $sql .= Persistencia::prepare($this->getClube(), Persistencia::STRING) . ", ";
        $sql .= Persistencia::prepare($this->getDelegado(), Persistencia::STRING) . ", ";
        $sql .= Persistencia::prepare($this->getCargo_clube(), Persistencia::STRING) . ", ";
        $sql .= Persistencia::prepare($this->getQual_cc(), Persistencia::STRING) . ", ";
        $sql .= Persistencia::prepare($this->getCargo_distrito(), Persistencia::STRING) . ", ";
        $sql .= Persistencia::prepare($this->getQual_cd(), Persistencia::STRING) . ", ";
        $sql .= Persistencia::prepare($this->getCl_mj(), Persistencia::STRING) . ", ";
        $sql .= Persistencia::prepare($this->getPrefixo(), Persistencia::STRING) . ", ";
        $sql .= Persistencia::prepare($this->getCamisa(), Persistencia::STRING) . " ) ";
        $sql .= ";";
        $this->db->setQuery($sql);
        $this->db->execute();
       
        if($this->db->getErrorNum()){
            $this->error = "Ocorreu um erro ao Cadastrar. Tente novamente mais tarde.";
            $this->deleteUser();
            return false;
        }
        $this->id = $this->db->insertid();
        return true;
        
    }
    
    private function update(){
        $sql  = "UPDATE __usuario SET ";
        $sql .= "user_id = " . Persistencia::prepare($this->getUser_id(), Persistencia::FK) . ", ";
        $sql .= "matricula = " . Persistencia::prepare($this->getMatricula(), Persistencia::STRING) . ", ";
        $sql .= "nascimento = " . Persistencia::prepare($this->getNascimento(), Persistencia::STRING) . ", ";
        $sql .= "endereco = " . Persistencia::prepare($this->getEndereco(), Persistencia::STRING) . ", ";
        $sql .= "complemento = " . Persistencia::prepare($this->getComplemento(), Persistencia::STRING) . ", ";
        $sql .= "estado = " . Persistencia::prepare($this->getEstado(), Persistencia::STRING) . ", ";
        $sql .= "cidade = " . Persistencia::prepare($this->getCidade(), Persistencia::STRING) . ", ";
        $sql .= "clube = " . Persistencia::prepare($this->getClube(), Persistencia::STRING) . ", ";
        $sql .= "delegado = " . Persistencia::prepare($this->getDelegado(), Persistencia::STRING) . ", ";
        $sql .= "cargo_clube = " . Persistencia::prepare($this->getCargo_clube(), Persistencia::STRING) . ", ";
        $sql .= "qual_cc = " . Persistencia::prepare($this->getQual_cc(), Persistencia::STRING) . ", ";
        $sql .= "cargo_distrito = " . Persistencia::prepare($this->getCargo_distrito(), Persistencia::STRING) . ", ";
        $sql .= "qual_cd = " . Persistencia::prepare($this->getQual_cd(), Persistencia::STRING) . ", ";
        $sql .= "cl_mj = " . Persistencia::prepare($this->getCl_mj(), Persistencia::STRING) . ", ";
        $sql .= "prefixo = " . Persistencia::prepare($this->getPrefixo(), Persistencia::STRING) . ", ";
        $sql .= "camisa = " . Persistencia::prepare($this->getCamisa(), Persistencia::STRING) . "  ";
        $sql .= "WHERE id = " . $this->getId();
        
        $this->db->setQuery($sql);
        $this->db->execute();
       
        if($this->db->getErrorNum()){
            $this->error = "Ocorreu um erro ao Atualizar. Tente novamente mais tarde.";
            return false;
        }
        
        return true;
        
    }
    
    private function deleteUser(){
        $sqlD   = "DELETE u, ug "
                . "FROM jom1_users AS u "
                . "INNER JOIN jom1_user_usergroup_map AS ug ON ug.user_id = u.id "
                . "WHERE u.id = " . $this->user_id . ";"; 
        $this->db->setQuery($sql);
        $this->db->execute();
    }
    
    
    public static function getById($usuario_id = 0, $db = null){
        if(!$usuario_id){
            $usuario_id = '0';
        }
        
        $sql = "SELECT * FROM __usuario WHERE id = " . Persistencia::prepare($usuario_id, Persistencia::INT);

       if($db){
            $db->setQuery($sql);
            $db->execute();
            $usuario_ = $db->loadObject();
        }else{
            $query = mysql_query($sql);
            $usuario_ = mysql_fetch_object($query);
        }
        
        if($usuario_){
            return (new Usuario())->load($usuario_);
        }else{
            return new Usuario();
        }
    }
    
    public static function getByUser($user_id = 0, $db = null){
        $usuario_ = false;
        $sql = "SELECT * FROM __usuario WHERE user_id = " . Persistencia::prepare($user_id, Persistencia::INT);
        
        if($db){
            $db->setQuery($sql);
            $db->execute();
            $usuario_ = $db->loadObject();
        }else{
            $query = mysql_query($sql);
            $usuario_ = mysql_fetch_object($query);
        }
        
        if($usuario_){
            $usuario = (new Usuario())->load($usuario_);
            $usuario->setConnection($db);
            return $usuario;
        }else{
            return new Usuario();
        }
    }
    
    private function load($usuario_){
        
        $usuario = new Usuario();
        $usuario->setId($usuario_->id);
        $usuario->setUser_id($usuario_->user_id);
        $usuario->setMatricula($usuario_->matricula);
        $usuario->setNascimento($usuario_->nascimento);
        $usuario->setEndereco($usuario_->endereco);
        $usuario->setComplemento($usuario_->complemento);
        $usuario->setEstado($usuario_->estado);
        $usuario->setCidade($usuario_->cidade);
        $usuario->setClube($usuario_->clube);
        $usuario->setDelegado($usuario_->delegado);
        $usuario->setCargo_clube($usuario_->cargo_clube);
        $usuario->setQual_cc($usuario_->qual_cc);
        $usuario->setCargo_distrito($usuario_->cargo_distrito);
        $usuario->setQual_cd($usuario_->qual_cd);
        $usuario->setCl_mj($usuario_->cl_mj);
        $usuario->setPrefixo($usuario_->prefixo);
        $usuario->setCamisa($usuario_->camisa);
        
        return $usuario;
    }
    
    public function getDataNascimento($delimitador = '-'){
        if(!$this->nascimento)
            return false;
        $data = explode('-', $this->nascimento);
        return $data[2] . $delimitador . $data[1] . $delimitador . $data[0];
    }
    
}
