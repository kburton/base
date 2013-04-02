<?php

return CMap::mergeArray(
	require(dirname(__FILE__) . '/main.php'),
	array(
		'components'=>array(
			'db'=>array(
				'class'=>'DbConnection', // Transactional history logging
				'connectionString'=>'mysql:host=localhost;dbname=base',
				'emulatePrepare'=>true,
				'username'=>'base',
				'password'=>PW_DB_TEST_BASE,
				'charset'=>'utf8',
			),
		),
	)
);
