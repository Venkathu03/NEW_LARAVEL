<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Payment;
use Session;
use App\Models\Student;

class RazorpayController extends Controller
{
    public function index(){
        return view('payment');
    }
    public function store(Request $request) {
                $input = $request->all();
                $api = new Api (env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
                $payment = $api->payment->fetch($input['razorpay_payment_id']);
                if(count($input) && !empty($input['razorpay_payment_id'])) {
                    try {
                        $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
                        $payment = Payment::create([
                            'r_payment_id' => $response['id'],
                            'method' => $response['method'],
                            'currency' => $response['currency'],
                            'user_email' => $response['email'],
                            'amount' => $response['amount']/100,
                            "student_id"=>auth('student')->user()->id,
                            "payment_status"=>$response['status'],
                            'json_response' => json_encode((array)$response)
                        ]);
                        if($payment){
                            $student = Student::find(auth('student')->user()->id);
                            $student->is_payment_done ="yes";     
                            $student->is_approved ="yes";
                            $student->save();
                        }
                    } catch(Exceptio $e) {
                        return $e->getMessage();
                        Session::put('error',$e->getMessage());
                        return redirect()->back();
                    }
                }
        Session::put('payment-success',('Payment Successful'));
        return redirect('student/payment-success');
    }
}
