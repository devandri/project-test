<?php

namespace app\components;

use Yii;

class Helpers
{
	public static function tableUpdater($model, $update_array, $where, $is_skip = NULL, $db = NULL) {
        if($db == NULL){
            $db = \cf\config::DB_NAME_SWITCHER;
        }
        // die();
        return Yii::$app->$db->createCommand()
            ->update($model::tableName(), $update_array, $where)
            ->execute();
    }
}