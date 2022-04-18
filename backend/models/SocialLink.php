<?php

namespace app\models;

use yii\db\ActiveRecord;

class SocialLink extends ActiveRecord
{
    public function rules(): array
    {
        return [
            [['title', 'icon', 'url'], 'required'],
            [['title', 'icon', 'url'], 'string'],
        ];
    }
}
