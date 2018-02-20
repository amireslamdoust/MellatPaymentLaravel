<?php
/**
 * Created by PhpStorm.
 * User: Amir Eslamdoust
 * Date: 2/21/18
 * Time: 2:56 AM
 */

namespace AmirEslamdoust\BankMellatPaymentService;

use SoapClient;

/**
 * Class BankMellatPayment
 * @author Amir Eslamdoust <amireslamdoust@gmail.com>
 * @package AmirEslamdoust\BankMellatPaymentService
 * @see http://www.behpardakht.com/
 *
 */
class BankMellatPayment
{
    protected $soapClient;
    protected $wsdl;
    public $config;
    public $callBackURL;

    public function __construct()
    {
        $this->soapClient = new SoapClient(Config('BankMellatPayment.wsdl'));
        $this->config = Config('BankMellatPayment');
        $this->callBackURL = $this->config['callBackURL'];
    }

    /**
     * Payment Request
     * @author Amir Eslamdoust <amireslamdoust@gmail.com>
     * @param $amount - IRR
     * @param $orderId - INT
     * @param string $additionalData
     * @param int $payerId
     * @return array
     * @throws \Exception
     */
    public function paymentRequest($amount, $orderId, $additionalData = '', $payerId = 0)
    {
        if($amount && $amount > 100 && $orderId ) {
            $parameters = [
                'terminalId' => $this->config['terminalId'],
                'userName' => $this->config['userName'],
                'userPassword' => $this->config['userPassword'],
                'orderId' => $orderId,
                'amount' => $amount,
                'localDate' => date("Ymd"),
                'localTime' => date("His"),
                'additionalData' => $additionalData,
                'callBackUrl' => $this->callBackURL,
                'payerId' => $payerId
            ];

            try {

                // Call the SOAP method
                $result = $this->soapClient->bpPayRequest($parameters);
                // Display the result
                $res = explode(',', $result->return);
                if ($res[0] == "0") {
                    return [
                        'result' => true,
                        'res_code' => $res[0],
                        'ref_id' => $res[1]
                    ];
                } else {
                    return [
                        'result' => false,
                        'res_code' => $res[0],
                        'ref_id' => isset($res[1]) ? $res[1] : null
                    ];
                }
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }
    }

    /**
     * Verify Payment
     * @author Amir Eslamdoust <amireslamdoust@gmail.com>
     * @param $orderId
     * @param $saleOrderId
     * @param $saleReferenceId
     * @return mixed - false for failed
     */
    public function verifyPayment($orderId, $saleOrderId, $saleReferenceId)
    {

        if($orderId && $saleOrderId && $saleReferenceId) {

            $parameters = [
                'terminalId' => $this->config['terminalId'],
                'userName' => $this->config['userName'],
                'userPassword' => $this->config['userPassword'],
                'orderId' => $orderId,
                'saleOrderId' => $saleOrderId,
                'saleReferenceId' => $saleReferenceId,
            ];

            try {

                // Call the SOAP method
                return $this->soapClient->bpVerifyRequest($parameters);
            } catch (Exception $e) {
                return $e->getMessage();
            }
        } else
            return false;
    }
}