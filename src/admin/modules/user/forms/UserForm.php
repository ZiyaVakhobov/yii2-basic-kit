<?php


namespace app\src\admin\modules\user\forms;


use app\models\AuthRelation;
use app\models\User;
use app\models\UserRole;
use app\src\admin\modules\user\validators\DuplicationValidator;
use yii\base\Model;

class UserForm extends Model
{
    public $id;
    public $username;
    public $password;

    public $permissions = [];
    public $roles = [];
    /**
     * @var User
     */
    private $user;

    /**
     * UserForm constructor.
     * @param User $user
     * @param array $config
     */
    public function __construct(User $user, $config = [])
    {
        parent::__construct($config);
        $this->user = $user;
        $this->id = $user->id;
        $this->username = $user->username;
        $this->permissions = array_map(function (AuthRelation $item) {
            return $item->auth_item_id;
        }, $user->authRelations);

        $this->roles = array_map(function (UserRole $item) {
            return $item->role_id;
        }, $user->userRoles);
    }

    public function rules()
    {
        return [
            [['username', 'roles'], 'required'],
            [['username'],'trim'],
            [['username'], function ($attribute, $params) {
                if (User::find()->where(['username'=>$this->username])->andWhere(['!=','id',$this->id??0])->exists()) {
                    $this->addError($attribute, 'username should be username');
                }
            }],
            [['password'], 'string', 'min' => 6],
            [['roles','permissions'], 'safe'],
            [['roles'], DuplicationValidator::class],
            [['permissions'], DuplicationValidator::class],
        ];
    }

    public function save()
    {
        $trasaction = \Yii::$app->db->beginTransaction();
        try {
            if (!$this->validate()) {
                $trasaction->rollBack();
                return false;
            }
            $user = $this->user;
            $user->username = $this->username;
            if ($user) {
                $user->password = \Yii::$app->security->generatePasswordHash($this->password);
            }
            $user->save(false);
            AuthRelation::deleteAll(['user_id'=>$user->id]);
            foreach ($this->permissions['item'] as $item)
            {
                (new AuthRelation([
                    'user_id' => $user->id,
                    'auth_item_id' => $item
                ]))->save();
            }
            UserRole::deleteAll(['user_id'=>$user->id]);
            foreach ($this->roles['item'] as $item)
            {
                (new UserRole([
                    'user_id' => $user->id,
                    'role_id' => $item
                ]))->save();
            }
            $trasaction->commit();
            return true;
        }catch (\Exception $exception) {
            $trasaction->rollBack();
            throw $exception;
        }

    }
}