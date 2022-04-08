<?php

namespace app\controllers;

use app\models\Event;
use yii\rest\ActiveController;
use yii\filters\Cors;
use app\models\Person;

class PersonController extends ActiveController
{
    public $modelClass = 'app\models\Person';

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => Cors::class
        ];

        return $behaviors;
    }

    public function actionFindPersons(string $requestedString){
        if($models = Person::find()->where(['like','firstname',$requestedString])->all()){
            return $models;
        }
        if($models = Person::find()->where(['like','lastname',$requestedString])->all()){
            return $models;
        }
        return [];
    }

    public function actionGetProfessions(){
        return Person::find()->select('role')->column();
    }

    public function actionGetPersonsByProfession(string $profession){
        if($models = Person::find()->where(['like','role',$profession])->all()){
            return $models;
        }
        return [];
    }

    public function actionGetPersonsByAge(int $age){
        if($models = Person::find()->where(['=','age',$age])->all()){
            return $models;
        }
        return [];
    }

    public function actionGetRandomPersons(){
        if(!$id = Person::find()->select('id')->orderBy(['id' => SORT_DESC])->limit(1)->scalar()){
            return [];
        }
        $result = [];
        $ids = range(1,$id);
        for($i = 0; $i<=2;$i++){
            $id = array_rand($ids);
            $key = array_search($id, $ids);
            if($model = Person::findOne($id)){
               $result[] = $model;
            }
        }
        return $result;
    }

    public function actionGetTopPersons(){
        if($models = Person::find()->limit(3)->all()){
            return $models;
        }
        return [];
    }

    public function actionGetPersonsByEvent(int $eventId){
        if($models = Event::findOne($eventId)->persons){
            return $models;
        }
        return [];
    }
}