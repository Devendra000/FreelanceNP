<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\giver;
use App\Models\task;
class paymentController extends Controller
{
    public function showPaymentForm()
    {
        return view('receivers/payment');
    }

    public function openKhalti(Request $request, $id, $user_id){
        $curl = curl_init();

        $user = giver::find($user_id);
        $task = task::find($id);
            $data = array(
                'return_url' => route('success'),
                'website_url' => 'https://example.com/',
                'amount' => $task->pod*100, //Rs to Paisa
                'purchase_order_id' => $task->task_id,
                'purchase_order_name' => $task->name,
                'customer_info' => array(
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => '9800000001'
                )
            );
            
            $curlSet = array(
                CURLOPT_URL => 'https://a.khalti.com/api/v2/epayment/initiate/',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2_0,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Key dff9f908535246cda9e6ef9049426d71',
                    'Content-Type: application/json',
                ),
                CURLOPT_SSL_VERIFYPEER => false,  // Disable SSL verification (for testing only)
            );

            curl_setopt_array($curl, $curlSet);

            $response = curl_exec($curl);
        
            curl_close($curl);
    
            if($response === false){
                echo 'Curl error:' . curl_error($curl);
            }
            else{
                $responseData = json_decode($response, true);
                // Check if the payment_url is present in the response
                session()->id = $id;
                session()->user_id = $user_id;
                if (isset($responseData['payment_url'])) {
                    
                    header('Location:' . $responseData['payment_url']);
                    exit;
                }
                else{
                    echo 'Invalid response from Khalti API '. $response;
                }
            }
    }        

    function verify(Request $request){
        
        $curl = curl_init();
        
        $url = url()->full();
        $urlParts = parse_url($url);

        $queryParams = [];

        parse_str($urlParts['query'] ?? '', $queryParams);
        $pidx = isset($queryParams['pidx']) ? $queryParams['pidx'] : null;
        print_r($queryParams);
        $purchase_order_id = isset($queryParams['purchase_order_id']) ? $queryParams['purchase_order_id'] : null;

        $task = task::find($purchase_order_id);
        $task->pidx = $pidx;
        $task->paid = 1;
        $task->save();
    
        if($pidx){
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://a.khalti.com/api/v2/epayment/lookup/',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2_0,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($pidx),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Key dff9f908535246cda9e6ef9049426d71',
                    'Content-Type: application/json',
                ),
                CURLOPT_SSL_VERIFYPEER => false,  // Disable SSL verification (for testing only)
            ));
        
            $response = curl_exec($curl);
        
            curl_close($curl);
        
            if($response === false){
                echo 'Curl error:' . curl_error($curl);
            }
            else{
                $responseData = json_decode($response, true);
                header('Location:'. url()->previous());
                exit;
            }
        }
        else{
            echo('No pidx');
            die;
        }   
    }
}