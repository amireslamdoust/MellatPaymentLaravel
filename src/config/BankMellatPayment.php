<?php
/**
 * Created by PhpStorm.
 * User: Amir Eslamdoust
 * Date: 2/21/18
 * Time: 3:03 AM
 */

/**
 * Return Configuration Provider Laravel for mellat bank
 */
return array(

    'wsdl' => env('BANK_MELLAT_WSDL', 'https://pgws.bpm.bankmellat.ir/pgwchannel/services/pgw?wsdl'),
    'operationServer' => env('BANK_MELLAT_OPERATION_SERVER', 'https://bpm.shaparak.ir/pgwchannel/startpay.mellat'),
    'userName' => env('BANK_MELLAT_USERNAME', ''),
    'userPassword' => env('BANK_MELLAT_USER_PASSWORD', ''),
    'callBackURL' => env('BANK_MELLAT_CALL_BACK_URL', ''),
    'terminalId' => env('BANK_MELLAT_TERMINAL_ID', '')

);