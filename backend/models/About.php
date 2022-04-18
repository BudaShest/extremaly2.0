<?php

namespace app\models;

use yii\db\ActiveRecord;

class About extends ActiveRecord
{
    public function rules()
    {
        return [
            [['text', 'small_text', 'image'], 'required'],
            [['text', 'small_text', 'image'], 'string'],
        ];
    }
}
