<?php

namespace altiore\page\controllers;

use altiore\page\models\Page;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;

/**
 * PageController implements the CRUD actions for Page model.
 */
class ApiController extends Controller
{
    /**
     * @inheritdoc
     */
    public function verbs()
    {
        return [
        ];
    }

    /**
     * @param $url
     *
     * @return Page
     * @throws NotFoundHttpException
     */
    public function actionView($url)
    {
        return $this->findModel($url);
    }

    /**
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $url
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($url)
    {
        if (($model = Page::findOne(['url' => $url])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
