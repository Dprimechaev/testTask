<?php

namespace frontend\models;

use yii\base\Model;
use common\models\db\Post;
use yii\db\ActiveQuery;

/**
 * Description of PostListForm
 *
 */
class PostListForm extends Model
{
    /** @var ActiveQuery $_posts */
    private $_posts;
    public $limit;
    public $offset;
    public $userId;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['limit', 'offset'], 'integer'],
            [['limit'], 'default', 'value' => 10],
            [['offset'], 'default', 'value' => 0],
            [['userId'], 'integer'],
        ];
    }

    /**
     * Выбрать посты.
     *
     * @return boolean
     */
    public function find()
    {
        $this->_posts = \common\models\Post::find()
            ->orderBy(['post.postId' => SORT_DESC]);
        if (!empty($this->userId)) {
            $this->_posts->andWhere(['userId' => $this->userId]);
        }

        $this->_posts
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
        foreach ($this->_posts->each() as $post) {
            $result[] = $post->serializeToArray();
        }

        return [
            'posts' => $result,
        ];
    }
}
