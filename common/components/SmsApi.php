<?php

namespace common\components;

use Yii;
use backend\models\InfiSmsGatewayDetails; 
use backend\modules\dashboard\models\SentSms; 
/*
  @Usage :: Yii::$app->smsApi->functionName(param1,param2..)
 */

Class SmsApi extends \yii\base\Component {

    public static function getUrl() {  
        // Exotel URL
	//    $url = "https://" . Yii::$app->params['SMS_API_KEY']
 // . ":" . Yii::$app->params['SMS_API_TOKEN'] ."@api.exotel.in/v1/Accounts/" .Yii::$app->params['SMS_SID'] ."/Sms/send"; 
       $url = Yii::$app->params['FAST_API_URL']; 
       return $url;

    }
	
	
	
    /**
     * Auther: Panjab
     * 
     * Desc: Common function for call API
     * $data= ['To'=> '1234567890','Body'=> 'Message to be sent'], $module_type='API',$module_type_id=123
     */
    public static function getSmsApiResponseFast($data,$module_type,$module_type_id) {       
        if(!empty($data)){            
            $fields = array(
                "sender_id" => Yii::$app->params['FAST_SENDER_ID'],
                "message" => $data['Body'],
                "language" => "english",
                "route" => "p",
                "numbers" => $data['To'],
            );
            $headers = array(
                "authorization: ".Yii::$app->params['FAST_SMS_API_KEY'],
                "accept: */*",
                "cache-control: no-cache",
                "content-type: application/json"
              );
            // update the data in the sent_sms table    
            $smsModel = new SentSms();
            $smsModel->module_type = $module_type;
            $smsModel->status = 'Pending';
            $smsModel->module_id = $module_type_id;
            $smsModel->mobile_no = $data['To'];
            $smsModel->message_body = self::getMessageBodyClean($data['Body']);            
            $smsModel->save();

            $url = self::getUrl();            
            $curl = curl_init();        
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_ENCODING, "");
            //curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
            curl_setopt($curl, CURLOPT_TIMEOUT, 30);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);   
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);  
            curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($curl, CURLOPT_POSTFIELDS,json_encode($fields));
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($curl);        
            curl_close($curl);
            $arrResult = json_decode($result,true);
            // insert the data in the sms_gateway table
            $model = new InfiSmsGatewayDetails();
            $model->module_type = $module_type;
            $model->module_type_id = $module_type_id;
            $model->request = json_encode($fields);
            $model->response = $result;
            $model->created_at = date("Y-m-d H:i:s");
            $model->created_by =  Yii::$app->user->id;
            $model->save();
            // update the data in the sent_sms table            
            $smsModel->status = $arrResult['return'] ? "Sent" : "Failed";            
            $smsModel->sent_at = date("Y-m-d H:i:s");
            $smsModel->sent_by = Yii::$app->user->id;
            $smsModel->save();
            return $result;

        }
        return false;
    }


    /**
     * Auther: Panjab
     * 
     * Desc: Common function for call API
     * $data= ['To'=> '1234567890','Body'=> 'Message to be sent','API','123']
     */
    public static function getSmsApiResponse($data,$module_type,$module_type_id) {       
        if(!empty($data)){
            //print_r(Yii::$app->params);exit;
            $url = self::getUrl();
            $data['From'] = Yii::$app->params['SMS_SID'];
            $curl = curl_init();        
            curl_setopt($curl, CURLOPT_VERBOSE, 1);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_FAILONERROR, 0);
            curl_setopt($curl, CURLOPT_POSTFIELDS,http_build_query($data));
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);        
            $result = curl_exec($curl);        
            curl_close($curl);
            // insert the data in the sms_gateway table
            $model = new InfiSmsGatewayDetails();
            $model->module_type = $module_type;
            $model->module_type_id = $module_type_id;
            $model->request = json_encode($data);
            $model->response = json_encode($result);
            $model->created_at = date("Y-m-d H:i:s");
            $model->save();
            return json_encode($result);
        }
        return false;
    }

     public static function validateInputs($data){        
        $error = "";
        // replace special charachters other thn underscore and hyphen
        if(empty($data['message_body'])){            
            $error .= "Message Body is empty, please send valid message_body value. ";
        }
        if(empty($data['mobile_number']) && !preg_match("/^[6-9][0-9]{9}$/", $data['mobile_number'])){
            $error .= " Message Phone is either Empty or Invalid, please send valid Phone Number value.";
        }        
        if(!preg_match('/^[a-z ]+$/i', $data['name'])) {
            $error .= " Name missing or incorrect, please send valid Name";
        }     
        return $error;
     }


     public static function getMessageBodyClean($string) { 
        // ----- remove HTML TAGs ----- 
        $string = preg_replace ('/<[^>]*>/', ' ', $string); 
        // ----- remove control characters ----- 
        $string = str_replace("\r", '', $string);
        $string = str_replace("\n", ' ', $string);
        $string = str_replace("\t", ' ', $string);
        // ----- remove multiple spaces ----- 
        $string = trim(preg_replace('/ {2,}/', ' ', $string));
        // remove special characters as well
        $string = preg_replace('/[^A-Za-z0-9 -]/', '', $string);
        return $string;
    }


}