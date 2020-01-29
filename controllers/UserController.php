<?php
namespace app\controllers;

// exit;
use app\components\Helpers;
// use app\models\P2p;
use app\models\search\UserSearch;
use app\models\User;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller {
    /**
     * {@inheritdoc}
     */

    // public function behaviors() {
    //     return [
    //         'access' => [
    //             'class' => \yii\filters\AccessControl::className(),
    //             'only' => ['create', 'update', 'index'],
    //             'rules' => [
    //                 // allow authenticated users
    //                 [
    //                     'allow' => true,
    //                     'roles' => ['@'],
    //                 ],
    //                 // everything else is denied
    //             ],
    //         ],
    //     ];
    // }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex() {
        // exit('exit');
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setSort(['defaultOrder' => ['username' => SORT_ASC]]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new User();
        $model->scenario = 'create_user';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // return $this->redirect(['view', 'id' => $model->user_id]);
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'p2p' => P2p::find()->select('p2p_id, p2p_name')->orderBy(['p2p_name' => SORT_ASC])->all(),
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // return $this->redirect(['view', 'id' => $model->user_id]);
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'p2p' => P2p::find()->select('p2p_id, p2p_name')->orderBy(['p2p_name' => SORT_ASC])->all(),
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionSwitchStat($id) {
        $model = $this->findModel($id);
        $act = false;

        if ($model->is_active == 1) {
            $is_active = 0;
        } else {
            $is_active = 1;
        }

        $act = Helpers::tableUpdater($model,
            ['is_active' => $is_active],
            "user_id = '$model->user_id'",
            NULL,
            'db'
        );

        if ($act) {
            if (Yii::$app->user->identity->user_id == $id) {
                return $this->redirect(['/site/logout']);
            }
            Yii::$app->session->setFlash('msg', ["success", "User $model->username updated successfully!"]);
        } else {
            Yii::$app->session->setFlash('msg', ["danger", "Failed to update User $model->username!"]);
        }

        return $this->redirect(['index']);
    }

    public function actionUnblock($id) {
        $model = $this->findModel($id);
        $act = false;

        // if ($model->is_active == 1) {
        //     $is_active = 0;
        // } else {
        //     $is_active = 1;
        // }

        $act = Helpers::tableUpdater($model,
            ['login_attempt' => 0],
            "user_id = '$model->user_id'",
            NULL,
            'db'
        );

        if ($act) {
            if (Yii::$app->user->identity->user_id == $id) {
                return $this->redirect(['/site/logout']);
            }
            Yii::$app->session->setFlash('msg', ["success", "User $model->username updated successfully!"]);
        } else {
            Yii::$app->session->setFlash('msg', ["danger", "Failed to update User $model->username!"]);
        }

        return $this->redirect(['index']);
    }

    public function actionUpdateAccount() {
        $model = Yii::$app->user->identity;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // Yii::$app->session->setFlash('success', 'Updated Account successfully!');
            return $this->redirect(['update-account']);
        }

        return $this->render('update-account', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
