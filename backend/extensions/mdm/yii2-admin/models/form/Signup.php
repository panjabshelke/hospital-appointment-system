<?php
namespace mdm\admin\models\form;

use mdm\admin\components\UserStatus;
use mdm\admin\models\User;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Signup form
 */
class Signup extends Model
{
    public $username;
    public $email;
    public $password;
    public $retypePassword;
    public $account_type;
    const ACCOUNT_TYPE = ['Admin' => 'Admin','Compunder'=>'Compunder','Doctor'=>'Doctor','Branch-Head'=>'Branch-Head','Branch-Manager'=>'Branch-Manager', 'Sysadmin' => 'Sysadmin', 'User' => 'User'];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $class = Yii::$app->getUser()->identityClass ? : 'mdm\admin\models\User';
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => $class, 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => $class, 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['account_type', 'required'],
            [['account_type'], 'in', 'range' => self::ACCOUNT_TYPE ],

            ['retypePassword', 'required'],
            ['retypePassword', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $class = Yii::$app->getUser()->identityClass ? : 'mdm\admin\models\User';
            $user = new $class();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->status = ArrayHelper::getValue(Yii::$app->params, 'user.defaultStatus', UserStatus::ACTIVE);
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signupTest() {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->account_type = $this->account_type;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                #assign default permission
                $authManager = Yii::$app->authManager;
                $permission = $authManager->getRole($this->defaultPermission);
                $authManager->assign($permission, $user->id);
                return $user;
            }
        }

        return null;
    }
}
