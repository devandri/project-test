<?php
namespace app\components;

use Yii;
use yii\db\Query;
use app\models\AuditTrail;

class AuditTrailHelper {

    public static function beforeSave($new_data, $model_id, $model_name, $action, $table_name, $where_id, $db = NULL, $old_data=null) {
        if(isset($_SERVER['REMOTE_ADDR'])){ //check if the action is not bulk
            if($action != 'CREATE'){
                if($db == NULL){
                    $connection = Yii::$app->db_switcher;
                }else{
                    $connection = Yii::$app->db;
                }
                if (is_null($old_data)) {
                    $model_old_data = $connection->createCommand("SELECT * FROM $table_name where $where_id");
                    $get_old_data = $model_old_data->queryOne();
                    $old_data = json_encode($get_old_data);
                }
                // return $old_data;
            }else{
                $old_data = NULL;
            }

            $detail_activity = null;

            if(isset($_SERVER['REMOTE_ADDR'])){
                $get_url_referer = Yii::$app->request->url;
                if (strpos($get_url_referer, '?') !== false) {
                    $get_activity = ltrim(substr($get_url_referer, 0, strpos($get_url_referer, "?")), '/');
                }else{
                    $get_activity = ltrim($get_url_referer, '/');
                }

                list($controller, $method) = explode('/', $get_activity);

                $controller = ucfirst(strtolower($controller));
                $method = ucfirst(strtolower($method));

                if (isset($new_data) && $action != 'CREATE') {
                    $diff_old_value = json_encode(array_diff_assoc(json_decode($old_data, true), $new_data));
                    $diff_new_value = json_encode(array_diff_assoc($new_data, json_decode($old_data, true)));
                } else {
                    $diff_new_value = json_encode([]);
                }

                if (strtoupper($controller) == 'CUSTOMER') {
                    if (strpos($method, '-') === false) {
                        if (strtolower($method) == 'edit') {
                            $detail_activity = 'Update ' . $controller;
                        } else {
                            $detail_activity = $method . ' ' . $controller;
                        }
                    } else {
                        if (strpos($get_activity, 'prepare-customer') !== false) {
                            $detail_activity = 'Register ' . $controller;
                        } elseif (strpos($get_activity, 'activate-prepared') !== false) {
                            $detail_activity = 'Activate ' . $controller . ' VA';
                        } elseif (strpos($get_url_referer, 'force-edit') !== false) {
                            $detail_activity = 'Force Edit ' . $controller;
                        } elseif (
                            strpos($get_url_referer, 'switch-stat') !== false ||
                            strpos($get_url_referer, 'switch-blocked-stat') !== false
                        ) {
                            if (count(json_decode($diff_new_value)) > 0) {
                                if (array_key_exists('is_active', json_decode($diff_new_value, true))) {
                                    if (json_decode($diff_new_value)->is_active == 1) {
                                        $detail_activity = 'Activate ' . $controller;
                                    } else {
                                        $detail_activity = 'Deactivate ' . $controller;
                                    }
                                } elseif (array_key_exists('is_blocked', json_decode($diff_new_value, true))) {
                                    if (json_decode($diff_new_value)->is_blocked == 1) {
                                        $detail_activity = 'Block ' . $controller;
                                    } else {
                                        $detail_activity = 'Unblock ' . $controller;
                                    }
                                } else {
                                    $detail_activity = 'Unknown activity';
                                }
                            }
                        } else {
                            $detail_activity = ucwords(strtolower(str_replace("-"," ", $method)));
                        }
                    }
                } elseif (strtoupper($controller) == 'USER') {
                    if (strtoupper($method) == 'UNBLOCK') {
                        $detail_activity = ucwords(strtolower($method . ' ' . $controller));
                    }
                }
            }else{
                $get_activity = 'bulk';
                $get_url_referer = 'bulk';
                $detail_activity = 'bulk';
            }

            $model = new AuditTrail();
            $model->old_value = $old_data;
            $model->new_value = isset($new_data) ? json_encode($new_data) : '';
            $model->action = $action;
            $model->model = $model_name;
            $model->activity = $get_activity;
            $model->detail_activity = $detail_activity;
            $model->insert_date = date('Y-m-d');
            $model->user_id = isset($_SERVER['REMOTE_ADDR']) ? (string) Yii::$app->user->identity->id : 'bulk';
            $model->user_name = isset($_SERVER['REMOTE_ADDR']) ? Yii::$app->user->identity->username : 'bulk';
            $model->ip_address = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'bulk';
            $model->browser = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['HTTP_USER_AGENT'] : 'bulk';
            $model->url_referer = $get_url_referer;
            $model->model_id = isset($model_id) ? (string) $model_id : '-';
            if(strcmp($model->old_value, $model->new_value) != 0){
                if($model->save()){

                } else{
                    print_r($model->getErrors());
                    die();
                }
            }
        }
    }



}