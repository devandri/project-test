<?php

namespace app\components;
use Yii;

use app\models\ProcessLog;

require_once __DIR__ . "/../_api/service/InquiryInvestorAccountClient.php";

class ToolHelpers extends Helpers
{
	// public function index()
	// {
	// 	return $this->doInquiry();
	// }

	public function inquiryCore($params, $force=true)
	{
		// return $params;
		$params = is_array($params) ? json_encode($params) : strval($params);

		$inquiry = new \inquiryInvestorAccount($params, false, $force);

        // ob_start();
        $result = $inquiry->doInquiry();
        // echo $result;
        // return $result;
        /*if ($json_result = json_decode($result))
            if (isset($json_result->status)) {
                if ($json_result->status == '000')
                    // $this->registerLender($req['account_number']);
                    $rest = $json_result->status;
                else
                    // error log
                    $rest = 'notok';
            }*/
        // var_dump($response);
        // $response = ob_get_clean();
        // return $result;

        $log_id = $inquiry->exitWithResponse($result, true);
        // Generate array result
        return [
            'log_id' => $log_id,
            'result' => $result
        ];
	}

    public function validateSsoAccount($data, $usePassword = true)
    {
        $username = trim($data['username']);
        $password = $data['password'];
        $email = $data['email'];

        // validate username
        if (strlen($username) < 2) {
            return "Username should contain at least 2 characters.";
        }
        if (!preg_match('/^[a-zA-Z0-9_.-]*$/', $username, $match)) {
            return "Username only allows alphanumeric and underscore input.";
        }
        if ($usePassword) {
            // validate password
            if (strlen($password) < 8) {
                return "Password should contain at least 8 characters.";
            }
            if (!preg_match_all('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[-@!$%^&*()_+={}\[\]<>?,.\/])[A-Za-z\d-@!$%^&*()_+={}\[\]<>?,.\/]{8,}$/', $password, $match)) {
                return "Minimum 8 characters at least 1 Uppercase Alphabet, 1 Lowercase Alphabet, 1 Number and 1 Special Character.";
            }
        }
        // validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid email format.";
        }
        return true;
    }

    public function InsProcessLog($data)
    {
        $model = new ProcessLog;
        $model->setAttributes($data);
        if (!$model->save()) {
            // log error
            return false;
        }
        return true;
    }

    public function jsonEntity( $data = null )
    {
        //stripslashes
        // return str_replace( '\n',"\\"."\\n",
        //     htmlentities(
        //         utf8_encode( json_encode( $data, JSON_PRETTY_PRINT)  ) , 
        //         ENT_QUOTES | ENT_IGNORE, 'UTF-8' 
        //     )
        // );
        // return utf8_decode($data);
        // header('content-type:text/html;charset=utf-8');
        // return json_encode($data,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }
}