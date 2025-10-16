<?php 

namespace humhub\modules\gradidohumhubmodule\user\models\fieldtypes;

use humhub\modules\user\models\fieldtype\Text;
use humhub\modules\user\models\User;
use yii\helpers\Html;

/**
 * ProfileFieldTypeGradidoAddress handles gradido address profile field.
 */

class GradidoAddress extends Text 
{
    /**
     * Rules for validating the Field Type Settings Form
     *
     * @return array
     */
    public function rules()
    {
        $textFieldRules = parent::rules();
        foreach ($textFieldRules as &$rule) {
            if ($rule[0] === ['linkPrefix']) {
                // Update the 'max' value to 100
                $rule['max'] = 100;
            }
        }
        return $textFieldRules;
    }   

    public function getUserValue(User $user, $raw = true, bool $encode = true): string
    {
        $internalName = $this->profileField->internal_name;
        $value = $user->profile->$internalName ?? '';
        $rawValue = $raw ? 'true' : 'false';
        $encodeValue = $encode ? 'true' : 'false';

        // if $encode is false, caller will call HTML::encode() on the result later and so disable HTML
        if ((!$raw && (in_array($this->validator, [self::VALIDATOR_EMAIL, self::VALIDATOR_URL]) || !empty($this->linkPrefix))) && $encode) {
            $linkPrefix = ($this->validator === self::VALIDATOR_EMAIL) ? 'mailto:' : $this->linkPrefix;
            return Html::a(Html::encode($value), $linkPrefix . $value, ['target' => 'about:_blank']);
        }

        return $encode ? Html::encode($value) : $value;
    }
};