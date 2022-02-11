<?php

namespace frontend\models;

use common\models\Post;
use common\models\User;
use yii\base\Model;
use yii\db\ActiveQuery;

/**
 * Description of PostListForm
 *
 */
class PostCreateForm extends Model
{
    /** @var $_posts ActiveQuery $query */
    public $text;
    public $userId;
    /**
     * @var Post
     */
    public $post;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['userId'], 'integer'],
        ];
    }

    /**
     * Выбрать посты.
     *
     * @return boolean
     */
    public function create()
    {
        $this->post = new Post();

        $this->post->text = $this->text;
        $this->post->userId = $this->userId;

        if (!$this->post->save()) {
            $this->addErrors($this->post->getErrors());
            return false;
        }
        return true;
    }

    public function serializeResponseToArray()
    {
        return [
            'post' => $this->post->serializeToArray(),
        ];
    }
}
