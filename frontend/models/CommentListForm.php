<?php

namespace frontend\models;

use common\models\Post;
use yii\base\Model;
use yii\db\ActiveQuery;

/**
 * Description of PostListForm
 *
 */
class CommentListForm extends Model
{
    /** @var $comment ActiveQuery $query */
    private $comments;
    public $postId;
    public $limit;
    public $offset;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['limit', 'offset'], 'integer'],
            [['limit'], 'default', 'value' => 10],
            [['offset'], 'default', 'value' => 0],
            ['postId', 'integer'],
            ['postId', 'exist', 'targetClass' => Post::class],
        ];
    }

    /**
     * Выбрать посты.
     *
     * @return boolean
     */
    public function find()
    {
        $this->comments = \common\models\Comment::find()
            ->orderBy(['comment.postId' => SORT_DESC]);
        if (!empty($this->postId)) {
            $this->comments->andWhere(['postId' => $this->postId]);
        }

        $this->comments
            ->limit($this->limit)
            ->offset($this->offset);

        return true;

    }
    /** Сериализация данных для ответа.
     * @return array
     */
    public function serializeResponseToArray()
    {
        $result = [];
        foreach ($this->comments->each() as $comment) {
            $result[] = $comment->serializeToArray();
        }

        return [
            'comments' => $result,
        ];
    }
}
