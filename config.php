<?php

use humhub\modules\user\models\fieldtype\BaseType;
use humhub\modules\user\Module;
use humhub\modules\user\widgets\PeopleCard;

return [
	'id' => 'gradido-humhub-module',
	'class' => 'humhub\modules\gradidohumhubmodule\Module',
	'namespace' => 'humhub\modules\gradidohumhubmodule',
	'events' => [
		[BaseType::class, BaseType::EVENT_INIT, ['\humhub\modules\gradidohumhubmodule\Events', 'onFieldTypesInit']],
		[Module::class, Module::EVENT_BEFORE_ACTION, ['\humhub\modules\gradidohumhubmodule\Events', 'onUserModuleBeforeAction']],
		[PeopleCard::Class, PeopleCard::EVENT_AFTER_RUN, ['\humhub\modules\gradidohumhubmodule\Events', 'onAfterRunPeopleCard']]
	]
];