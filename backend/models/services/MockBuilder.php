<?php

namespace app\models\services;

use app\models\Person;
use app\models\PersonImage;
use app\models\PlaceImage;
use Faker\Factory;
use yii\console\ExitCode;
use Exception;
use app\models\Country;
use app\models\Climat;
use app\models\EventType;
use app\models\Place;
use app\models\Event;
use app\models\Ticket;

class MockBuilder
{

    public static function createCountryRows(int $numOfRows): int
    {
        try {
            $faker = Factory::create();
            for ($i = 0; $i < $numOfRows; $i++) {
                $model = new Country();
                $model->code = $faker->countryCode();
                $model->name = $faker->country();
                $model->flag = 'https://33tura.ru/FLAG/aziya/butan.gif';
                $model->save();
            }
            echo 'Страны успешно добавлены!' . "\n";
            return ExitCode::OK;
        } catch (Exception $e) {
            echo $e->getMessage();
            return ExitCode::UNSPECIFIED_ERROR;
        }

    }

    public static function createClimatRows(int $numOfRows): int
    {
        try {
            $faker = Factory::create();
            for ($i = 0; $i < $numOfRows; $i++) {
                $model = new Climat();
                $model->code = $faker->text(5);
                $model->name = $faker->text(16);
                $model->icon = 'https://cdn-icons-png.flaticon.com/512/7199/7199506.png';
                $model->save();
            }
            echo 'Климат успешно добавлены!' . "\n";
            return ExitCode::OK;
        } catch (Exception $e) {
            echo $e->getMessage();
            return ExitCode::UNSPECIFIED_ERROR;
        }
    }

    public static function createEventTypeRows(int $numOfRows): int
    {
        try {
            $faker = Factory::create();
            for ($i = 0; $i < $numOfRows; $i++) {
                $model = new EventType();
                $model->name = $faker->text(16);
                $model->icon = 'https://cdn-icons-png.flaticon.com/512/195/195123.png';
                $model->save();
            }
            echo 'Типы событий успешно добавлены!' . "\n";
            return ExitCode::OK;
        } catch (Exception $e) {
            echo $e->getMessage();
            return ExitCode::UNSPECIFIED_ERROR;
        }
    }

    public static function createPlaceRows(int $numOfRows): int
    {
        try {
            $faker = Factory::create();
            for ($i = 0; $i < $numOfRows; $i++) {
                $model = new Place();
                $model->name = $faker->text(16);
                $model->address = $faker->address();
                $model->description = $faker->text(128);
                $climatModel = Climat::find()->one();
                $model->climat_code = $climatModel->code;
                $countryModel = Country::find()->one();
                $model->country_code = $countryModel->code;
                $model->save();
                $modelImage = new PlaceImage();
                $modelImage->image = 'https://migtour.ru/wp-content/uploads/2019/05/egypt-e1577520557743-1024x623.jpg';
                $modelImage->place_id = $model->id;
                $modelImage->save();
            }
            echo 'Места успешно добавлены!' . "\n";
            return ExitCode::OK;
        } catch (Exception $e) {
            echo $e->getMessage();
            return ExitCode::UNSPECIFIED_ERROR;
        }
    }

    public static function createEventRows(int $numOfRows): int
    {
        try {
            $faker = Factory::create();
            for ($i = 0; $i < $numOfRows; $i++) {
                $model = new Event();
                $model->name = $faker->text(12);
                $model->offer = $faker->text(64);
//                $model->from = $faker->dateTime();
//                $model->until = $faker->dateTime();
                $model->description = $faker->text(256);
                $model->age_restrictions = $faker->numberBetween(0, 21);
                $model->priority = $faker->numberBetween(0,9);
                $model->is_horizontal = true;
                $placeModel = Place::find()->one();
                $model->place_id = $placeModel->id;
                $typeModel = EventType::find()->one();
                $model->type_id = $typeModel->id;
                $model->save();
            }
            echo 'События успешно добавлены!' . "\n";
            return ExitCode::OK;
        } catch (Exception $e) {
            echo $e->getMessage();
            return ExitCode::UNSPECIFIED_ERROR;
        }
    }

    public static function createTicketRows(int $numOfRows): int
    {
        try {
            $faker = Factory::create();
            for ($i = 0; $i < $numOfRows; $i++) {
                $model = new Ticket();
                $eventModel = Event::find()->one();
                $model->event_id = $eventModel->id;
                $model->price = $faker->numberBetween(150,5000);
                $model->privilege = $faker->text(64);
                $model->description = $faker->text(256);
                $model->save();
            }
            echo 'Билеты успешно добавлены!' . "\n";
            return ExitCode::OK;
        } catch (Exception $e) {
            echo $e->getMessage();
            return ExitCode::UNSPECIFIED_ERROR;
        }
    }

    public static function createPersonRows(int $numOfRows): int
    {
        try{
            $faker = Factory::create();
            for($i = 0; $i< $numOfRows; $i++){
                $model = new Person();
                $model->firstname = $faker->firstName();
                $model->lastname = $faker->lastName();
                $model->patronymic = $faker->text(30);
                $model->age = $faker->numberBetween(10,20);
                $model->description = $faker->text(40);
                $model->profession = $faker->jobTitle();
                $model->save();
                $modelImage = new PersonImage();
                $modelImage->person_id = $model->id;
                $modelImage->image = 'https://i.discogs.com/DzARJvipaxvgJFwUM_MLiLjHwIHBxRXdX1Umhpb2HVs/rs:fit/g:sm/q:40/h:300/w:300/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9BLTEzMjA4/NC0xNTI5MDQ5OTM2/LTUwNzYuanBlZw.jpeg';
                $modelImage->save();
            }
            echo "Персоны успешно добавлены";
            return ExitCode::OK;
        }catch (Exception $e){
            echo $e->getMessage();
            return ExitCode::UNSPECIFIED_ERROR;
        }
    }
}