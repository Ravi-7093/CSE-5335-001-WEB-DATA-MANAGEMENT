<!DOCTYPE html>
<html lang="en">
 <?php
  // put your Yelp API key here:
  $API_KEY = 'adBFftFDgin8CKlU5PHNk7xDlsL_K-Xf5Tu5bahD-rPu8PZ-a8pMyp68mqRis9AXism98OugFEtgcSuywU2J4cyEVxmaNgmShES8trC3K6mLuipON8TUTHigcsI3Y3Yx';
  
  $API_HOST = "https://api.yelp.com";
  $SEARCH_PATH = "/v3/businesses/search";
  $BUSINESS_PATH = "/v3/businesses/";
  $mykeyword=$_GET["keywords"];
  $mycty =$_GET["city"];
  $arr_key= explode(" ",$mykeyword) ;
  $arr_mycty =explode(" ",$mycty);
  //echo $arr_key[0];
  //echo $arr_key[1];
  //$mycity=$_POST["city"];
  $curl = curl_init();
  if (FALSE === $curl)
     throw new Exception('Failed to initialize');
  $url = $API_HOST . $SEARCH_PATH . "?term=" .$arr_key[0]."+". $arr_key[1] . "&location=".$arr_mycty[0]."+". $arr_key[1] ."&limit=10" ;
  echo $url;
  curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,  // Capture response.
            CURLOPT_ENCODING => "",  // Accept gzip/deflate/whatever.
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer " . $GLOBALS['API_KEY'],
                "cache-control: no-cache",
            ),
        ));
  $response = curl_exec($curl);
  curl_close($curl);
  print $response;
?> 
Value : <?php echo $response?><br>
Subject : <?php echo $_POST["city"]?><br>
</html>