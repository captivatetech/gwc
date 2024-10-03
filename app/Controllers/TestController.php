<?php

namespace App\Controllers;

use App\Controllers\BaseController;

// use Xendit\Xendit;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\CreateInvoiceRequest;
// use Xendit\Payout\PayoutApi;
// use Xendit\Payout\CreatePayoutRequest;
// use Xendit\PaymentRequest\PaymentRequestApi;
// use Xendit\PaymentRequest\PaymentRequestParameters;
// use Xendit\BalanceAndTransaction\BalanceApi;
// use Xendit\BalanceAndTransaction\TransactionApi;

use zsign\OAuth;
use zsign\ZohoSign;
use zsign\SignException;
use zsign\api\Fields;
use zsign\api\Actions;
use zsign\api\RequestObject;
use zsign\api\fields\ImageField;
use CURLfile;

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
        // $privateKey = getenv('xendit_private_key');
        // configureXendit($privateKey);

        Configuration::setXenditKey("xnd_development_HbNUa00qditzQS5JBcn7uPSOjZjp5ZPylJPKfVVI8SwV5ebo97DcSytaAghzX");
        // Configuration::setXenditKey("xnd_development_wiIrZuVXYQFxDnyiOXSuWHzNRwF3O2SuHLYbPMKrODcDP7rx0ecwmHg8cuHZgX");

        $apiInstance = new InvoiceApi();
        $create_invoice_request = new CreateInvoiceRequest([
          'external_id' => 'test12345',
          'description' => 'Test Invoice',
          'amount' => 10000,
          'invoice_duration' => 172800,
          'currency' => 'PHP',
          'reminder_time' => 1,
          'success_redirect_url' => 'https://www.youtube.com/watch?v=DFJZUCg3_DQ',
          'failure_redirect_url' => 'https://www.youtube.com/watch?v=DFJZUCg3_DQ'
        ]); // \Xendit\Invoice\CreateInvoiceRequest
        $for_user_id = "66c744d4d361cea80de79d2b"; // string | Business ID of the sub-account merchant (XP feature)

        try {
            $result = $apiInstance->createInvoice($create_invoice_request, $for_user_id);
            return $this->response->setJSON($result);
            exit();
        } catch (\Xendit\XenditSdkException $e) {
            echo 'Exception when calling InvoiceApi->createInvoice: ', $e->getMessage(), PHP_EOL;
            echo 'Full Error: ', json_encode($e->getFullError()), PHP_EOL;
        }

        // $apiInstance = new PaymentRequestApi();
        // $idempotency_key = "5f9a3fbd571a1c4068aa40ceas"; // string
        // $for_user_id = "66c744d4d361cea80de79d2b"; // string
        // $with_split_rule = null; // string
        // $payment_request_parameters = new PaymentRequestParameters([
        //   'reference_id' => 'example-ref-1234',
        //   'amount' => 15000,
        //   'currency' => 'PHP',
        //   'country' => 'PH',
        //   'payment_method' => [
        //     'type' => 'EWALLET',
        //     'ewallet' => [
        //       'channel_code' => 'SHOPEEPAY',
        //       'channel_properties' => [
        //         'success_return_url' => 'https://redirect.me/success'
        //       ]
        //     ],
        //     'reusability' => 'ONE_TIME_USE'
        //   ]
        // ]); // \Xendit\PaymentRequest\PaymentRequestParameters

        // try {
        //     $result = $apiInstance->createPaymentRequest($idempotency_key, $for_user_id, $with_split_rule, $payment_request_parameters);
        //         print_r($result);
        // } catch (\Xendit\XenditSdkException $e) {
        //     echo 'Exception when calling PaymentRequestApi->createPaymentRequest: ', $e->getMessage(), PHP_EOL;
        //     echo 'Full Error: ', json_encode($e->getFullError()), PHP_EOL;
        // }

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

        // $apiInstance = new PayoutApi();
        // $idempotency_key = "DISB-12345"; // string | A unique key to prevent duplicate requests from pushing through our system. No expiration.
        // $for_user_id = "66c744d4d361cea80de79d2b"; // string | The sub-account user-id that you want to make this transaction for. This header is only used if you have access to xenPlatform. See xenPlatform for more information.
        // $create_payout_request = new CreatePayoutRequest([
        //   'reference_id' => 'DISB-002',
        //   'currency' => 'PHP',
        //   'channel_code' => 'PH_GCASH',
        //   'channel_properties' => [
        //     'account_holder_name' => 'John Doe',
        //     'account_number' => '09123423412'
        //   ],
        //   'amount' => 500,
        //   'description' => 'Test Bank Payout',
        //   'type' => 'DIRECT_DISBURSEMENT'
        // ]); // \Xendit\Payout\CreatePayoutRequest

        // try {
        //     $result = $apiInstance->createPayout($idempotency_key, $for_user_id, $create_payout_request);
        //         print_r($result);
        // } catch (\Xendit\XenditSdkException $e) {
        //     echo 'Exception when calling PayoutApi->createPayout: ', $e->getMessage(), PHP_EOL;
        //     echo 'Full Error: ', json_encode($e->getFullError()), PHP_EOL;
        // }
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
        try{

            /*********
                STEP 1 : Set user credentials
            **********/

            $user = new OAuth( array(
                OAuth::CLIENT_ID    => "1000.VOJVM3LCCCE95VPJVWD2LJS3JET2KW",
                OAuth::CLIENT_SECRET=> "d8995d279be0e05e84ec9abe206fc55e2e2d7cdb36",
                OAuth::DC           => "COM",
                OAuth::REFRESH_TOKEN=> "1000.57d4da049833cbca42eb06e03529dce0.3d6fe947327718a77da41d5bf87da0d2",
                // OAuth::ACCESS_TOKEN => "1000.512ca146138470bd84df0c6a498f9a17.48dde378b2aa452edfff9f0c04341644" // optional. If not set, will auto refresh for access token
            ) );

            ZohoSign::setCurrentUser( $user );

            $user->generateAccessTokenUsingRefreshToken();  // manully generate access token. Else, will auto refresh.

            $access_token = $user->getAccessToken(); // get and store access token so to avoid unnecessary regeneration.

            /*********
            STEP 2 : Get template object by ID
            **********/

            $template = ZohoSign::getTemplate( 418013000000051001 );
        
            /*********
            STEP 3 : Set values to the same object & send for signature
            **********/

            $template->setRequestName("May Sample API Test");
            $template->setNotes("Call us back if you need clarificaions regarding agreement");

            $template->setPrefillTextField( "txt_field1",  "field1" );
            $template->setPrefillTextField( "txt_field2",  "field2" );
            $template->setPrefillTextField( "txt_field3",  "field3" );
            $template->setPrefillTextField( "txt_field4",  "field4" );
            $template->setPrefillTextField( "txt_field5",  "field5" );
            $template->setPrefillTextField( "txt_field6",  "field6" );
            $template->setPrefillTextField( "txt_field7",  "field7" );
            $template->setPrefillTextField( "txt_field8",  "field8" );
            $template->setPrefillTextField( "txt_field9",  "field9" );
            $template->setPrefillTextField( "txt_field10",  "field10" );
        
            $template->getActionByRole("Recepient1")->setRecipientName("Jaun");
            $template->getActionByRole("Recepient1")->setRecipientEmail("ajhay.dev@gmail.com");

            $template->getActionByRole("Recepient2")->setRecipientName("Pedro");
            $template->getActionByRole("Recepient2")->setRecipientEmail("ajhay.work@gmail.com");

            $template->getActionByRole("Recepient3")->setRecipientName("Ya");
            $template->getActionByRole("Recepient3")->setRecipientEmail("ajhay.life@gmail.com");
        
            $resp_obj = ZohoSign::sendTemplate( $template, true );

            echo ":: ".$resp_obj->getRequestId()." : ".$resp_obj->getRequestStatus();

        }catch( SignException $signEx ){
            // log it
            echo "SIGN EXCEPTION : ".$signEx;
        }catch( Exception $ex ){
            // handle it
        }
    }
}
