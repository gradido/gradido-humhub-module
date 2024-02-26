<?php

namespace humhub\modules\gradidohumhubmodule;

use humhub\modules\gradidohumhubmodule\user\models\fieldtypes\GradidoAddress;
use humhub\modules\user\models\User;
use humhub\modules\user\widgets\PeopleCard;
use Yii;
use Yii\helpers\Html;

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

    public static function replaceDisplayNameSubWithGradidoAddressLink(User $user) {
        /** @var Module $module */
        $module = Yii::$app->getModule('gradido-humhub-module');

        $profile = $user->profile;
        if($profile->hasAttribute('gradido_address') && $profile->getAttribute('gradido_address')) {
            $gddAddress = $profile->getAttribute('gradido_address');
            return Html::a(Html::encode($gddAddress),  $module->gradidoAddressPrefix . $gddAddress, ['target' => '_blank']);
        }
        $attributeName = Yii::$app->settings->get('displayNameSubFormat');
        
        if ($profile !== null && $profile->hasAttribute($attributeName)) {
            return $profile->getAttribute($attributeName) ?? '';
        }
 
        return '';
    }

    public static function onUserModuleBeforeAction($event) {
        $event->sender->displayNameSubCallback = 'humhub\modules\gradidohumhubmodule\Events::replaceDisplayNameSubWithGradidoAddressLink';
    }

    public static function onAfterRunPeopleCard($event) {
        /** @var PeopleCard $peopleCardWidget */
        $peopleCardWidget = $event->sender;
        $gradidoAddress = $peopleCardWidget->user->displayNameSub;
        // $event->result = str_replace($gradidoAddress, '<a href="">' . $gradidoAddress . '</a>', $event->result);
        //Yii::error(array_keys(get_object_vars($event)));
        //Yii::error(['result' => $event->result]);
    }
}
