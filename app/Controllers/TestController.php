<?php

namespace App\Controllers;

use App\Controllers\BaseController;

// use Xendit\Xendit;
use Xendit\Configuration;
use Xendit\Payout\PayoutApi;
use Xendit\Payout\CreatePayoutRequest;
// use Xendit\BalanceAndTransaction\BalanceApi;
// use Xendit\BalanceAndTransaction\TransactionApi;

class TestController extends BaseController
{
    public function sample()
    {
        $series = substr('GWC0001-202400001', 12);
        echo $series;

        $year = substr('GWC0001-202400001', 8, 4);
        echo $year;
    }

    public function testXendit()
    {
        $privateKey = getenv('xendit_private_key');
        configureXendit($privateKey);

        // Configuration::setXenditKey("xnd_development_HbNUa00qditzQS5JBcn7uPSOjZjp5ZPylJPKfVVI8SwV5ebo97DcSytaAghzX");

        // $apiInstance = new BalanceApi();
        // $account_type = "CASH"; // string | The selected balance type
        // $currency = "PHP"; // string | Currency for filter for customers with multi currency accounts
        // $at_timestamp = "2024-01-01T00:00:00.000Z"; // \DateTime | The timestamp you want to use as the limit for balance retrieval
        // $for_user_id = "66c744d4d361cea80de79d2b"; // string | The sub-account user-id that you want to make this transaction for. This header is only used if you have access to xenPlatform. See xenPlatform for more information

        // try {
        //     $result = $apiInstance->getBalance($account_type, $currency, $at_timestamp, $for_user_id);
        //     print_r($result);
        // } catch (\Xendit\XenditSdkException $e) {
        //     echo 'Exception when calling BalanceApi->getBalance: ', $e->getMessage(), PHP_EOL;
        //     echo 'Full Error: ', json_encode($e->getFullError()), PHP_EOL;
        // }

        $apiInstance = new PayoutApi();
        $idempotency_key = "DISB-12345"; // string | A unique key to prevent duplicate requests from pushing through our system. No expiration.
        $for_user_id = "66c744d4d361cea80de79d2b"; // string | The sub-account user-id that you want to make this transaction for. This header is only used if you have access to xenPlatform. See xenPlatform for more information.
        $create_payout_request = new CreatePayoutRequest([
          'reference_id' => 'DISB-002',
          'currency' => 'PHP',
          'channel_code' => 'PH_GCASH',
          'channel_properties' => [
            'account_holder_name' => 'John Doe',
            'account_number' => '09123423412'
          ],
          'amount' => 500,
          'description' => 'Test Bank Payout',
          'type' => 'DIRECT_DISBURSEMENT'
        ]); // \Xendit\Payout\CreatePayoutRequest

        try {
            $result = $apiInstance->createPayout($idempotency_key, $for_user_id, $create_payout_request);
                print_r($result);
        } catch (\Xendit\XenditSdkException $e) {
            echo 'Exception when calling PayoutApi->createPayout: ', $e->getMessage(), PHP_EOL;
            echo 'Full Error: ', json_encode($e->getFullError()), PHP_EOL;
        }
    }

    public function testJson()
    {
        $jsonData = file_get_contents(base_url() . "public/channel_codes.json");

        if ($jsonData === false) {
            echo "hello";
            die('Error reading the JSON file');
        }

        $json_data = json_decode($jsonData, true); 

        // Check if the JSON was decoded successfully
        if ($json_data === null) {
            die('Error decoding the JSON file');
        }

        // Display data
        echo $json_data['Data'][0]['channel_code'];
    }

    public function testZohoSign()
    {

        // $curl = curl_init("https://sign.zoho.com/api/v1/templates");
        // curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        // curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        //     'Authorization:Zoho-oauthtoken 1000.928b54a3cb9e47afae1de4cc88f76468.13c97c8bd555d2590ed8467d6d5309a9',
        // ));
        // curl_setopt($curl, CURLOPT_POST, false);
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // $result = curl_exec($curl);
        // curl_close($curl);


        // return $response;

        $result = sendTemplate();

        return $this->response->setJSON($result);
    }
}
