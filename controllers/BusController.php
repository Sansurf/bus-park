<?php
/**
 * Created by PhpStorm.
 * User: alexandr
 * Date: 19.06.17
 * Time: 22:16
 */

namespace app\controllers;

use Yii;
use app\models\Driver;
use yii\web\Controller;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;


class BusController extends Controller
{
    public $layout = 'busPark';

    // главная страница (список водителей)
    public function actionIndex()
    {
        // достаем из таблицы Driver все записи
        $query = Driver::find()->orderBy(['first_name' => SORT_ASC, 'last_name' => SORT_ASC])->with('buses');

        // пагинация
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 4,
            'forcePageParam' => false, 'pageSizeParam' => false]);
        $drivers = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', compact('drivers', 'pages'));
    }

    // страница редактирования
    public function actionAdmin()
    {
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

        return $this->render('admin', compact('driver'));
    }

    // обработка нажатия на checkbox "Активен"
    public function actionActive()
    {
        $driver = Driver::findOne($_POST);

        if (Yii::$app->request->isAjax) {

            if ($driver['active'] == 1) {
                $driver['active'] = 0;
            } else {
                $driver['active'] = 1;
            }

            if ($driver->save()) return 'success';
        }
    }

    public function actionUpdate($id)
    {
        $driver = $this->findModel($id);

        if ($driver->load(Yii::$app->request->post()) && $driver->save()) {
            return $this->redirect(['index', 'id' => $driver->id]);
        } else {
            return $this->render('update', compact('driver'));
        }
    }

    public function actionDelete($id)
    {
        if ($this->findModel($id)->delete()) {
            return $this->redirect(['index']);
        }
    }

    protected function findModel($id)
    {
        if (($model = Driver::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}