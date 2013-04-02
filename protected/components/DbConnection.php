<?php

class DbConnection extends CDbConnection {
	
	private $_transaction; // Override parent
	
	public function beginTransaction() 
	{ 
		Yii::trace('Starting transaction', 'DbConnection'); 
		$this->setActive(true); 
		$this->getPdoInstance()->beginTransaction(); 
		return $this->_transaction=new DbTransaction($this); 
	}
}
