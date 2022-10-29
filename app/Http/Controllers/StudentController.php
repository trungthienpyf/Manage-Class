<?php

namespace App\Http\Controllers;


use App\Models\ClassSchedule;
use App\Models\ClassStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class StudentController extends Controller
{
    public function index()
    {
        View::share('title', 'Chương trình học');
        $classes = ClassSchedule::query()
            ->with('subject')
            ->whereDoesntHave('students', function ($query) {
                $query->where('student_id',auth()->user()->id);
            })
            ->where('status', 0)
            ->get();
        return view('student.index', compact('classes'));
    }

    public function viewCalendar()
    {
        return view('student.calendar');
    }

    public function progress(ClassSchedule $progress)
    {
        View::share('title', 'Đăng ký');
        return view('student.progress', compact('progress'));
    }


    public function resultPayment(Request $request)
    {
        $msg = "";

        $id=explode("=", $request->extraData)[1];

        if ($request->resultCode == 0) {

            $payment=$request->orderType;

            ClassStudent::create([
                'classSchedule_id' => $id,
                'student_id' => auth()->user()->id,
                'status' => 0,
                'payment' => $payment,
            ]);

            $msg = $request->orderInfo . " - " . $request->message;
            return view('student.thank', compact('msg'));
        }
        return redirect()->back();


    }

    public function paymentQR(Request $request)
    {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

        $orderInfo = "Thanh toán qua QR MoMo";
        $amount = $request->price;
        $orderId = time() . "";
        $redirectUrl = route('resultPayment');
        $ipnUrl = route('resultPayment');
        $extraData = "id=".$request->id_class;



        $requestId = time() . "";
        $requestType = "captureWallet";

        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
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
        $jsonResult = json_decode($result, true);  // decode json


        // return $jsonResult;
        return redirect($jsonResult['payUrl']);

    }

    function execPostRequest($url, $data)
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
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
}
