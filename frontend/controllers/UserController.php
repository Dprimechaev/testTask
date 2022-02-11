<?php

namespace frontend\controllers;

use common\models\User;
use common\models\Post;
use frontend\models\UserSigninForm;
use frontend\models\UserSignupForm;
use Yii;


class UserController extends BaseController
{
    //Отключаем Csrf защиту
    public $enableCsrfValidation = false;

    public function actionSignup()
    {
        $model = new UserSignupForm();

        if ($model->load(Yii::$app->request->post(), '') && $model->validate() && $model->create()) {
            return $model->serializeResponseToArray();
        } else {
            return $model->getErrors();
        }
    }

    public function actionSignin()
    {
        $model = new UserSigninForm();

        if ($model->load(Yii::$app->request->post(), '') && $model->validate() && $model->auth()) {
            return $model->serializeResponseToArray();
        } else {
            return $model->getErrors();
        }
    }



}
