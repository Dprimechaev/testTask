<?php

namespace frontend\models;

use common\models\User;
use yii\base\Model;
use yii\db\ActiveQuery;

/**
 * Description of PostListForm
 *
 */
class UserSigninForm extends Model
{
    /** @var $_users ActiveQuery $query */
    public $email;
    public $password;
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
            [['email'], 'string'],
            [['password'], 'string'],
        ];
    }

    /**
     * Выбрать посты.
     *
     * @return false
     */
    public function auth()
    {
        $this->user = User::find()
            ->andWhere([
                'email' => $this->email,
            ])
            ->one();

        if (empty($this->user)) {
            $this->addError('email' ,'user with this email not found');
            return false;
        }
        if (!$this->user->validatePassword($this->password)) {
            $this->addError('email' ,'Incorrect password');
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

