<?php

namespace app\components;

use Yii;

class P2pCrypt //FTAes
{

    public static function encrypt($input, $secret_key)
    {
        try {
            //Method
            $get_method = openssl_get_cipher_methods();
            $encrypt_method = $get_method[0];

            //Key hash
            $key = hash('sha256', $secret_key);
            //Initialization Vector.
            $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($encrypt_method));

            $output = openssl_encrypt($input, $encrypt_method, $key, OPENSSL_RAW_DATA, $iv);
            $output = base64_encode($iv . $output);
            return $output;
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function decrypt($input, $secret_key)
    {
        try {
            //method
            $get_method = openssl_get_cipher_methods();
            $encrypt_method = $get_method[0];

            $msg = base64_decode($input);
            //Initialization Vector
            $iv = substr($msg, 0, 16);
            //Data to Decrypt
            $data = substr($msg, 16);
            //Key hash
            $key = hash('sha256', $secret_key);

            $output = openssl_decrypt($data, $encrypt_method, $key, OPENSSL_RAW_DATA, $iv);
            return $output;
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function secret_key()
    {
        return 'nwbjcxx5gsqwpfrtmxavrxupjbixmyw7ulxu94tyhla=';
    }

}
