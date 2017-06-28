<?php
/**
 * Created by PhpStorm.
 * User: alexandr
 * Date: 19.06.17
 * Time: 22:16
 */

namespace app\controllers;

use Yii;
use app\models\Bus;
use app\models\Driver;
use yii\data\Pagination;
use yii\web\Controller;


class BusController extends Controller
{
    public $layout = 'busPark';

    public function actionIndex() {

        // достаем из таблицы Driver все записи
        $query = Driver::find()->orderBy(['first_name' => SORT_ASC, 'last_name' => SORT_ASC])->with('buses');

        // подсчет возраста водителя
        $age = function ($birthday) {
            $birthday_timestamp = strtotime($birthday);
            $age = date('Y') - date('Y', $birthday_timestamp);
            if (date('md', $birthday_timestamp) > date('md')) {
                $age--;
            }
            return $age;
        };

        // пагинация
//        $query = Driver::find()->where(['first_name' => true]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 4,
            'forcePageParam' => false, 'pageSizeParam' => false]);
        $drivers = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', compact('drivers', 'age', 'pages'));
    }

    public function actionAdmin() {

        $driver = new Driver();

        // проверка переданных данных
        if ($driver->load(Yii::$app->request->post())) {
            if ($driver->save()) {
                Yii::$app->session->setFlash('success', 'Данные записаны');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка записи!');
            }
        }

        // создание массива моделей автобусов
        $buses = Bus::find()->all();
        $busesArr = array();
        foreach ($buses as $oneBus) {
            $busesArr[] = $oneBus['model'];
        }

        return $this->render('admin', compact('driver', 'busesArr'));
    }
}