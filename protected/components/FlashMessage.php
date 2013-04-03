<?php

class FlashMessage extends CComponent
{
	const TYPE_ERROR = 1;
	const TYPE_WARNING = 2;
	const TYPE_SUCCESS = 3;
	const TYPE_NOTICE = 4;

	private static $typeData = array(
		self::TYPE_ERROR => array(
			'class' => 'flash-error',
			'icon' => '<i class="icon-remove"></i>',
		),
		self::TYPE_WARNING => array(
			'class' => 'flash-warning',
			'icon' => '<i class="icon-exclamation-sign"></i>',
		),
		self::TYPE_SUCCESS => array(
			'class' => 'flash-success',
			'icon' => '<i class="icon-ok"></i>',
		),
		self::TYPE_NOTICE => array(
			'class' => 'flash-notice',
			'icon' => '<i class="icon-info-sign"></i>',
		),
	);

	private $key;
	private $type;
	private $title = '';
	private $message = '';
	private $icon;

	private function __construct($type, $message, $title, $options)
	{
		$this->type = $type;
		$this->message = $message;
		$this->title = $title;
		$this->key = array_key_exists('key', $options) ? $options['key'] : mt_rand();
	}
	
	private static function getMessage($message, $title)
	{
		return '<strong>' . $title . '</strong><br />' . $message; 
	}

	public static function setError($message, $title = 'Error', $options = array())
	{
		Yii::app()->user->setFlash('error', self::getMessage($message, $title));
	}

	public static function setWarning($message, $title = 'Warning', $options = array())
	{
		Yii::app()->user->setFlash('warning', self::getMessage($message, $title));
	}

	public static function setSuccess($message, $title = 'Success', $options = array())
	{
		Yii::app()->user->setFlash('success', self::getMessage($message, $title));
	}

	public static function setNotice($message, $title = 'Notice', $options = array())
	{
		Yii::app()->user->setFlash('info', self::getMessage($message, $title));
	}

	public function render()
	{
		$typeData = self::$typeData[$this->type];
		echo '<div class="flash-message ' . $typeData['class'] . '">';
		echo '<div class="close-button btn btn-danger"><i class="icon-remove icon-white"></i></div>';
		echo '<div class="message-container">';
		echo '<h3><span class="icon-container">' . $typeData['icon'] . '</span> '
				. CHtml::encode($this->title) . '</h3>';
		echo $this->message;
		echo '</div></div>';
	}
}