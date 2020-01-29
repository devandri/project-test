<?php

namespace app\models;

use Yii;
// use app\components\AuditTrailHelper;

/**
 * This is the model class for table "menu".
 *
 * @property int $id
 * @property string $name
 * @property int $parent
 * @property string $route
 * @property int $order
 * @property resource $data
 *
 * @property Menu $parent0
 * @property Menu[] $menus
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent', 'order'], 'integer'],
            [['data'], 'string'],
            [['name'], 'string', 'max' => 128],
            [['route'], 'string', 'max' => 256],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::className(), 'targetAttribute' => ['parent' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'parent' => 'Parent',
            'route' => 'Route',
            'order' => 'Order',
            'data' => 'Data',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent0()
    {
        return $this->hasOne(Menu::className(), ['id' => 'parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenus()
    {
        return $this->hasMany(Menu::className(), ['parent' => 'id']);
    }

    // public function beforeSave($insert)
    // {
    //     if (parent::beforeSave($insert)) {
    //         $attributes = $this->attributes();
    //         $model_id = $this->id; //dynamic PK
    //         $where_id = "id = '$model_id'";
    //         $model_name = substr(get_class($this), 11);
    //         $tabel_name = $this->tableName();
    //         foreach ($attributes as $value) {
    //             $temp_new_data[] = array(
    //                 $value => $this->$value
    //             );
    //         }
    //         $new_data = call_user_func_array("array_merge", $temp_new_data);
    //         if ($insert) {
    //             AuditTrailHelper::beforeSave($new_data, $model_id, $model_name, 'CREATE', $tabel_name, $where_id);
    //         }else{
    //             AuditTrailHelper::beforeSave($new_data, $model_id, $model_name, 'UPDATE', $tabel_name, $where_id);
    //         }
            
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    // public function beforeDelete()
    // {
    //     $attributes = $this->attributes();
    //     $model_id = $this->id; //dynamic PK
    //     $where_id = "id = '$model_id'";
    //     $model_name = substr(get_class($this), 11);
    //     $tabel_name = $this->tableName();

    //     AuditTrailHelper::beforeSave(NULL, $model_id, $model_name, 'DELETE', $tabel_name, $where_id);
    //     return parent::beforeDelete();
    // }
}
