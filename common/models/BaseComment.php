<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property int $commentId
 * @property string|null $text
 * @property int|null $postId
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Post $post
 */
class BaseComment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['postId', 'created_at', 'updated_at'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
            [['text'], 'string', 'max' => 255],
            [['postId'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['postId' => 'postId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'commentId' => 'Comment ID',
            'text' => 'Text',
            'postId' => 'Post ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Post]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['postId' => 'postId']);
    }
}
