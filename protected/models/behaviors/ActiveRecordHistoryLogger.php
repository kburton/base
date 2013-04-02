<?php
/**
 * Implement this behavior to automatically log inserts, updates
 * and deletes performed via Active Record.
 */
class ActiveRecordHistoryLogger extends CActiveRecordBehavior
{
	// Set attributes here that should only register changes but not log content.
	// Useful for large data such as binary file content.
	public $noContentLog = array();
	
	private $oldAttributes;
	
	private function getPrimaryKey()
	{
		$pk = $this->getOwner()->primaryKey;
		if (is_array($pk))
			$pk = implode(':', $pk);
		return $pk;
	}
	
	public function afterFind($event)
	{
		$this->oldAttributes = $this->getOwner()->getAttributes();
	}
	
	public function afterSave($event)
	{
		$transaction = $this->getOwner()->getDbConnection()->getCurrentTransaction();
		
		if ($this->oldAttributes === null)
		{
			$history = new History;
			$history->Type = 'INSERT';
			$history->TableName = $this->getOwner()->tableName();
			$history->PrimaryKey = $this->getPrimaryKey();
			$history->FieldName = null;
			$history->InitialValue = null;
			$history->NewValue = null;
			$history->UserId = isset(Yii::app()->user) ? Yii::app()->user->Id : 0;
			$history->IpAddress = Yii::app()->request->userHostAddress;
			
			if ($transaction && $transaction instanceof DbTransaction)
				$transaction->appendHistory($history);
			else
				$history->save(false);
		}
		else
		{
			foreach ($this->getOwner()->getAttributes() as $name => $value)
			{
				if (array_key_exists($name, $this->oldAttributes) && $this->oldAttributes[$name] != $value)
				{
					$history = new History;
					$history->Type = 'UPDATE';
					$history->TableName = $this->getOwner()->tableName();
					$history->PrimaryKey = $this->getPrimaryKey();
					$history->FieldName = $name;
					
					if (!in_array($name, $this->noContentLog))
					{
						$history->InitialValue = $this->oldAttributes[$name];
						$history->NewValue = $value;
					}
					
					$history->UserId = isset(Yii::app()->user) ? Yii::app()->user->Id : 0;
					$history->IpAddress = Yii::app()->request->userHostAddress;
					
					if ($transaction && $transaction instanceof DbTransaction)
						$transaction->appendHistory($history);
					else
						$history->save(false);
				}
			}
		}
		
		$this->oldAttributes = $this->getOwner()->getAttributes();
	}
	
	public function afterDelete($event)
	{
		$transaction = $this->getOwner()->getDbConnection()->getCurrentTransaction();
		
		$attributes = $this->oldAttributes !== null
					? $this->oldAttributes
					: $this->getOwner()->getAttributes();
		
		foreach ($attributes as $name => $value)
		{
			$history = new History;
			$history->Type = 'DELETE';
			$history->TableName = $this->getOwner()->tableName();
			$history->PrimaryKey = $this->getPrimaryKey();
			$history->FieldName = $name;
			
			if (!in_array($name, $this->noContentLog))
			{
				$history->InitialValue = $value;
				$history->NewValue = null;
			}
			
			$history->UserId = isset(Yii::app()->user) ? Yii::app()->user->Id : 0;
			$history->IpAddress = Yii::app()->request->userHostAddress;
			
			if ($transaction && $transaction instanceof DbTransaction)
				$transaction->appendHistory($history);
			else
				$history->save(false);
		}

		$this->oldAttributes = null;
	}
}
