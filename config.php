<?php

use humhub\modules\user\models\fieldtype\BaseType;

return [
	'id' => 'gradido-humhub-module',
	'class' => 'humhub\modules\gradidohumhubmodule\Module',
	'namespace' => 'humhub\modules\gradidohumhubmodule',
	'events' => [
		[BaseType::class, BaseType::EVENT_INIT, ['\humhub\modules\gradidohumhubmodule\Events', 'onFieldTypesInit']]
	]
];