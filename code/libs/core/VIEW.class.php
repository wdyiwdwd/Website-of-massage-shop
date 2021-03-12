<?php
	class VIEW
	{
		//smarty对象
		private $_smarty;
		//用于存放实例化的对象
		static private $_instance = null;  
		//存放配置文件
		static private $_config = null;
		//公共静态方法初始化  
	    static public function init($config) {  
	    	self::$_config=$config;
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
	        if(!empty($config)){
	        	//echo "construct";
	        	$this->_smarty=ORG('smarty/','Smarty',$config);
	        }
	    } 

	    //assigh()
	    public function assign($data) {
	    	foreach ($data as $key => $value) {
	    		//var_dump($key);
	    		//var_dump($value);
	    		$this->_smarty->assign($key,$value);
	    	}
	    }   

	    //display()
	    public function display($template) {
	    	$this->_smarty->display($template);
	    }

	}

?>