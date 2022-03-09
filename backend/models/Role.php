<?php

use yii\db\ActiveRecord;

class Role extends ActiveRecord
{
    public function rules()
    {
        return [
            [['name'],'required'],
            [['name'], 'unique'],
        ];
    }

    public function getUsers()
    {

    }

}