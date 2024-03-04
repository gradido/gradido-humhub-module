<?php 

namespace humhub\modules\gradidohumhubmodule\user\models\fieldtypes;

use humhub\modules\user\models\fieldtype\Text;
use Yii;

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
};