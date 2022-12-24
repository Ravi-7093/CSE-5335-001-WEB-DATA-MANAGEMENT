<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Find Restaurants on Yelp</title>
    <meta charset="utf-8"/>
    
  </head>
  <body >
    <form id="myform" action=" " method="GET">
       <label>City: <input type="text" id="city" name="city"/></label>
       <label>Enter Key Words: <input type="text" id="keywords"  name ="keywords" value=""/></label>
         <input type="submit"  value="Find"/>
         <input type="submit"  value="Reset"/>
    <div id="output">

        </div>
    </form>

    <?php
       session_start();
       $server="localhost";
       $username="root";
       $password=" ";
       $db="yelp";
       try {
             $dbh = new PDO("mysql:host=$server;port=3307;dbname=$db", $username,$db);
             echo "Connected";
             //$dbh->setAttribute(PD0::ATTR_ERRMODE, PD0::ERRMODE_EXCEPTION);
            //  foreach($dbh->query('SELECT * from favourites') as $row) {
            //     print_r($row,"Hello");
            //  }
            $dbh = null;
            } catch (PDOException $e) {
              print "Error!: " . $e->getMessage() . "<br/>";
              die();
             }

       if(isset( $_GET['store'])){
        //var_dump($_SESSION['favorites']);
        echo "<table border=1 style=margin-top:70px>
        <th>Name</th>
        <th>Image</th>
        <th>Rating</th>
        <th>Address</th>
        <th>Phone</th>";
        foreach($_SESSION['lstsearch'] as $restaurant) {
            echo "<tr>";
            echo "<td>" .$restaurant['name']."</td>";
            echo "<td> <a  href='get_yelp_data.php?store=".$restaurant['id']."'>
            <img src=".$restaurant['image_url']." width=80px height=80px></a></td>";
            //echo $restaurant['image_url'];
            echo "<td>" .$restaurant['rating']."</td>";
            $rest_add=$restaurant['location'];
            //echo $rest_add["address1"];
            echo "<td>" .$rest_add["address1"]."</td>";
            echo "<td>" .$restaurant['display_phone']."</td>";
            echo "</tr>";
            $_SESSION['search'][(string)$restaurant['id']]= array("name"=>(string)$restaurant['name'],"image"=>(string)$restaurant['image_url'],"rating"=>(string)$restaurant['rating'],"address"=>(string)$rest_add["address1"],"phone"=>$restaurant["display_phone"]);
            
        }
        $_SESSION['favorites'][$_GET['store']] =$_SESSION['search'][$_GET['store']];
        $res=($_SESSION['favorites']);
        var_dump($res);
        foreach ($res as $row) {
            echo $row;
            
        }
        //var_dump($res[0]);
        echo "<table border=1 style=margin-top:70px>
        <th>Name</th>
        <th>Image</th>
        <th>Rating</th>
        <th>Address</th>
        <th>Phone</th>";
        for ($i=0;$i<count($res);$i++){
       
        $image=$res[$i]['image'];
        $rating=$res[$i]['rating'];
        $address=$res[$i]['address'];
        $phone=$res[$i]['phone'];
        echo "<tr>";
        echo "<td>$name</td>";
        echo "<td> 
        <img src=$image width=80px height=80px></a></td>";
        //var_dump($res['name']);
        echo "<td>$rating</td>";
                //$rest_add=$restaurant['location'];
                //echo $rest_add["address1"];
        echo "<td>$address</td>";
        echo "<td>$phone</td>";
        echo "</tr>";
        }
       
        // foreach ($res as $r ) {
        // //     echo "<tr>";
        // //     echo "<td>$r</td>";
        // //     echo "<td> 
        // //     <img src=$r width=80px height=80px></a></td>";
        // //     //echo $restaurant['image_url'];
        // //     echo "<td>$r</td>";
        // //    // $rest_add=$restaurant['location'];
        // //     //echo $rest_add["address1"];
        // //     echo "<td> $r</td>";
        // //     echo "<td>$r</td>";
        // //     echo "</tr>";
        // //     break;
             
        // }
       
        
    }
    
        
        
        
        if(isset($_GET['keywords']) && isset($_GET['city'])){
            unset($_SESSION['search']);
            unset($_SESSION['store']);
        //var_dump();
        $API_KEY = 'adBFftFDgin8CKlU5PHNk7xDlsL_K-Xf5Tu5bahD-rPu8PZ-a8pMyp68mqRis9AXism98OugFEtgcSuywU2J4cyEVxmaNgmShES8trC3K6mLuipON8TUTHigcsI3Y3Yx';
        $API_HOST = "https://api.yelp.com";
        $SEARCH_PATH = "/v3/businesses/search";
        $BUSINESS_PATH = "/v3/businesses/";
        $mykeyword=$_GET["keywords"];
        $mycty =$_GET["city"];
        $arr_key= explode(" ",$mykeyword) ;
        $arr_mycty =explode(" ",$mycty);
        $curl = curl_init();
        if (FALSE === $curl)
            throw new Exception('Failed to initialize');
        $url = $API_HOST . $SEARCH_PATH . "?term=" .$arr_key[0]."+". $arr_key[1] . "&location=".$arr_mycty[0]."+". $arr_key[1] ."&limit=10" ;
        //echo $url;
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
        //print $response;
        if($response) {
            $_SESSION['keywords']=$mykeyword;
            $_SESSION['check_city']=$mycty;
            //echo $response;
            $my_json = json_decode($response, true);
            //var_dump(($my_json));
            $restaurants = $my_json['businesses'];
            $_SESSION['lstsearch'] = $my_json['businesses'];
            //var_dump(($_SESSION['search']));
           // echo $_SESSION['search'];
           $_SESSION['city']=$arr_mycty[0];
            echo "<table border=1 style=margin-top:70px>
            <th>Name</th>
            <th>Image</th>
            <th>Rating</th>
            <th>Address</th>
            <th>Phone</th>";
            foreach($_SESSION['lstsearch'] as $restaurant) {
                echo "<tr>";
                echo "<td>" .$restaurant['name']."</td>";
                echo "<td> <a  href='get_yelp_data.php?store=".$restaurant['id']."'>
                <img src=".$restaurant['image_url']." width=80px height=80px></a></td>";
                //echo $restaurant['image_url'];
                echo "<td>" .$restaurant['rating']."</td>";
                $rest_add=$restaurant['location'];
                //echo $rest_add["address1"];
                echo "<td>" .$rest_add["address1"]."</td>";
                echo "<td>" .$restaurant['display_phone']."</td>";
                echo "</tr>";
                $_SESSION['search'][(string)$restaurant['id']]= array("name"=>(string)$restaurant['name'],"image"=>(string)$restaurant['image_url'],"rating"=>(string)$restaurant['rating'],"address"=>(string)$rest_add["address1"],"phone"=>$restaurant["display_phone"]);
                
            }
            
          
            
        }
        
        
       
       
    }
    

        
       ?>
        
   
  </body>
</html>
