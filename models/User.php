<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use app\models\User;
use app\components\AuditTrailHelper;
/**
 * This is the model class for table "user".
 *
 * @property integer $user_id
 * @property string $email
 * @property string $username
 * @property string $password
 * @property integer $is_active
 * @property string $p2p_id
 * @property string $auth_key
 * @property string $access_token
 * @property integer $login_attempt
 * @property string $created_date
 * @property string $updated_date
 * @property string $session_id
 * @property string $ip_address
 * @property string $password_delivery
 */
class User extends ActiveRecord implements IdentityInterface
{
    public $permission;
    public $role;
    public $description;
    // public $password_delivery;
    // public $role;

    /**
     * @inheritdoc
     */

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios['update-user'] = ['email', 'username', 'required', 'permission', 'safe'];
        return $scenarios;
    }

    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'username'], 'required'],
            [['password'], 'required', 'on' => 'create_user'],
            [['is_active', 'login_attempt', 'is_p2p', 'is_ecoll'], 'integer'],
            [['password'], 'string', 'min' => 8],
            [['password'], 'match', 'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[-@!$%^&*()_+={}\[\]<>?,.\/])[A-Za-z\d-@!$%^&*()_+={}\[\]<>?,.\/]{8,}$/', 'message' => 'Minimum 8 characters at least 1 Uppercase Alphabet, 1 Lowercase Alphabet, 1 Number and 1 Special Character'],
            [['created_date', 'updated_date', 'p2p_id', 'password_delivery'], 'safe'],
            [['email', 'auth_key', 'access_token'], 'string', 'max' => 255],
            [['username'], 'string', 'min' => 2, 'max' => 255],
            [['username', 'email'], 'unique'],
            [['username'], 'match', 'pattern' => '/^[a-zA-Z0-9_.-]*$/', 'message' => '{attribute} only allows alphanumeric and underscore input'],
            [['session_id'], 'string', 'max' => 40],
            [['ip_address'], 'string', 'max' => 15],
            [['email'], 'unique'],
            [['email'], 'email', 'message' => 'Invalid email format'],
            [['p2p_id'], 'checkP2pId', 'skipOnEmpty' => false]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'email' => 'Email',
            'username' => 'Username',
            'password' => 'Password',
            'is_active' => 'Is Active',
            'p2p_id' => 'P2P ID',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
            'login_attempt' => 'Login Attempt',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
            'session_id' => 'Session ID',
            'ip_address' => 'Ip Address',
            'password_delivery' => 'Password Delivery',
            'is_p2p' => 'Is P2P?',
            'is_ecoll' => 'Is Ecoll?'
        ];
    }

    public function getAccess()
    {
        $acc = implode(", ", array_keys(Yii::$app->authManager->getAssignments($this->user_id)));
        return $acc;
    }

    public static function getAuthItems()
    {
        $manager = Yii::$app->getAuthManager();
        // foreach (array_keys($manager->getRoles()) as $name) {
        //     if ($manager->getRoles()[$name]->data['admin_only'] != 'true') {
        //         if ($name[0] != '/') {
        //             $role[$name] = $name;
        //         }
        //     }
        // }
        foreach (array_keys($manager->getPermissions()) as $name) {
            if ($manager->getPermissions()[$name]->data['admin_only'] != 'true') {
                if ($name[0] != '/') {
                    $permission[$name] = $name;
                }
            }
        }

        return[
            // 'role' => $role,
            'permission' => $permission,
        ];
    }

    public static function getUserAssignments($user_id)
    {
        $assignments = [];
        $manager = Yii::$app->getAuthManager();
        foreach (array_keys($manager->getAssignments($user_id)) as $name) {
            if ($name[0] != '/') {
                $assignments[$name] = $name;
            }
        }

        return $assignments;
    }

    public static function revokeUserAssignments($user_id)
    {
        $manager = Yii::$app->getAuthManager();
        return $manager->revokeAll($user_id);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $password = openssl_encrypt($this->password, "AES-128-ECB", "(100+100)*0=zero");
            
            // Prevent password self updated
            $oldValues = $this->getOldAttributes();
            if(!empty($oldValues) && $this->password == '') {
                $this->password = $oldValues['password'];
            }
            $is_exist = User::find()
                ->where(['AND', ['password' => $this->password], ['user_id' => $this->user_id]])->one();            
            if (empty($is_exist)) {
                $this->password = Yii::$app->security->generatePasswordHash($this->password);
            }
            
            if ($this->isNewRecord) {
                Yii::info('[username: '.$this->username.']/[password: '.$password.']/[password hash: '.$this->password.']', 'password/add-user');
                $this->is_active = 1;
                $this->auth_key = Yii::$app->security->generateRandomString();
                $this->access_token = Yii::$app->security->generateRandomString() . '_' . time();
            } else {

                Yii::info('[username: '.$this->username.']/[password: '.$password.']/[password hash: '.$this->password.']', 'password/change-user');
            }

            /*get user's p2p */
            if($this->is_p2p == 1 && is_array($this->p2p_id)){
                $this->p2p_id = implode(';', $this->p2p_id);
            }

            $attributes = $this->attributes();
            $model_id = $this->user_id; //dynamic PK
            $where_id = "user_id = '$model_id'";
            $model_name = substr(get_class($this), 11);
            $tabel_name = $this->tableName();
            foreach ($attributes as $value) {
                $temp_new_data[] = array(
                    $value => $this->$value
                );
            }
            $new_data = call_user_func_array("array_merge", $temp_new_data);
            if ($insert) {
                AuditTrailHelper::beforeSave($new_data, $model_id, $model_name, 'CREATE', $tabel_name, $where_id);
            } else {
                AuditTrailHelper::beforeSave($new_data, $model_id, $model_name, 'UPDATE', $tabel_name, $where_id, 'db');
            }
            return true;
        }
        return false;
    }

    public function beforeDelete()
    {
        $attributes = $this->attributes();
        $model_id = $this->user_id; //dynamic PK
        $where_id = "user_id = '$model_id'";
        $model_name = substr(get_class($this), 11);
        $tabel_name = $this->tableName();

        AuditTrailHelper::beforeSave(NULL, $model_id, $model_name, 'DELETE', $tabel_name, $where_id, 'db');   
        return parent::beforeDelete();
    }

    public static function findIdentity($user_id)
    {
        return static::findOne($user_id);
    }

    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->user_id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    public function generateAccessToken()
    {
        $this->access_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function checkP2pId($attribute, $params){
        if ($this->is_p2p == 1 && $this->p2p_id == '') {
            $this->addError($attribute, "P2P(s) cannot be empty!");
            return false;
        } else {
            return true;
        }
    }
}
