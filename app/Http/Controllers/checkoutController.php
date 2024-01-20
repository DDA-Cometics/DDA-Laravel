<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\Interfaces\IShopping_cartService;
use Illuminate\Support\Facades\URL;

class checkoutController extends Controller
{
    protected $Shopping_cartService;
    public function __construct(IShopping_cartService $Shopping_cartService)
    {
        $this->Shopping_cartService = $Shopping_cartService;
    }

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

        $result = curl_exec($ch);

        curl_close($ch);
        return $result;
    }
    public function paymentMomo(Request $request)
    {   
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

        $orderInfo =$request->user_name;
        $amount = ($request->amount);
        $orderId = time() . mt_rand(1000, 9999);
        $redirectUrl = env("APP_URL")."/ordered";
        $ipnUrl = env("APP_URL")."/ordered";
        $extraData = "";
        $partnerCode = $partnerCode;
        $accessKey = $accessKey;
        $serectkey = $secretKey;
        $orderId = $orderId;
        $orderInfo = $orderInfo;
        $amount = $amount;
        $ipnUrl = $ipnUrl;
        $redirectUrl = $redirectUrl;
        $extraData = $extraData;
    
        $requestId = time() . "";
        $requestType = "payWithATM";
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $serectkey);
        $data = array('partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature);
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true); 
        if (isset($jsonResult['payUrl'])) {
            return redirect()->away($jsonResult['payUrl']);
        } else {
            return redirect('/cart?err=true');
        }
    }
    public function ordered(Request $request)
    {   
        $sessionData = session()->get('user_data');
        $userId = $sessionData['id'];
        $shoppingCart =$this->Shopping_cartService->returnProductWithCart($userId);

        $partnerCode = $request->input('partnerCode');
        $orderId = $request->input('orderId');
        $requestId = $request->input('requestId');
        $amount = $request->input('amount');
        $orderInfo = $request->input('orderInfo');
        $orderType = $request->input('orderType');
        $transId = $request->input('transId');
        $resultCode = $request->input('resultCode');
        $message = $request->input('message');
        $payType = $request->input('payType');
        $responseTime = $request->input('responseTime');
        $extraData = $request->input('extraData');
        $signature = $request->input('signature');
        $paymentOption = $request->input('paymentOption');
        $data = [
            'partnerCode' => $partnerCode,
            'orderId' => $orderId,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderInfo' => $orderInfo,
            'orderType' => $orderType,
            'transId' => $transId,
            'resultCode' => $resultCode,
            'message' => $message,
            'payType' => $payType,
            'responseTime' => $responseTime,
            'extraData' => $extraData,
            'signature' => $signature,
            'paymentOption' => $paymentOption,
        ];
        $this->Shopping_cartService->ordered($request, $userId,$shoppingCart);
        return view('pages.checkout.index',["data"=>$data])->with("products",$shoppingCart);
    }
    public function history(){
        $sessionData = session()->get('user_data');
        $userId = $sessionData['id']?? 0 ;
        $shoppingCart =$this->Shopping_cartService->returnProductWithCart($userId);
        $paymentHistory =   $this->Shopping_cartService->history($userId);
        return view('pages.payment_history.index', ["paymentHistory" => $paymentHistory])->with("products", $shoppingCart);
    }
}
