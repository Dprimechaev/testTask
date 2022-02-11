<?php

namespace frontend\models;


use common\models\User;
use yii\base\Model;
use yii\db\ActiveQuery;

/**
 * Description of PostListForm
 *
 */
class UserSignupForm extends Model
{
    /** @var $_users ActiveQuery $query */
    public $username;
    public $password;
    public $email;
    /**
     * @var User
     */
    public $user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username'], 'string'],
            [['password'], 'string'],
            [['email'], 'string'],
        ];
    }

    /**
     * Выбрать посты.
     *
     * @return false
     */
    public function create()
    {
        $this->user = new User();

        $this->user->username = $this->username;
        $this->user->email = $this->email;
        $this->user->setPassword($this->password);
        $this->user->accessToken = \Yii::$app->security->generateRandomString();

        //TODO: move to User::beforeCreate

//        if (empty($this->user->created_at)) {
//            $this->user->created_at = time();
//        }
//        $this->user->updated_at = time();

        if (!$this->user->save()) {
            $this->addErrors($this->user->getErrors());
            return false;
        }
        return true;
    }

    public function serializeResponseToArray()
    {
        return [
            'user' => $this->user->serializeToArray(),
        ];
    }


}
