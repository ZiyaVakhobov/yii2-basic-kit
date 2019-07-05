<?php


namespace app\src\admin\modules\user\forms;


use app\models\Role;
use app\models\RoleItem;
use app\src\admin\modules\user\validators\DuplicationValidator;
use yii\base\Model;

class RoleForm extends Model
{
    public $id;
    public $name;
    public $description;

    public $permissions=[];
    /**
     * @var Role
     */
    private $role;

    /**
     * RoleForms constructor.
     * @param Role $role
     * @param array $config
     */
    public function __construct(Role $role, $config = [])
    {
        parent::__construct($config);
        $this->role = $role;
        $this->id = $role->id;
        $this->name = $role->name;
        $this->description = $role->description;
        $this->permissions = array_map(function ($item){
            return [
                'id'=>$item->auth_item_id
            ];
        },
            $role->roleItems
        );
    }

    public function rules()
    {
        return [
            [['description'],'string'],
            [['name','permissions'],'required'],
            [['permissions'],DuplicationValidator::class]
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }
        $role = $this->role;
        $role->name = $this->name;
        $role->description = $this->description;
        $role->save();
        RoleItem::deleteAll(['role_id'=>$role->id]);
        foreach ($this->permissions['item'] as $key=>$value)
        {
            (new RoleItem([
                'role_id' => $role->id,
                'auth_item_id' => $value??null
            ]))->save();
        }
        return true;
    }
}