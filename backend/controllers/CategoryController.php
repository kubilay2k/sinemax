<?php

namespace backend\controllers;

use yii\filters\AccessControl;
use common\models\Category;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\HttpException;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
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
     * Lists all Category models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->identity->email === Yii::$app->params['adminEmail']) {
            $dataProvider = new ActiveDataProvider([
                'query' => Category::find(),
                /*
                'pagination' => [
                    'pageSize' => 50
                ],
                'sort' => [
                    'defaultOrder' => [
                        'category_id' => SORT_DESC,
                    ]
                ],
                */
            ]);
    
            return $this->render('index', [
                'dataProvider' => $dataProvider,
            ]);
        }
        else
        {
            throw new HttpException(404,'Bu İşlemi Gerçekleştirmeye Yetkiniz Yok');
        }
        
    }

    /**
     * Displays a single Category model.
     * @param int $category_id Category ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($category_id)
    {
        if (Yii::$app->user->identity->email === Yii::$app->params['adminEmail']) {
            return $this->render('view', [
                'model' => $this->findModel($category_id),
            ]);
        }
        else{
            throw new HttpException(404,'Bu İşlemi Gerçekleştirmeye Yetkiniz Yok');
        }
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {        if (Yii::$app->user->identity->email === Yii::$app->params['adminEmail']) {

            $model = new Category();

            if ($this->request->isPost) {
                if ($model->load($this->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'category_id' => $model->category_id]);
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
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $category_id Category ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($category_id)
    {
        if (Yii::$app->user->identity->email === Yii::$app->params['adminEmail']) {
            $model = $this->findModel($category_id);

            if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'category_id' => $model->category_id]);
            }
    
            return $this->render('update', [
                'model' => $model,
            ]);

        }else{
            throw new HttpException(404,'Bu İşlemi Gerçekleştirmeye Yetkiniz Yok');
        }
        
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $category_id Category ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($category_id)
    {

        if (Yii::$app->user->identity->email === Yii::$app->params['adminEmail']) {
        $this->findModel($category_id)->delete();

        return $this->redirect(['index']);
        }else{
            throw new HttpException(404,'Bu İşlemi Gerçekleştirmeye Yetkiniz Yok');
        }
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $category_id Category ID
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($category_id)
    {

        if (($model = Category::findOne(['category_id' => $category_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
