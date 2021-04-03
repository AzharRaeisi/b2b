<?php
use App\Models\Generalsetting;
use App\Models\User;

function check_folder($folder = '') {

    if( !file_exists($folder) ){

        if(!mkdir($folder, 0777, true) ){
            return false;
        }
    }
    return true;
}
function debug($data,$exit=0){
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    if($exit){
        exit;
    }
}
function getRealIpAddr(){
    if (!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }else {
        $ip=$_SERVER['REMOTE_ADDR'];
    }
    if($ip == '::1' || $ip == '127.0.0.1'){
        return '103.17.202.134';
    }
    return $ip;
}
function cleanString($string) {
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
function makeSecondLevelValueToParentIndex($array,$field,$multiData=true,$strtolower=false){
    $returnArr = [];
    if(sizeof($array) > 0){
        foreach($array as $key=>$value){
            $value = (array)$value;
            if(isset($value[$field])){
                if($strtolower == true){
                    $value[$field] = strtolower($value[$field]);
                }
                if($multiData){
                    $returnArr[$value[$field]][] = $value;
                }else{
                    $returnArr[$value[$field]] = $value;
                }
            }else{
                if($strtolower == true){
                    $key = strtolower($key);
                }
                if($multiData){
                    $returnArr[$key][] = $value;
                }else{
                    $returnArr[$key] = $value;
                }


            }
        }
    }
    return $returnArr;
}
function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }
    return false;
}
function replace_null_with_empty_string($array){
    //debug($array,1);
    $integer_fields = ['to','from','last_page','per_page'];
    foreach ($array as $key => $value)
    {
        if(is_array($value)){
            $array[$key] = replace_null_with_empty_string($value);
        }else{
            if (is_null($value)){
                //echo $key;exit;
                if(in_array($key,$integer_fields)){
                    $array[$key] = 0;
                }else{
                    $array[$key] = "";
                }
            }
        }
    }
    return $array;
}
function _encode($str)
{
    $str = base64_encode(base64_encode($str));
    return $str;
}
function _decode($str){
    return base64_decode(base64_decode($str));
}
function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {
                case "location":
                    $output = array(
                        "city"           => @$ipdat->geoplugin_city,
                        "state"          => @$ipdat->geoplugin_regionName,
                        "country"        => @$ipdat->geoplugin_countryName,
                        "country_code"   => @$ipdat->geoplugin_countryCode,
                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                        "continent_code" => @$ipdat->geoplugin_continentCode
                    );
                    break;
                case "address":
                    $address = array($ipdat->geoplugin_countryName);
                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
                        $address[] = $ipdat->geoplugin_regionName;
                    if (@strlen($ipdat->geoplugin_city) >= 1)
                        $address[] = $ipdat->geoplugin_city;
                    $output = implode(", ", array_reverse($address));
                    break;
                case "city":
                    $output = @$ipdat->geoplugin_city;
                    break;
                case "state":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "region":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "country":
                    $output = @$ipdat->geoplugin_countryName;
                    break;
                case "countrycode":
                    $output = @$ipdat->geoplugin_countryCode;
                    break;
            }
        }
    }
    return $output;
}
function summary($str, $limit=100, $strip = false) {
    $str = ($strip == true)?strip_tags($str):$str;
    if (strlen ($str) > $limit) {
        $str = substr ($str, 0, $limit - 3);
        return (substr ($str, 0, strrpos ($str, ' ')).'...');
    }
    return trim($str);
}
function generateCaptcha(){
    $actual_path = public_path().'/';

    $image = imagecreatetruecolor(200, 50);
    $background_color = imagecolorallocate($image, 224, 224, 224);
    imagefilledrectangle($image,0,0,200,50,$background_color);

    $pixel = imagecolorallocate($image, 224,224,224);
    for($i=0;$i<500;$i++) {
        imagesetpixel($image,rand()%200,rand()%50,$pixel);
    }

    $font = $actual_path.'assets/front/fonts/NotoSans-Bold.ttf';
    $allowed_letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $length = strlen($allowed_letters);
    $letter = $allowed_letters[rand(0, $length-1)];
    $word='';
    //$text_color = imagecolorallocate($image, 8, 186, 239);
    $text_color = imagecolorallocate($image, 0, 0, 0);
    $cap_length=6;// No. of character in image
    for ($i = 0; $i< $cap_length;$i++)
    {
        $letter = $allowed_letters[rand(0, $length-1)];
        imagettftext($image, 25, 1, 35+($i*25), 35, $text_color, $font, $letter);
        $word.=$letter;
    }
    $pixels = imagecolorallocate($image, 224, 224, 224);
    for($i=0;$i<500;$i++)
    {
        imagesetpixel($image,rand()%200,rand()%50,$pixels);
    }
    session(['captcha_string' => $word]);
    imagepng($image, $actual_path."assets/images/capcha_code.png");
    return true;
}
function slugify($string){
    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string), '-'));
}
function slugify2($string){
    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '', $string), '-'));
}
function calculatePriceByQty($price, $whole_sell_qty=[], $whole_sell_discount=[], $qty){

    if(!empty($whole_sell_qty) && !empty($whole_sell_discount) && count($whole_sell_qty) == count($whole_sell_discount)){
        foreach ($whole_sell_qty as $key=>$whole_sell_qty_range){
            $whole_sell_qty_range = explode('-',$whole_sell_qty_range);
            if(count($whole_sell_qty_range) == 2 && isset($whole_sell_qty_range[0]) && isset($whole_sell_qty_range[1])){
                if($qty >= $whole_sell_qty_range[0] && $qty <= $whole_sell_qty_range[1]){
                    return $whole_sell_discount[$key];
                    break;
                }
            }
            if(count($whole_sell_qty_range) == 1){
                if(substr($whole_sell_qty_range[0], -1) == '+'){
                    if($qty >= str_replace('+','',$whole_sell_qty_range[0])){
                        return $whole_sell_discount[$key];
                        break;
                    }
                }else{
                    if($qty == $whole_sell_qty_range[0]){
                        return $whole_sell_discount[$key];
                        break;
                    }
                }
            }
        }
    }
    return $price;
}

function buildResponse($type=null,$message='',$data=[]){
    $type = ($type == 'success') ? '200' : '400';
    $data['message'] = $message;
    $data['status'] = $type;
    $data = replace_null_with_empty_string($data);
    return response()->json(array_reverse($data));
}
function getLoginUserInfo($user_id=0,$force_query=false){
    if(Auth::check() && $user_id == Auth::user()->id && $force_query == false){
        $user_info = Auth::user()->toArray();
    }else{

        $user_find = User::find($user_id);
        if(!empty($user_find)){
            $user_info = $user_find->toArray();
        }
    }
    $gs = Generalsetting::findOrFail(1);
    $user_info['image'] = !empty($user_find['photo']) ? asset('assets/images/users/'.$user_find['photo']):asset('assets/images/'.$gs->user_image);
    return $user_info;
}
function buildValidationErrors($errorsBag){
    if(!empty($errorsBag)){
        $errorsBag = $errorsBag->toarray();
    }
    $responseErrors = [];
    foreach ($errorsBag as $errors){
        foreach ($errors as $error){
            $responseErrors[] = $error;
        }
    }
    return $responseErrors;
}
function productApiResponse($product){
    $data = [];
    $data['id'] = $product->id;
    $data['rating'] = $product->rating;
    $data['slug'] = $product->slug;
    $data['thumbnail'] = !empty($product->thumbnail)?asset('assets/images/thumbnails/'.$product->thumbnail):asset('assets/images/noimage.png');
    $data['title'] = $product->showName();
    $data['price'] = $product->showPriceApi(false);
    $data['previous_price'] = $product->showPreviousPriceApi(false);

    return $data;
}