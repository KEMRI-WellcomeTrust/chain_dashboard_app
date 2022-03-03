<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\ChainUsers;
/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // email and password are both required
            [['email', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect email or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided email and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        $attributes['email'] = $this->email;
        $attributes['password'] = $this->password;
        
        $userObject = $this->getUser();
        
        if($userObject){
            if ($userObject->validatePassword($this->password)) { 
                
                return true;
            }
            else{
		$this->addError('password', 'Incorrect username or password.');
                return false;
            }
        }
        else{
                $this->addError('email', 'Incorrect Email.');
        }
      
        return false;
    }

    /**
     * Finds user by [[email]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = ChainUsers::findUserByEmail($this->email);
        }

        return $this->_user;
    }
}
