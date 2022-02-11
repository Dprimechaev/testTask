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

class CommentController extends BaseController
{
    public function actionCreateComment()
    {
        $model = new CommentCreateForm();

        if ($model->load(Yii::$app->request->post(), '') && $model->validate() && $model->create()) {
            return $model->serializeResponseToArray();
        } else {
            return $model->getErrors();
        }
    }

    public function actionGetCommentList()
    {
        $model = new CommentListForm();

        if ($model->load(Yii::$app->request->get(), '') && $model->validate() && $model->find()) {
            return $model->serializeResponseToArray();
        } else {
            return 'error';
        }
    }
}
