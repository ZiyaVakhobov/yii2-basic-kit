<?php


namespace app\src\admin\modules\user\validators;


use yii\validators\Validator;

class DuplicationValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        if (!is_array($model->$attribute['item']??null)) {
            $this->addError($model, $attribute, "{$attribute} should be array");
        }
        foreach(array_count_values($model->$attribute['item']??[]) as $val => $c){
            if($c > 1){
                $dups[] = $val;
            }
        }
        if (!empty($dups)) {
            $this->addError($model, $attribute, "{$attribute} has duplications. They should be unique");
        }
    }
}