<?php
//phpinfo();
require ('config.php');
require ('languages.php');

$ws = new Webservice();
$ws->init($config,$languages);

class Webservice {
    private $conn;
    private $config;
    private $languages;
    private $env;
    
    /**
     *
     *
     */
    function init($config, $languages) {
        $this->languages = $languages;
        $this->config = $config;
        $this->env = $config['env'];
        $action = '';
        if(isset($_GET['action']))$action = $_GET['action'];
        
        if($action == '0')$this->getVersion();
        if($action == '1')$this->getUsersCount();
        if($action == '2')$this->getUserByToken();//kell ez?
        if($action == '3')$this->createWord();
        if($action == '4')echo($this->getUserId());
        if($action == '5')$this->getWordsByName();
        if($action == '6')$this->getLanguages();
        if($action == '7')$this->getLanguageByName();
        if($action == '8')$this->updateWordById();
        if($action == '9')$this->getWordById();
        if($action == '10')$this->deleteWordById();
        if($action == '11')$this->getPairedWordsById();
        if($action == '12')$this->deletePairById();
        if($action == '13')$this->createPair();
        if($action == '14')$this->getTranslation();
        if($action == '15')$this->lockWord();
        if($action == '16')$this->loginUser();
        if($action == '17')$this->registerUser();
        if($action == '18')$this->getWordsCountByLanguageByUser();
        if($action == '19')$this->getAllWordsByLanguage();
        if($action == '20')$this->lockAllWords();
        if($action == '21')$this->dumpAll();
        if($action == '99')$this->test();
        if($action == '')echo 'Nothing to do';
    }
    /**
     *
     *
     */
    private function connect() {
        $this->conn = mysqli_connect(
            $this->config[$this->env]['database']['address'],
            $this->config[$this->env]['database']['user'],
            $this->config[$this->env]['database']['password'],
            $this->config[$this->env]['database']['name']
            );
        if(!$this->conn) die('Error');
        mysqli_set_charset($this->conn,"utf8");
    }
    /**
     *
     *
     */
    private function close() {
        mysqli_close($this->conn);
    }
    /**
     *  
     *
     */
    public function loginUser() {
        $this->connect();
        $email = '';
        $password = '';
        if(isset($_GET['email']))$email = $_GET['email'];
        if(isset($_GET['password']))$password = md5($_GET['password']);
        $sql = "SELECT name, token FROM dict_users WHERE email='$email' AND password='$password'";
        $result = mysqli_query($this->conn,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);//MYSQLI_ASSOC,MYSQLI_NUM,MYSQLI_BOTH
        if($row != NULL){
            echo json_encode($row);
        }else{
            echo $this->getError('Unable to login');
        }
        $this->close();
    }
    /**
     *
     *
     */
    public function getError($text){
        $message = array('error' => $text);
        return json_encode($message);
    }
    /**
     *
     *
     */
     public function registerUser() {
        $this->connect();
        if(isset($_GET['name']) AND isset($_GET['email']) AND isset($_GET['password'])) {
            //check does it exists already 
            //insert table
            $name = $_GET['name'];
            $email = $_GET['email'];
            $password = md5($_GET['password']);
            $token = md5($email.$password);
            $created_at = date('Y-m-d h:i:s');
            //email can not be as before
            $sql = "SELECT COUNT(*) AS count FROM dict_users WHERE email = '$email'";
            $result = mysqli_query($this->conn,$sql);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            if($row['count'] == 0 AND $name !='' AND $email !='' AND $password != '') {
                $sql = "INSERT INTO dict_users".
                 "(name,email,password,token,created_at) ".
                 "VALUES('$name','$email','$password','$token','$created_at')";
                $retval = mysqli_query($this->conn,$sql);
                $result = array('name'=>$name,'token'=>$token);
                echo json_encode($result);
            }else{
                echo $this->getError('User is already registered');
            }
        }else{
            echo $this->getError('Unable to register');
        }
    }
    /**
     *
     *
     */
    private function getUserByToken() {
        $token = '';
        if(isset($_GET['token'])){
            $token = $_GET['token'];
        }
        $this->connect();
        $sql = "SELECT * FROM dict_users WHERE token='$token'";
        $result = mysqli_query($this->conn,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);//MYSQLI_ASSOC,MYSQLI_NUM,MYSQLI_BOTH
        $this->close();
        if($row != null) {
            echo json_encode($row);
        }else{
            echo 'failed';
        }
    }
    /**
     *
     *
     */
    private function getUserId() {
        $token = '';
        if(isset($_GET['token'])){
            $token = $_GET['token'];
        }
        $this->connect();
        $sql = "SELECT * FROM dict_users WHERE token='$token'";
        $result = mysqli_query($this->conn,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);//MYSQLI_ASSOC,MYSQLI_NUM,MYSQLI_BOTH
        return $row['id'];
    }
    /**
     *
     *
     */
    public function getUsersCount() {
        $rows = array();
        $this->connect();
        $sql = "SELECT count(*) AS users FROM dict_users";
        $result = mysqli_query($this->conn,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $this->close();
        return $row['users'];
    }
    /**
     *
     *
     */
    public function createWord() {
        $user_id = $this->getUserId();
        
        if($user_id != null) {
            $word = $_GET['word'];
            $example = $_GET['example'];
            $example = str_replace($word,'%%',$example);
            $language_id = $_GET['language_id'];
            $created_at = date('Y-m-d h:i:s');
            
            $sql = "INSERT INTO dict_words(word,example,readonly,language_id,user_id,created_at) ".
             "VALUES('$word','$example',0,'$language_id','$user_id','$created_at')";
            $retval = mysqli_query($this->conn,$sql);
            if($retval)echo 'success';
        }
        $this->close();
    }
    /**
     * action=5
     *
     */
    public function getWordsByName() {
        $rows = array();
        $word = strtolower($_GET['word']);
        $this->connect();
        $sql = "SELECT * FROM dict_words WHERE LOWER(word) LIKE '$word%' LIMIT 10";
        $result = mysqli_query($this->conn,$sql);
        while($row = $result->fetch_assoc())
        {
            $row['example'] = str_replace('%%','<u>'.$row['word'].'</u>',$row['example']);
            $rows[] = $row;
        }
        echo json_encode($rows);
        $this->close();
    }
    /**
     *
     *
     */
    private function getLanguages() {
        $rows = array();
        $this->connect();
        $sql = "SELECT * FROM dict_languages";
        $result = mysqli_query($this->conn,$sql);
        while($row = $result->fetch_assoc())
        {
            $rows[] = $row;
        }
        echo json_encode($rows);
        $this->close();
    }
    /**
     *
     *
     */
    private function getLanguageByName() {
        $rows = array();
        $name = $_GET['name'];
        $this->connect();
        $sql = "SELECT * FROM dict_languages WHERE name LIKE '$name%'";
        $result = mysqli_query($this->conn,$sql);
        while($row = $result->fetch_assoc())
        {
            $row['name'] = utf8_encode($row['name']);
            $rows[] = $row;
        }
        echo json_encode($rows);
        $this->close();
    }
    /**
     * action=8
     *
     */
    private function updateWordById() {
        $user_id = $this->getUserId();
        
        if($user_id != null) {
            $id = $_GET['id'];
            $word = $_GET['word'];
            $example = $_GET['example'];
            $example = str_replace($word,'%%',$example);
            
            $created_at = date('Y-m-d h:i:s');
            
            $sql = "UPDATE dict_words SET ".
            "word='$word',example='$example',user_id='$user_id',created_at='$created_at' ".
            "WHERE id='$id' AND readonly=0";
            $retval = mysqli_query($this->conn,$sql);
            if($retval)echo 'success';
        }
        $this->close();
    }
    /**
     *
     *
     */
    private function getWordById() {
        $id = $_GET['id'];
        $this->connect();
        $sql = "SELECT * FROM dict_words WHERE id='$id'";
        $result = mysqli_query($this->conn,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);//MYSQLI_ASSOC,MYSQLI_NUM,MYSQLI_BOTH
        $row['example'] = str_replace('%%',$row['word'],$row['example']);
        echo json_encode($row);
        $this->close();
    }
    
    /**
     *
     *
     */
    private function deleteWordById() {
        $user_id = $this->getUserId();
        if($user_id != null) {
            $id = $_GET['id'];
            $this->connect();
            $sql = "DELETE FROM dict_words WHERE id='$id' AND readonly=0";
            $retval = mysqli_query($this->conn,$sql);
            if($retval)echo 'success';
        }
        $this->close();
    }
    /**
     *
     *
     */
    private function getPairedWordsById() {
        $user_id = $this->getUserId();
        $id = $_GET['id'];
        
        $rows = array();
        $rows['data'] = array();
        
        $sql = "SELECT p.id AS pair_id, w.id, w.language_id, w.word, w.example FROM dict_pairs p JOIN dict_words w ON w.id=p.word1_id WHERE word2_id='$id' ".
        "UNION SELECT p.id AS pair_id, w.id, w.language_id, w.word, w.example FROM dict_pairs p JOIN dict_words w ON w.id=p.word2_id WHERE word1_id='$id'";
        $result = mysqli_query($this->conn,$sql);
        while($row = $result->fetch_assoc())
        {
            $row['example'] = str_replace('%%','<u>'.$row['word'].'</u>',$row['example']);
            array_push($rows['data'], $row);
        }
        if(isset($user_id)){
            $rows['visited'] = $this->getVisitedWordByUser($id, $user_id);
        }
        
        echo json_encode($rows);
        $this->close();
    }
    /**
     *
     *
     */
    private function getVisitedWordByUser($word_id,$user_id) {
        $sql = "SELECT COUNT(*) AS count FROM dict_statistic WHERE user_id='$user_id' AND word_id='$word_id'";
        $result = mysqli_query($this->conn,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        if($row['count']==0){
            $sql = "INSERT INTO dict_statistic (user_id, word_id, slot1) VALUES ('$user_id', '$word_id', 0)";
            $result = mysqli_query($this->conn,$sql);
        }
        $sql = "UPDATE dict_statistic SET slot1 = slot1+1 WHERE user_id='$user_id' AND word_id='$word_id'";
        $result = mysqli_query($this->conn,$sql);
        $sql = "SELECT slot1 FROM dict_statistic WHERE user_id='$user_id' AND word_id='$word_id'";
        $result = mysqli_query($this->conn,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        return $row['slot1'];
    }
    /**
     *
     *
     */
    private function deletePairById() {
        $user_id = $this->getUserId();
        if($user_id != null) {
            $id = $_GET['id'];
            $sql = "DELETE FROM dict_pairs WHERE id='$id'";
            $retval = mysqli_query($this->conn,$sql);
            if($retval)echo 'success';
        }
        $this->close();
    }
    /**
     *
     *
     */
    private function createPair() {
        $user_id = $this->getUserId();
        if($user_id != null) {
            $word1_id = $_GET['word1_id'];
            $word2_id = $_GET['word2_id'];
            $created_at = date('Y-m-d h:i:s');
            //can not be same
            if($word1_id != $word2_id){
                $sql = "SELECT COUNT(*) AS count FROM `dict_pairs` WHERE `word1_id` = $word1_id AND `word2_id` = $word2_id".
                 " OR `word1_id` = $word2_id AND `word2_id` = $word1_id";
                $result = mysqli_query($this->conn,$sql);
                $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                 //cannot be as before
                if($row['count'] == 0) {
                    $sql = "INSERT INTO dict_pairs(word1_id,word2_id,user_id,created_at) ".
                     "VALUES('$word1_id','$word2_id','$user_id','$created_at')";
                    $retval = mysqli_query($this->conn,$sql);
                    if($retval)echo 'success';
                }
            }
        }
        $this->close();
    }
    /**
     *
     *
     */
    public function getTranslation(){
        $lang = 'en';
        if(isset($_GET['lang'])){//called by ajax :)
            $lang = $_GET['lang'];
        }else{
            if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
                $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
            }
        }
        $result = $this->languages[$lang];
        $result['users'] =  $this->getUsersCount();
        echo json_encode($result);
    }
    /**
     *
     *
     */
    public function lockWord(){
        $user_id = $this->getUserId();
        if($user_id != null) {
            $id = $_GET['id'];
            $sql = "UPDATE dict_words SET readonly=1,user_id='$user_id' WHERE id='$id'";
            $result = mysqli_query($this->conn,$sql);
            if($retval)echo 'success';
        }
        $this->close();
    }
    /**
     *
     *
     */
    public function getWordsCountByLanguageByUser(){
        $user_id = $this->getUserId();
        $rows = array();
        if($user_id != null) {
            //TODO
        }else{
            $sql = "SELECT language_id AS id, COUNT(id) AS words FROM dict_words WHERE 1 GROUP BY language_id";
            $result = mysqli_query($this->conn,$sql);
            while($row = $result->fetch_assoc())
            {
                $rows[] = $row;
            }
            echo json_encode($rows);
        }
        $this->close();
    }
    /**
     *
     *
     */
    public function getAllWordsByLanguage(){
        $this->connect();
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $sql = "SELECT word FROM dict_words WHERE language_id='$id' GROUP BY word ORDER BY word ASC";
            $result = mysqli_query($this->conn,$sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc())
                {
                    $rows[] = $row['word'];
                }
                echo json_encode($rows);
            }else{
                echo $this->getError('Empty result');
            }
        }else{
            echo $this->getError('Language id is missing');
        }
        $this->close();
    }
    /**
     *
     *
     */
    public function lockAllWords(){
        $this->connect();
        $sql = "UPDATE dict_words SET readonly = '1' WHERE 1";
        $result = mysqli_query($this->conn,$sql);
        $this->close();
        echo $this->getError('All words locked');
    }
    /**
     *
     *
     */
    public function dumpAll(){
        echo '<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><title>dump</title></head><body style="color:white;background-color:darkblue;font-family:Courier;font-weight:bold;">';
        if(isset($_GET['code']) AND $_GET['code']=='getdumpnow'){
            $this->connect();
            $this->dumpTable('dict_users');
            $this->dumpTable('dict_words');
            $this->dumpTable('dict_pairs');
            $this->dumpTable('dict_statistic');
            $this->close();
        }else{
            echo $this->getError('Code is missing or wrong');
        }
    }
    /**
     *
     *
     */
    public function dumpTable($table){
        echo "TRUNCATE $table;<br>";
        $sql = "SELECT * FROM $table WHERE 1";
        $result = mysqli_query($this->conn,$sql);
        while($row = $result->fetch_assoc())
        {
            echo "INSERT INTO $table (";
            $flag = true;
            foreach($row as $key=>$column){
                if($flag){
                    $flag = false;
                }else{
                    echo ",";
                }
                echo $key;
            }
            echo ") VALUES (";
            $flag = true;
            foreach($row as $key=>$column){
                if($flag){
                    $flag = false;
                }else{
                    echo ",";
                }
                echo "'".$column."'";
            }
            echo ");<br>";
        }
    }
    
     /**
     *
     *
     */
    public function getVisitedWordsStatByUser(){
        
    }
    /**
     *
     *
     */
    public function test(){
        $i = $_GET['n'];
        echo utf8_decode($i).'<br>';
        echo $i;
    }
     
}
?>