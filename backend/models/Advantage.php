<?php

namespace app\models;

use yii\db\ActiveRecord;

class Advantage extends ActiveRecord
{
    public function rules(): array
    {
        return [
            [['title', 'text'],  'required'],
            [['title', 'text'], 'string']
        ];
    }
    
}