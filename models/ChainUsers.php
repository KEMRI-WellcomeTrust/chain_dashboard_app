<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
use yii\helpers\Url;

/**
 * This is the model class for table "chain_users".
 *
 * @property int $id
 * @property int $fk_site
 * @property string $email
 * @property string $username
 * @property string $passwd
 * @property string $last_login
 * @property string $role
 *
 * @property ChainSites $fkSite
 */
class ChainUsers extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $confirmpass;
    public $authKey;
    public $checkpass;
    public $emailpass;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chain_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fk_site'], 'integer'],
            [['last_login'], 'safe'],
            [['role'], 'string', 'max' => 100],
            [['email', 'username', 'passwd','confirmpass', 'checkpass','emailpass'], 'string', 'max' => 200],
            [['fk_site'], 'exist', 'skipOnError' => true, 'targetClass' => ChainSites::className(), 'targetAttribute' => ['fk_site' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_site' => 'Site',
            'email' => 'Email',
            'username' => 'Username',
            'passwd' => 'Password',
            'last_login' => 'Last Login',
            'role'=>"Role",
            'confirmpass'=> "Confirm Password",
            'emailpass' => "Email Password"
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkSite()
    {
        return $this->hasOne(ChainSites::className(), ['id' => 'fk_site']);
    }
    
    public function beforeSave($insert) {
        parent::beforeSave($insert);
        
          //hash the password
        if($this->checkpass == 1){
            if($this->passwd == ''){
                $this->addError('passwd', "Password is required.");
            }
            //check password
            if($this->checkPasswords()){
                $this->passwd =  Yii::$app->getSecurity()->generatePasswordHash($this->passwd); //md5($this->password);
            }
        }
        
        
        if($this->hasErrors()){
              return false;
          }
          else{
            return true;
          }
    }
    public function afterSave($insert, $changedAttributes) {
        if($this->emailpass == 1){
            $this->emailPassword();
        }
        
        return parent::afterSave($insert, $changedAttributes);
    }
    
    public function checkPasswords(){
        if($this->passwd === $this->confirmpass){
            return true;
        }
        else{
            $this->addError('passwd', "Passwords do not match!"); //{$this->password} and Repeat: {$this->confirm_pass}
        }
    }
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
         return self::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $users = self::find()->All();
        foreach ($users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }
     /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $users = self::find()->All();
        foreach ($users as $user) {
            if (strcasecmp($user->username, $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }
    public static function findUserByEmail($email){
        
        $users = self::find()->All();
        foreach ($users as $user) {
            if (strcasecmp($user->email, $email) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {  
       //return $this->pass === $password;
       if (Yii::$app->getSecurity()->validatePassword($password, $this->passwd)) {
           return true;
        } else {
            return false;
        }
    }
    
    public static function getUrl($type){
        
       if(Yii::$app->user->isGuest){
           return Url::to(['site/login']);
       }
       else{
           switch ($type){
               case "clinical_report":
                   return Url::to(['site/clinical']);
               case "lab_report":
                   return Url::to(['site/lab']);
               case "clinical_qc":
                   return Url::to(['site/qc']);
               case "lab_qc":
                   return Url::to(['site/labqc']);
               case "lab_storage":
                   return Url::to(['site/lab-storage']);
               case "chain2":
                   return Url::to(['site/chain2']);
               case "viz":
                   return Url::to(['site/viz']);
               case "monitoring":
                   return Url::to(['site/monitoring']);
               case "neobac":
                   return Url::to(['site/neobac']);
               case "par":
                   return Url::to(['site/par']);
               case "biorepo":
                   return Url::to(['site/biorepo']);

               case "pbsam":
                    return Url::to(['site/pbsam']);
           }
       }
    }
    
    public static function isAdmin(){
        if(!Yii::$app->user->isGuest){
            $role = Yii::$app->user->identity->role;
            if($role == 1 | $role == 4){
                return true;
            }
            else{
                return false;
            }
        }
    }
    
    public function loginStamp(){
        $model = $this->findone($this->id);
        if($model){
            $model->last_login = Date("Y-m-d H:i:s");
            $model->save(false);
        }
        
    }
    
    public function emailPassword(){
        //send email to this user
        Yii::$app->mailer->compose()
            ->setFrom(Yii::$app->params['adminEmail'])
            ->setTo($this->email)
            ->setSubject("CHAIN Reports Dashboard Password Set Up!")
           // ->setTextBody('Plain text content')
            ->setHtmlBody("<p> Dear {$this->username} </p>"
                    . "<p> Your password for <a href='https://reports.chainnetwork.org'> CHAIN Reports Dashboard </a> has been set up successfully. Please use the credentials below to login to our reporting dashboard: - </p>"
                    . "URL: <a href='https://reports.chainnetwork.org'> https://reports.chainnetwork.org </a>"."<br/>"
                    . "E-mail: ".$this->email."<br/>"
                    . "Password: ".$this->confirmpass."<br/>"
                    . "<p> Regards, <br/> CHAIN Co-ordination Team <p>")
            ->send();
    }
}
