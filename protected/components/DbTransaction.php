<?php

class DbTransaction extends CDbTransaction {
	
	private $outstandingHistory = array();
	
	public function appendHistory($history)
	{
		$this->outstandingHistory[] = $history;
	}
	
	public function commit()
	{
		parent::commit();
		
		foreach ($this->outstandingHistory as $history)
			$history->save();
		
		$this->outstandingHistory = array();
	}
}
