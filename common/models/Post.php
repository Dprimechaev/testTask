<?php

namespace common\models;


use yii\base\Model;
use Yii;
use yii\db\ActiveRecord;

class Post extends BasePost
{
    public function attributeLabels()
    {
        return [
            'postId' => 'ID',
            'text' => 'Текст',
            'userId' => 'Пользователь',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['text'], 'required'],
            [['userId'], 'required'],
        ]);
    }

    public function serializeToArray()
    {
        $serializedData = [];

        $serializedData['text'] = $this->text;
        $serializedData['postId'] = $this->postId;
        $serializedData['userId'] = $this->userId;

        return $serializedData;
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        if (empty($this->created_at) && $insert) {
            $this->created_at = time();
        }
        $this->updated_at = time();
        return true;
    }


}
