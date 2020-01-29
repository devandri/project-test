<?php
namespace app\components;

use yii\base\InvalidConfigException;
use yii\log\Target;

class TeleLog extends Target {
    public $botToken;
    public $chatId;

    public function init() {
        parent::init();
        foreach (['botToken', 'chatId'] as $property) {
            if ($this->$property === null) {
                throw new InvalidConfigException(self::className() . "::\$$property property must be set");
            }
        }
    }

    public function export() {
        $messages = array_map([$this, 'formatMessage'], $this->messages);

        foreach ($messages as $message) {
            $parameters = [
                'chat_id' => $this->chatId,
                'text' => $message,
                // 'parse_mode' => 'markdown',
            ];
            $x = self::send($this->botToken, $parameters);
        }
    }

    public static function send($bot_id, $parameters) {
        $url = strtr("https://api.telegram.org/bot{bot_id}/sendMessage", ['{bot_id}' => $bot_id]);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $parameters,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 8,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
        ));

        // $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }
}