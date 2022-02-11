<?php

namespace frontend\controllers;

use common\models\Comment;
use common\models\User;
use common\models\Post;
use frontend\models\CommentCreateForm;
use frontend\models\CommentListForm;
use frontend\models\PostCreateForm;
use frontend\models\PostListForm;
use Yii;

class BaseController extends \yii\web\Controller
{
    //Отключаем Csrf защиту
    public $enableCsrfValidation = false;

    public function beforeAction($action)
    {

        if (!parent::beforeAction($action)) {
            return false;
        }

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return true; // or false to not run the action
    }
}
