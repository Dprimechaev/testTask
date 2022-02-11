<?php

namespace frontend\models;

use common\models\Comment;
use common\models\Post;
use common\models\User;
use yii\base\Model;
use yii\db\ActiveQuery;

/**
 * Description of PostListForm
 *
 */
class CommentCreateForm extends Model
{
    public $text;
    public $postId;
    /**
     * @var Comment
     */
    public $comment;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['text'], 'string'],
            [['postId'], 'integer'],
            ['postId', 'exist', 'targetClass' => Post::class]
        ];
    }
    /**
     * Выбрать посты.
     *
     * @return boolean
     */
    public function create()
    {
        $this->comment = new Comment();

        $this->comment->text = $this->text;
        $this->comment->postId = $this->postId;

        if (!$this->comment->save()) {
            $this->addErrors($this->comment->getErrors());
            return false;
        }
        return true;
    }

    public function serializeResponseToArray()
    {
        return [
            'comment' => $this->comment->serializeToArray(),
        ];
    }
}
