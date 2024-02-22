<?php

namespace humhub\modules\gradidohumhubmodule;

use humhub\modules\gradidohumhubmodule\user\models\fieldtypes\GradidoAddress;
use Yii;
use yii\helpers\Url;

class Events
{
    /**
     * Defines what to do when the top menu is initialized.
     *
     * @param $event
     */
    public static function onFieldTypesInit($event) {
        $event->sender->addFieldType(GradidoAddress::class, "Gradido Address");
    }
}
