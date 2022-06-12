<?php

namespace frontend\controllers;

use Yii;
use common\models\Session;
use common\models\Ticket;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\MethodNotAllowedHttpException;
use yii\filters\AccessControl;

/**
 * TicketController implements the CRUD actions for Ticket model.
 */
class TicketController extends Controller
{

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'actions' => ['login', 'error','create','purcashed'],
                            'allow' => true,
                        ],
                        [
                            'actions' => ['logout', 'index'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        //'purcashed'=>['POST'],
                        'delete' => ['POST'],
                        'create' => ['POST']
                    ],
                ],
            ],

        );
    }


    /**
     * Displays a single Ticket model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewss($id)
    {
        $sessions = Session::find()->andWhere(['movie_id'=>$id])->all();
        
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
    public function actionCreate($id,$seat)
    {   
        $ticket = new Ticket();
        $ticket->session_id = $id;
        $ticket->user_id = Yii::$app->user->id;
        $ticket->seat_no = $seat;
        $ticket->created_at = time();
        $ticket->rezno = '#'.Yii::$app->security->generateRandomString(8);
        $ticket->save();
        
            if ($ticket->save()) {
                return $this->redirect(['purcashed','id'=>$ticket->id]); 

//'04.06.2022 alınan koltuk deaktif edilecek ve alınması engellenecek, bilet alındıktan sonraki sayfa eklenecek ve kullanıcı hesabım sayfası yapılacak';
                //return $this->redirect(['view', 'id' => $ticket->id]);
            }
         else {
            return 'başarısız';
        }
    }

    /**
     * Displays a single Ticket model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionPurcashed($id)
    {
        $tUser = Ticket::findOne(['user_id'=>Yii::$app->user->id]);
        if (Yii::$app->user->id != $tUser->user_id) {
           throw new MethodNotAllowedHttpException('Bu İşlemin Sahibi Siz Olmadığınız İçin Görüntülüyemezsiniz.');
        }
        elseif (Yii::$app->user->id == $tUser->user_id) {
            return $this->render('purcashed', [
                'model'=> $this->findModel($id),
    
            ]);
        }
    }

        /**
     * Displays a single Ticket model.
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
        if (($model = Ticket::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
