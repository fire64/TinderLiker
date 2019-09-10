<?php

ini_set("max_execution_time", 3600);
set_time_limit(3600);


ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

$fb_name = "Mister Twister";
$fb_id = 1234567890;
$fb_token  = "EAAGm0PX4ZCpsBANhTcrqvsyJ1oT6ZAPT6u3oySb4t9HcvqOfn5Oi7gZBcQJN0y0kCcjoQrQd1i4u0OiZA9yVrqV1BdDd7OkDoN74eZBh0FZA8L4fZA3E8LA1Pja1JY3IoocVN89mW1QZAUBZCiENrpqrpocgy5dZCbOsVHxUNFENBaMUyMs6AZB1UfZCWdG5ufxVr0ZCkhw95li3OkHypQGoPeAcfjdzdyQEMpxXr6tWBWPUX3nNwTawUMwS4MhnBmkZB4P0QZD";

$api_token = 'edea04eb-e031-4a28-b729-0fd27bec80c6';

$host = 'https://api.gotinder.com';

$is_debug = 1;


$ch = curl_init();

function CurlInit( )
{
    global $ch;
    
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array('app_version: ' . '6.9.4' ) ); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('platform: ' . 'ios' ) );
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('content-type: ' . 'application/json' ) );
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-agent: ' . 'Tinder/7.5.3 (iPhone; iOS 10.3.2; Scale/2.00)' ) );
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: ' . 'application/json' ) );

//  curl_setopt($ch, CURLOPT_PROXY, $proxy);    
}

function GetAuthToken( $facebook_id, $facebook_token )
{
    global $ch;
    global $host;
    global $is_debug;
    
    $result = array();
    $result['token'] = $facebook_token;
    $result['facebook_id'] = (int)$facebook_id;
    $vars = json_encode($result);

    $url = $host.'/v2/auth/login/facebook';

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$vars);  //Post Fields
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: ' . strlen($vars) ) ); 

    $server_output = curl_exec($ch);

    if($is_debug == 1)
    {
        echo( "URL: $url <br>" );
        echo( "Result:<br>" );
        echo($server_output);
        echo( "<br>" );
    }

    $array = json_decode( $server_output, true );
    
    $token = $array['data']['api_token'];

    return $token;
}

function GetFastMatchCount()
{
    global $ch;
    global $host; 
    global $is_debug;

    $url = $host.'/v2/fast-match/count'; 

    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET'); 

    $server_output = curl_exec($ch);    

    $array = json_decode( $server_output, true );
    
    if($is_debug == 1)
    {
        echo( "URL: $url <br>" );
        echo( "Result:<br>" );
        echo( "<br>" );
        RecursionArray($array);
    }
    
    return $array;   
}

//Get image jpeg
function GetFastMatchPreview()
{
    global $ch;
    global $host; 
    global $is_debug;

    $url = $host.'/v2/fast-match/preview'; 

    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET'); 

    $server_output = curl_exec($ch);    

    if($is_debug == 1)
    {
        echo( "URL: $url <br>" );
        echo( "Result:<br>" );
        echo($server_output);
        echo( "<br>" );
    }
    
    return $server_output;   
}

function GetMetaV2()
{
    global $ch;
    global $host; 
    global $is_debug;

    $url = $host.'/v2/meta'; 

    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET'); 

    $server_output = curl_exec($ch);    

    $array = json_decode( $server_output, true );
    
    if($is_debug == 1)
    {
        echo( "URL: $url <br>" );
        echo( "Result:<br>" );
        echo( "<br>" );
        RecursionArray($array);
    }
    
    return $array;   
}

function GetMetaV1()
{
    global $ch;
    global $host; 
    global $is_debug;

    $url = $host.'/meta'; 

    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET'); 

    $server_output = curl_exec($ch);    
    
    $array = json_decode( $server_output, true );
    
    if($is_debug == 1)
    {
        echo( "URL: $url <br>" );
        echo( "Result:<br>" );
        echo( "<br>" );
        RecursionArray($array);
    }
    
    return $array;   
}

function GetMyProfile()
{
    global $ch;
    global $host; 
    global $is_debug;

    $url = $host.'/profile'; 

    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET'); 

    $server_output = curl_exec($ch);    

    $array = json_decode( $server_output, true );
    
    if($is_debug == 1)
    {
        echo( "URL: $url <br>" );
        echo( "Result:<br>" );
        echo( "<br>" );
        RecursionArray($array);
    }
    
    return $array;   
}

function GetMyProfileV2()
{
    global $ch;
    global $host; 
    global $is_debug;

    $url = $host.'/v2/profile?include=account,boost,email_settings,instagram,likes,notifications,plus_control,products,purchase,spotify,super_likes,tinder_u,travel,tutorials,user'; 

    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET'); 

    $server_output = curl_exec($ch);    

    $array = json_decode( $server_output, true );
    
    if($is_debug == 1)
    {
        echo( "URL: $url <br>" );
        echo( "Result:<br>" );
        echo( "<br>" );
        RecursionArray($array);
    }
    
    return $array;   
}

function GetUpdates() //v1 deprecated, v2 unk???
{
    global $ch;
    global $host; 
    global $is_debug;

    $url = $host.'/updates';

    $args = array
    (
        "last_activity_date"=>""//"2015-10-30T09:32:41.154Z"
    );
    

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST'); 
    
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($args));

    $server_output = curl_exec($ch);    

    $array = json_decode( $server_output, true );
    
     if($is_debug == 1)
    {
        echo( "URL: $url <br>" );
        echo( "Result:<br>" );
        echo( "<br>" );
        RecursionArray($array);
    }
    
    return $array;   
}

function RecursionArray( $data, $space = 0, $isview = 0)
{
	foreach ($data as $key => $value) 
	{
		if(is_array($value) )
		{
			echo "<div style=\"margin-left:$space"."px\">Ключ: $key; - массив</div>";
			RecursionArray( $value, $space+40, 1);			
		}
		else
		{
			echo "<div style=\"margin-left:$space"."px\">Ключ: $key; Значение: $value</div>";			
		}
	}
}

$global_count = 0;

function GetMatchRecommendationsV1()
{
    global $ch;
    global $host; 
    global $is_debug;
    global $global_count;

    $url = $host.'/user/recs'; 

    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET'); 

    $server_output = curl_exec($ch);    

    $array = json_decode( $server_output, true );
    
/*
    if($is_debug == 1)
    {
        echo( "URL: $url <br>" );
        echo( "Result:<br>" );
        echo( "<br>" );
        RecursionArray($array);
    }
*/
    
    $count_profiles = count( $array['results'] );
    
    if( $count_profiles == 0 )
    {
        echo( "Нет новых аккаунтов" );
        die();
    }
    
    $global_count = $global_count + $count_profiles; 
    
    echo(  "Загржуенно: ".$count_profiles." аккаунтов<br>" );
    for( $i = 0; $i < $count_profiles; $i++ )
    {    
        // ждать 2 секунды
        usleep(500000);
        $user_id = $array['results'][$i]['_id'];
        $user_name = $array['results'][$i]['name'];
        $distance_mi = $array['results'][$i]['distance_mi'];
        
        $date = $array['results'][$i]['birth_date'];
        echo( "Лайк пользователя: $user_name дата рождения: $date расстояние: $distance_mi км.<br>" );
        LikeUserById( $user_id );
    }
   
        
    return $array;   
}

function GetMatchRecommendationsV2()
{
    global $ch;
    global $host; 
    global $is_debug;
    global $global_count;

    $url = $host.'/v2/recs/core'; 

    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET'); 

    $server_output = curl_exec($ch);    

    $array = json_decode( $server_output, true );
    
    // if($is_debug == 1)
    // {
        // echo( "URL: $url <br>" );
        // echo( "Result:<br>" );
        // echo( "<br>" );
        // RecursionArray($array);
    // }
    
    $res = $array['data']['results'];
    
    $count_profiles = count( $res );
    
    if( $count_profiles == 0 )
    {
        echo( "Нет новых аккаунтов Лайкнуто $global_count <br>" );
        die();
    }
    
    $global_count = $global_count + $count_profiles; 
    
    echo(  "Загржуенно: ".$count_profiles." аккаунтов<br>" );
    
    for( $i = 0; $i < $count_profiles; $i++ )
    {    
        $user_id = $res[$i]['user']['_id'];
        $user_name = $res[$i]['user']['name'];
        $distance_mi = $res[$i]['distance_mi'];
        
        $date = $res[$i]['user']['birth_date'];
        echo( "Лайк пользователя: $user_name дата рождения: $date расстояние: $distance_mi км.<br>" );
        LikeUserById( $user_id );
    }   

    
    return $array;   
}

function GetProfileById( $user_id )
{
    global $ch;
    global $host; 
    global $is_debug;

    $url = $host.'/user/'.$user_id; 

    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET'); 

    $server_output = curl_exec($ch);    
   
    $array = json_decode( $server_output, true );
    
    if($is_debug == 1)
    {
        echo( "URL: $url <br>" );
        echo( "Result:<br>" );
        echo( "<br>" );
        RecursionArray($array);
    }
        
    return $array;   
}

function LikeUserById( $user_id )
{
    global $ch;
    global $host; 
    global $is_debug;

    $url = $host.'/like/'.$user_id; 

    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET'); 

    $server_output = curl_exec($ch);    

    $array = json_decode( $server_output, true );
    
    if($is_debug == 1)
    {
//        echo( "URL: $url <br>" );
//        echo( "Result:<br>" );
//        echo( "<br>" );
//        RecursionArray($array);
    }
        
    return $array;   
}



function GetMatches()
{
    global $ch;
    global $host; 
    global $is_debug;

    $url = $host.'/v2/matches?count=60&locale=en&message=1'; 

    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET'); 

    $server_output = curl_exec($ch);    

    $array = json_decode( $server_output, true );
    
     if($is_debug == 1)
    {
        echo( "URL: $url <br>" );
        echo( "Result:<br>" );
        echo( "<br>" );
        RecursionArray($array);
    }
    
    return $array;   
}



CurlInit( );

//$api_token = GetAuthToken( $fb_id, $fb_token );

curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Auth-Token: ' . $api_token ) );

//GetFastMatchCount()
//GetFastMatchPreview();
//GetMetaV2();
//GetMetaV1();
//GetMyProfile();
//GetUpdates();
//GetMatchRecommendations();
//GetProfileById( '5771990c546ab388121e43f9' );
//LikeUserById( '5cd5d71945e9d91500bd29af' );

//for( $i = 0; $i < 200; $i++)
//{
//    GetMatchRecommendationsV2();
//}


GetMatches();

