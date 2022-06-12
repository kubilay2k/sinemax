<?php

namespace backend\controllers;

use Yii;
use common\models\Movie;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use yii\web\HttpException;



/**
 * MovieController implements the CRUD actions for Movie model.
 */
class MovieController extends Controller
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
                            'actions' => ['login', 'error'],
                            'allow' => true,
                        ],
                        [
                            'actions' => ['logout', 'index','view','create','update','delete'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
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
     * Lists all Movie models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->identity->email === Yii::$app->params['adminEmail']) {
            $dataProvider = new ActiveDataProvider([
                'query' => Movie::find(),
                /*
                'pagination' => [
                    'pageSize' => 50
                ],
                'sort' => [
                    'defaultOrder' => [
                        'id' => SORT_DESC,
                    ]
                ],
                */
            ]);
    
            return $this->render('index', [
                'dataProvider' => $dataProvider,
            ]);
            }else{
                throw new HttpException(404,'Bu İşlemi Gerçekleştirmeye Yetkiniz Yok');
            }
    }


    

    /**
     * Displays a single Movie model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (Yii::$app->user->identity->email === Yii::$app->params['adminEmail']) {

                return $this->render('view', [
                'model' => $this->findModel($id),
            ]);

            }else{
                throw new HttpException(404,'Bu İşlemi Gerçekleştirmeye Yetkiniz Yok');
            }

    }

    /**
     * Creates a new Movie model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {        
        if (Yii::$app->user->identity->email === Yii::$app->params['adminEmail']) {
        $model = new Movie();

        $model->thumbnail = UploadedFile::getInstanceByName('thumbnail');

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->created_at = time();
                $model->created_by = Yii::$app->user->id;
                $model->updated_by = Yii::$app->user->id;
                $model->updated_at = time();
                $model->save();
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }    
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }else{
        throw new HttpException(404,'Bu İşlemi Gerçekleştirmeye Yetkiniz Yok');
    }

 
    }

    /**
     * Updates an existing Movie model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->identity->email === Yii::$app->params['adminEmail']) {
            $model = $this->findModel($id);

            $model->thumbnail = UploadedFile::getInstanceByName('thumbnail');
    
            if ($this->request->isPost && $model->load($this->request->post())) {
                $model->updated_by = Yii::$app->user->id;
                $model->updated_at = time();
                $model->save();
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
    
            }
    
            return $this->render('update', [
                'model' => $model,
            ]);
        }else{
            throw new HttpException(404,'Bu İşlemi Gerçekleştirmeye Yetkiniz Yok');
        }
    

    }

    /**
     * Deletes an existing Movie model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->identity->email === Yii::$app->params['adminEmail']) {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }else{
            throw new HttpException(404,'Bu İşlemi Gerçekleştirmeye Yetkiniz Yok');
        }
    

    }

    /**
     * Finds the Movie model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Movie the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Movie::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
