<?php

namespace app\models\services;

use app\models\Person;
use app\models\PersonImage;
use app\models\PlaceImage;
use Faker\Factory;
use yii\console\ExitCode;
use app\models\EventImage;
use Exception;
use app\models\Country;
use app\models\Climat;
use app\models\EventType;
use app\models\Place;
use app\models\Event;
use app\models\Ticket;
use app\models\StaticContent;
use app\models\PersonLink;
use app\models\SocialLink;

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
                $modelImage = new EventImage();
                $modelImage->event_id = $model->id;
                $modelImage->image = 'https://i.ytimg.com/vi/KebU58pmufg/maxresdefault.jpg';
                $modelImage->save();
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
                $model->role = $faker->jobTitle();
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

    public static function createStaticContentRows(int $numOfRows)
    {
        try {
            $faker = Factory::create();
            for ($i = 0; $i < $numOfRows; $i++) {
                $model = new StaticContent();
                $model->image = 'https://www.wheretowillie.com/wp-content/uploads/2012/08/Under-the-Stars.jpg';
                $model->title = $faker->text(23);
                $model->text = $faker->text(256);
                $model->save();
            }
            echo 'Статический контент был успешно добавлен' . "\n";
            return ExitCode::OK;
        } catch (Exception $e) {
            echo $e->getMessage();
            return ExitCode::UNSPECIFIED_ERROR;
        }
    }

    public static function createPersonLinkRows(int $numOfRows)
    {
        try {
            $faker = Factory::create();
            for ($i = 0; $i < $numOfRows; $i++) {
                $model = new PersonLink();
                $personModel = Person::find()->one();
                $model->person_id = $personModel->id;
                $model->icon = 'http://s1.iconbird.com/ico/0912/MetroUIDock/w512h5121347464753Network.png';
                $model->title = $faker->text(23);
                $model->url = $faker->url;
                $model->save();
            }
            echo 'Социальные сети личностей были успешно добавлены' . "\n";
            return ExitCode::OK;
        } catch (Exception $e) {
            echo $e->getMessage();
            return ExitCode::UNSPECIFIED_ERROR;
        }
    }

    public static function createSocialLinkRows(int $numOfRows)
    {
        try {
            $faker = Factory::create();
            for ($i = 0; $i < $numOfRows; $i++) {
                $model = new SocialLink();
                $model->icon = 'http://s1.iconbird.com/ico/0912/MetroUIDock/w512h5121347464753Network.png';
                $model->title = $faker->text(23);
                $model->url = $faker->url;
                $model->save();
            }
            echo 'Социальные сети были успешно добавлены' . "\n";
            return ExitCode::OK;
        } catch (Exception $e) {
            echo $e->getMessage();
            return ExitCode::UNSPECIFIED_ERROR;
        }
    }
}