<?php

namespace frontend\controllers;

use common\models\User;
use common\models\Post;
use frontend\models\PostCreateForm;
use frontend\models\PostListForm;
use Yii;

class PostController extends BaseController
{
    public function actionAllPostList()
    {
        $model = new PostListForm();
        if ($model->load(Yii::$app->request->get(), '') && $model->validate() && $model->find()) {
            return $model->serializeResponseToArray();
        } else {
            return 'error';
        }
    }

    public function actionMyPostList()
    {
        $accessToken = \Yii::$app->request->get('accessToken');

        $user = User::findIdentityByAccessToken($accessToken);
        if (empty($user)) {
            return 'error';
        }
        $model = new PostListForm();
        $model->userId = $user->userId;
        if ($model->load(Yii::$app->request->get(), '') && $model->validate() && $model->find()) {
            return $model->serializeResponseToArray();
        } else {
            return 'error';
        }
    }

    public function actionCreatePost()
    {
        $accessToken = \Yii::$app->request->post('accessToken');

        $user = User::findIdentityByAccessToken($accessToken);

        if (empty($user)) {
            return 'error';
        }

        $model = new PostCreateForm();
        $model->userId = $user->userId;

        if ($model->load(Yii::$app->request->post(), '') && $model->validate() && $model->create()) {
            return $model->serializeResponseToArray();
        } else {
            return $model->getErrors();
        }
    }
}
