<?php namespace app\controllers;

use Yii;
use app\models\Books;
use app\models\BookSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * BooksController implements the CRUD actions for Books model.
 */
class BooksController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Books models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new BookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 5;

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Books model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        if (Yii::$app->request->isAjax) {
            return $this->renderPartial('view', [
                        'model' => $this->findModel($id),
            ]);
        }
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    private function loadPreview($model) {
        $model->preview = UploadedFile::getInstance($model, 'preview');
        if ($model->preview && $model->validate()) {
            $name = 'uploads/' . $model->preview->baseName . '.' . $model->preview->extension;
            if ($model->preview->saveAs($name)) {
                $model->preview = $name;
                return true;
            }
        }
        return false;
    }

    private function updatePreview($model) {
        $model->preview = UploadedFile::getInstance($model, 'preview');
        if ($model->preview) {
            $name = 'uploads/' . $model->preview->baseName . '.' . $model->preview->extension;
            $model->preview->saveAs($name);
            $model->preview = $name;
        } else {
            $model->preview = null;
        }
        return true;
    }

    /**
     * Creates a new Books model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Books();
        $model->scenario = 'create';

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            if ($this->loadPreview($model) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Books model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            if ($this->updatePreview($model) && $model->save()) {
                if ($flashed = Yii::$app->session->getFlash('updated_from')) {
                    return $this->redirect($flashed);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        if ($flashed = Yii::$app->session->getFlash('updated_from')) {
            Yii::$app->session->setFlash('updated_from', $flashed);
        } else {
            Yii::$app->session->setFlash('updated_from', Yii::$app->request->referrer);
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Books model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Books model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Books the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Books::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
