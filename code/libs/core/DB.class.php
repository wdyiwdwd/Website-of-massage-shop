<?php  
//数据库连接类，不建议直接使用DB，而是对DB封装一层  
//这个类不会被污染，不会被直接调用  
class DB {  
    //pdo对象  
    private $_pdo = null;  
    //用于存放实例化的对象  
    static private $_instance = null;  
    //存放配置数组
    static private $_config = null;  
    //公共静态方法初始化 
    static public function init($config) {  
        self::$_config = $config;
        if (!(self::$_instance instanceof self)) {  
            self::$_instance = new self(self::$_config);  
        }  
    }  
    //公共静态方法获取实例化的对象 
    static public function getInstance(){
        if (!(self::$_instance instanceof self)) {  
            self::init(self::$_config);  
        }
        return self::$_instance;  
    }
    //私有克隆  
    private function __clone() {}  
      
    //私有构造  
    private function __construct($config) {  
        //echo "construct";
        if(!empty($config)){
            $DB_DNS='mysql:host='.$config['dbhost'].'; dbname='.$config['dbname'];
            try {  
                $this->_pdo = new PDO($DB_DNS, $config['dbuser'], $config['dbpassword'], array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES '.$config['dbcharset']));  
                $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            } catch (PDOException $e) { 
                //echo "create error"; 
                exit($e->getMessage());  
            }
        }
    }  
      
    //新增  
    public function add($_tables, Array $_addData) {  
        $_addFields = array();  
        $_addValues = array();
        if(!is_array($_tables)){
            $_tables=array($_tables);
        }  
        foreach ($_addData as $_key=>$_value) {  
            $_addFields[] = $_key;  
            $_addValues[] = $_value;  
        }  
        $_addFields = implode(',', $_addFields);  
        $_addValues = implode("','", $_addValues);  
        $_sql = "INSERT INTO $_tables[0] ($_addFields) VALUES ('$_addValues')";  
        return $this->execute($_sql)->rowCount();  
    }  
      
    //修改  
    public function update($_tables, Array $_param, Array $_updateData) {  
        if(!is_array($_tables)){
            $_tables=array($_tables);
        }  
        $_where = $_setData = '';  
        foreach ($_param as $_key=>$_value) {  
            $_where .= $_value.' AND ';  
        }  
        $_where = 'WHERE '.substr($_where, 0, -4);  
        foreach ($_updateData as $_key=>$_value) {  
            if (is_array($_value)) {  
                $_setData .= "$_key=$_value[0],";  
            } else {  
                $_setData .= "$_key='$_value',";  
            }  
        }  
        $_setData = substr($_setData, 0, -1);  
        $_sql = "UPDATE $_tables[0] SET $_setData $_where";  
        return $this->execute($_sql)->rowCount();  
    }  
      
    //验证一条数据  
    public function isOne($_tables, Array $_param) {  
        if(!is_array($_tables)){
            $_tables=array($_tables);
        }  
        $_where = '';  
        foreach ($_param as $_key=>$_value) {  
            $_where .=$_value.' AND ';  
        }  
        $_where = 'WHERE '.substr($_where, 0, -4);  
        $_sql = "SELECT id FROM $_tables[0] $_where LIMIT 1";  
        return $this->execute($_sql)->rowCount();  
    }  
      
    //删除  
    public function delete($_tables, Array $_param) {  
        if(!is_array($_tables)){
            $_tables=array($_tables);
        }  
        $_where = '';  
        foreach ($_param as $_key=>$_value) {  
            $_where .= $_value.' AND ';  
        }  
        $_where = 'WHERE '.substr($_where, 0, -4);  
        $_sql = "DELETE FROM $_tables[0] $_where LIMIT 1";  
        return $this->execute($_sql)->rowCount();  
    }  
      
    //查询  
    public function select($_tables, Array $_fileld, Array $_param = array()) {  
        if(!is_array($_tables)){
            $_tables=array($_tables);
        }  
        $_limit = $_order = $_where = $_like = '';  
        if (is_array($_param)) {  
            $_limit = isset($_param['limit']) ? 'LIMIT '.$_param['limit'] : '';  
            $_order = isset($_param['order']) ? 'ORDER BY '.$_param['order'] : '';  
            if (isset($_param['where'])) {  
                foreach ($_param['where'] as $_key=>$_value) {  
                    $_where .= $_value.' AND ';  
                }  
                $_where = 'WHERE '.substr($_where, 0, -4); 
            }  
            if (isset($_param['like'])) {  
                foreach ($_param['like'] as $_key=>$_value) {  
                    $_like = "WHERE $_key LIKE '%$_value%'";  
                }  
            }  
        }  
        $_selectFields = implode(',', $_fileld);  
        $_table = isset($_tables[1]) ? $_tables[0].','.$_tables[1] : $_tables[0];  
        $_sql = "SELECT $_selectFields FROM $_table $_where $_like $_order $_limit"; 
        $_stmt = $this->execute($_sql);  
        $_result = array();  
        while (!!$_objs = $_stmt->fetch(PDO::FETCH_ASSOC)) {  
            $_result[] = $_objs;  
        }  
        return $_result;  
    }  
      
    //总记录  
    public function total($_tables, Array $_param = array()) {  
        if(!is_array($_tables)){
            $_tables=array($_tables);
        }  
        $_where = '';  
        if (isset($_param['where'])) {  
            foreach ($_param['where'] as $_key=>$_value) {  
                $_where .= $_value.' AND ';  
            }  
            $_where = 'WHERE '.substr($_where, 0, -4);  
        }  
        $_sql = "SELECT COUNT(*) as count FROM $_tables[0] $_where";  
        $_stmt = $this->execute($_sql);  
        return $_stmt->fetchObject()->count;  
    }  
      
    //得到下一个ID  
    public function nextId($_tables) {  
        if(!is_array($_tables)){
            $_tables=array($_tables);
        }  
        $_sql = "SHOW TABLE STATUS LIKE '$_tables[0]'";  
        $_stmt = $this->execute($_sql);  
        return $_stmt->fetchObject()->Auto_increment;  
    }

    //执行多条语句 如果无法执行就不会有任何操作
    public function runAsTransaction($sqlArray) {
        try{
            $this->_pdo->beginTransaction();
            foreach ($sqlArray as $sql) {
                $this->_pdo->exec($sql);
            }
            $this->_pdo->commit();
        } catch(Exception $e) {
            $this->_pdo->rollback();
            throw $e;
        }
        return true;
    }
      
    //执行SQL  
    private function execute($_sql) {  
        try {  
            $_stmt = $this->_pdo->prepare($_sql);  
            $_stmt->execute();  
        } catch (PDOException  $e) {  
            exit('SQL语句：'.$_sql.'<br />错误信息：'.$e->getMessage());  
        }  
        return $_stmt;  
    }  
}  
?>