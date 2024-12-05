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

    public function testNumberToWords()
    {
        $number = 112.21;
        
        // $wholeNumber = floor($number);
        // $decimalNumber = number_format(($number - $wholeNumber),2);

        // $str = explode(".", $decimalNumber);
        // echo $str[1];
        echo numbersToWords($number);
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
        // $jsonData = file_get_contents(base_url() . "public/channel_codes.json");

        // if ($jsonData === false) {
        //     echo "hello";
        //     die('Error reading the JSON file');
        // }

        // $json_data = json_decode($jsonData, true); 

        // // Check if the JSON was decoded successfully
        // if ($json_data === null) {
        //     die('Error decoding the JSON file');
        // }

        // // Display data
        // echo $json_data['Data'][0]['channel_code'];

        echo numbersToWords(7777);
    }

    public function testDownloadDocument($requestId)
    {

        $user = new OAuth( array(
            OAuth::CLIENT_ID    => "1000.VOJVM3LCCCE95VPJVWD2LJS3JET2KW",
            OAuth::CLIENT_SECRET=> "d8995d279be0e05e84ec9abe206fc55e2e2d7cdb36",
            OAuth::DC           => "COM",
            OAuth::REFRESH_TOKEN=> "1000.57d4da049833cbca42eb06e03529dce0.3d6fe947327718a77da41d5bf87da0d2"
        ) );

        ZohoSign::setCurrentUser( $user );

        $user->generateAccessTokenUsingRefreshToken();  // manully generate access token. Else, will auto refresh.

        $access_token = $user->getAccessToken(); // get and store access token so to avoid unnecessary regeneration.

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://sign.zoho.com/api/v1/requests/$requestId/pdf");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Zoho-oauthtoken $access_token"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        header('Content-type: application/pdf');
        $response = curl_exec($ch);

        curl_close($ch);      

        // echo '<iframe src="$response">';
        echo $response;
        exit();
        
        // Header content type
        // header('Content-type: application/pdf');
        // header('Content-Disposition: inline;
        // filename="' . $response . '"');
        // header('Content-Transfer-Encoding: binary');
        // header('Accept-Ranges: bytes');
        
        // // Read the file
        // @readfile($response);
        // exit();

        // try{

        //     /*********
        //         STEP 1 : Set user credentials
        //     **********/

        //     $user = new OAuth( array(
        //         OAuth::CLIENT_ID    => "1000.VOJVM3LCCCE95VPJVWD2LJS3JET2KW",
        //         OAuth::CLIENT_SECRET=> "d8995d279be0e05e84ec9abe206fc55e2e2d7cdb36",
        //         OAuth::DC           => "COM",
        //         OAuth::REFRESH_TOKEN=> "1000.57d4da049833cbca42eb06e03529dce0.3d6fe947327718a77da41d5bf87da0d2",
        //         // OAuth::ACCESS_TOKEN => "1000.512ca146138470bd84df0c6a498f9a17.48dde378b2aa452edfff9f0c04341644" // optional. If not set, will auto refresh for access token
        //     ) );

        //     ZohoSign::setCurrentUser( $user );

        //     $user->generateAccessTokenUsingRefreshToken();  // manully generate access token. Else, will auto refresh.

        //     $access_token = $user->getAccessToken(); // get and store access token so to avoid unnecessary regeneration.

        //     /*********
        //     STEP 2 : Get template object by ID
        //     **********/
        //     // $dir = getenv('HOMEDRIVE').getenv('HOMEPATH').'\Downloads';
        //     // ZohoSign::setDownloadPath($dir);
        //     // ZohoSign::getDownloadPath();

        //     // $document = ZohoSign::downloadDocument(418013000000056015,418013000000056001);

        //     $document = ZohoSign::getRequest(418013000000056015);

        //     print_r($document);
        //     exit();

        //     // $msgResult = json_decode(json_encode($resp_obj),true);
        //     // return $this->response->setJSON($msgResult);
        //     // exit();

        // }catch( SignException $signEx ){
        //     // log it
        //     echo "SIGN EXCEPTION : ".$signEx;
        // }catch( Exception $ex ){
        //     // handle it
        // }
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
            $template->setPrefillTextField( "txt_field11",  "field11" );
            $template->setPrefillTextField( "txt_field12",  "field12" );
            $template->setPrefillTextField( "txt_field13",  "field13" );
            $template->setPrefillTextField( "txt_field14",  "field14" );
            $template->setPrefillTextField( "txt_field15",  "field15" );
            $template->setPrefillTextField( "txt_field16",  "field16" );
            $template->setPrefillTextField( "txt_field17",  "field17" );
            $template->setPrefillTextField( "txt_field18",  "field18" );
            $template->setPrefillTextField( "txt_field19",  "field19" );
            $template->setPrefillTextField( "txt_field20",  "field20" );
            $template->setPrefillTextField( "txt_field21",  "field21" );
            $template->setPrefillTextField( "txt_field22",  "field22" );
            $template->setPrefillTextField( "txt_field23",  "field23" );
            $template->setPrefillTextField( "txt_field24",  "field24" );
            $template->setPrefillTextField( "txt_field25",  "field25" );
            $template->setPrefillTextField( "txt_field26",  "field26" );
            $template->setPrefillTextField( "txt_field27",  "field27" );
            $template->setPrefillTextField( "txt_field28",  "field28" );
        
            $template->getActionByRole("Recepient1")->setRecipientName("Jaun");
            $template->getActionByRole("Recepient1")->setRecipientEmail("ajhay.dev@gmail.com");
            $template->setPrefillTextField( "txt_employeeName",  "Hello" );

            $template->getActionByRole("Recepient2")->setRecipientName("Pedro");
            $template->getActionByRole("Recepient2")->setRecipientEmail("ajhay.work@gmail.com");
            $template->setPrefillTextField( "txt_representativeName",  "World" );

            $template->getActionByRole("Recepient3")->setRecipientName("Ya");
            $template->getActionByRole("Recepient3")->setRecipientEmail("ajhay.life@gmail.com");
            $template->setPrefillTextField( "txt_lenderName",  "Hi" );
        
            $resp_obj = ZohoSign::sendTemplate( $template, true );

            // echo ":: ".$resp_obj->getRequestId()." : ".$resp_obj->getRequestStatus();

            print_r($resp_obj);
            exit();

            // $msgResult = json_decode(json_encode($resp_obj),true);
            // return $this->response->setJSON($msgResult);
            // exit();

        }catch( SignException $signEx ){
            // log it
            echo "SIGN EXCEPTION : ".$signEx;
        }catch( Exception $ex ){
            // handle it
        }
    }
}
