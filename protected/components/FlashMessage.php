<?php

class FlashMessage extends CComponent
{
	const TYPE_ERROR = TbHtml::ALERT_COLOR_DANGER;
	const TYPE_WARNING = TbHtml::ALERT_COLOR_WARNING;
	const TYPE_SUCCESS = TbHtml::ALERT_COLOR_SUCCESS;
	const TYPE_NOTICE = TbHtml::ALERT_COLOR_INFO;

	private static $typeData = array(
		self::TYPE_ERROR => array(
			'icon' => '<div class="glyphicon glyphicon-remove two-line"></div>',
		),
		self::TYPE_WARNING => array(
			'icon' => '<div class="glyphicon glyphicon-warning-sign two-line"></div>',
		),
		self::TYPE_SUCCESS => array(
			'icon' => '<div class="glyphicon glyphicon-ok two-line"></div>',
		),
		self::TYPE_NOTICE => array(
			'icon' => '<div class="glyphicon glyphicon-info-sign two-line"></div>',
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

	public static function setError($message, $title = 'Error', $options = array())
	{
		$message = new FlashMessage(self::TYPE_ERROR, $message, $title, $options);
		Yii::app()->user->setFlash($message->key, $message);
	}

	public static function setWarning($message, $title = 'Warning', $options = array())
	{
		$message = new FlashMessage(self::TYPE_WARNING, $message, $title, $options);
		Yii::app()->user->setFlash($message->key, $message);
	}

	public static function setSuccess($message, $title = 'Success', $options = array())
	{
		$message = new FlashMessage(self::TYPE_SUCCESS, $message, $title, $options);
		Yii::app()->user->setFlash($message->key, $message);
	}

	public static function setNotice($message, $title = 'Notice', $options = array())
	{
		$message = new FlashMessage(self::TYPE_NOTICE, $message, $title, $options);
		Yii::app()->user->setFlash($message->key, $message);
	}

	public function render()
	{
		$typeData = self::$typeData[$this->type];
		echo TbHtml::alert($this->type, $typeData['icon'] . '<div class="alert-content"><strong>'
				. CHtml::encode($this->title) . '</strong><br />' . $this->message . '</div>');
	}
}