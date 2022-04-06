<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class StaticContent extends ActiveRecord
{
    public function rules():array{
        return [
            [['image','title','text'], 'required'],
            [['image', 'title', 'text'], 'string']
        ];
    }
}