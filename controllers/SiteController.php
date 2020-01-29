<?php

namespace app\controllers;

use yii\web\Controller;

class SiteController extends Controller {
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function beforeAction($action) {
        if ($action->id == 'error') {
            $this->layout = 'error.php';
        }

        return parent::beforeAction($action);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        return $this->render('index', [

        ]);
    }

}
