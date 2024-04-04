<?php
/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2021 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

use humhub\libs\Html;
use humhub\modules\user\models\User;
use humhub\modules\user\models\ProfileField;
use humhub\modules\user\widgets\Image;
use humhub\modules\user\widgets\PeopleActionButtons;
use humhub\modules\user\widgets\PeopleDetails;
use humhub\modules\user\widgets\PeopleTagList;
use yii\web\View;

/* @var $this View */
/* @var $user User */
?>

<div class="card-panel">
    <div
        class="card-bg-image"<?php if ($user->getProfileBannerImage()->hasImage()) : ?> style="background-image: url('<?= $user->getProfileBannerImage()->getUrl() ?>')"<?php endif; ?>></div>
    <div class="card-header">
        <?= Image::widget([
            'user' => $user,
            'htmlOptions' => ['class' => 'card-image-wrapper'],
            'linkOptions' => ['data-contentcontainer-id' => $user->contentcontainer_id, 'class' => 'card-image-link'],
            'width' => 94,
        ]); ?>
        <?php /*<div class="card-icons">
            <?= PeopleIcons::widget(['user' => $user]); ?>
        </div> */ ?>
    </div>
    <div class="card-body">
        <strong class="card-title"><?= Html::containerLink($user); ?></strong>
        <?php 
            $profile = $user->profile;
            $module = Yii::$app->getModule('gradido-humhub-module');
            if($profile->hasAttribute('gradido_address') && $profile->getAttribute('gradido_address')) :
                $gddAddress = $profile->getAttribute('gradido_address'); 
                $gradidoAddressProfileField = ProfileField::find()->where(['internal_name' => 'gradido_address'])->one();
                $config = json_decode($gradidoAddressProfileField->field_type_config);
                ?>
                <div><?= Html::a(Html::encode($gddAddress),  $config->linkPrefix . $gddAddress, ['target' => '_blank']); ?></div>
            <?php elseif (!empty($user->displayNameSub)): ?>
                <div><?= HTML::encode($user->displayNameSub); ?></div>
            <?php endif; ?>
        <?= PeopleDetails::widget([
            'user' => $user,
            'template' => '<div class="card-details">{lines}</div>',
            'separator' => '<br>',
        ]); ?>
        <?= PeopleTagList::widget([
            'user' => $user,
            'template' => '<div class="card-tags">{tags}</div>',
        ]); ?>
    </div>
    <?= PeopleActionButtons::widget([
        'user' => $user,
        'template' => '<div class="card-footer">{buttons}</div>',
    ]); ?>
</div>
