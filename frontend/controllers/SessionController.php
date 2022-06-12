<?php

namespace frontend\controllers;

use Yii;
use common\models\Movie;
use common\models\Session;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\ActiveQuery;

/**
 * SessionController implements the CRUD actions for Session model.
 */
class SessionController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }


    /**
     * Displays a single Session model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $day = date('Y-m-d');
        $time = date('H:i');
        $fulltime = $day.'-'.$time;
        $sessions = Session::find()->where(['>','fulltime', $fulltime])->andWhere(['movie_id'=>$id])->orderBy('day')->groupBy('day')->all();
        $count = Session::find()->where(['movie_id'=>$id])->count();
        if ($count == 0) {
            throw new NotFoundHttpException('Bu Filme Ait Seans Bulunmamaktadır.');;
        }

        return $this->render('view', [
            'sessions'=>$sessions,
            'model' => $this->findModel($id),

        ]);
    }

        /**
     * Displays a single Session model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionSeat($id)
    {
        $sessions = Session::find()->andWhere(['movie_id'=>$id])->all();
    
        return $this->render('seat', [
            'sessions'=>$sessions,
            'model' => $this->findSession($id),

        ]);
    }

    /**
     * Finds the Session model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Session the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findSession($id)
    {
        if (($model = Session::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Finds the Session model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Session the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Session::findOne(['movie_id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
