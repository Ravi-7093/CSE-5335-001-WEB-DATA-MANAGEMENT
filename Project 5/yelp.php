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
         <input type="submit" name='my_button' class="my_button"  value="Reset"/>
    <div id="output">

        </div>
    </form>

    <?php
       session_start();
       $server="localhost";
       $username="root";
       $password="1234";
       $db="yelp";
       try {
        $dbh = new PDO("mysql:host=$server;dbname=$db", $username,$password);
       } catch (PDOException $e) {
         print "Error!: " . $e->getMessage() . "<br/>";
         die();
        }

        if(array_key_exists('my_button', $_GET)){
            //echo "Hello";
            unset($_SESSION['lstsearch']);
            unset($_SESSION['search']);
            unset($_SESSION['favorites']);
            //session_destroy();
            echo $_SESSION['lstsearch'];
            echo '<script>
                window.location.replace("http://localhost/project5/yelp.php");
           </script>';
    
    
    
           }
       if(isset( $_GET['store'])){
        //var_dump($_SESSION['favorites']);
        echo "<table border=1 style=margin-top:70px>
           <caption><strong>Restaurant List<strong></caption>
            <th>Name</th>
            <th>Image</th>
            <th>Yelp Url</th>
            <th>Categories</th>
            <th>Price</th>
            <th>Rating</th>
            <th>Address</th>
            <th>Phone</th>";
        foreach($_SESSION['lstsearch'] as $restaurant) {
            echo "<tr>";
            echo "<td>" .$restaurant['name']."</td>";
            echo "<td> <a  href='yelp.php?store=".$restaurant['id']."'>
            <img src=".$restaurant['image_url']." width=80px height=80px></a></td>";
            //echo $restaurant['image_url'];
            echo "<td>" .$restaurant['url']."</td>";
            //echo $restaurant["categories"][0]["title"];
            echo"<td>" .$restaurant["categories"][0]["title"]."</td>";
            if(isset($restaurant['price'])){
                
                echo"<td>" .$restaurant["price"]."</td>";
            }
            else{
                $restaurant['price']="$";
                echo "<td>" .$restaurant['price']."</td>";

            }

       
            echo "<td>" .$restaurant['rating']."</td>";
            $rest_add=$restaurant['location'];
            //echo $rest_add["address1"];
            echo "<td>" .$rest_add["address1"]."</td>";
            echo "<td>" .$restaurant['display_phone']."</td>";
            echo "</tr>";
            //$_SESSION['search'][(string)$restaurant['id']]= array("name"=>(string)$restaurant['name'],"image"=>(string)$restaurant['image_url'],"rating"=>(string)$restaurant['rating'],"address"=>(string)$rest_add["address1"],"phone"=>$restaurant["display_phone"]);
            
        }
        $_SESSION['favorites'][$_GET['store']] =$_SESSION['search'][$_GET['store']];
        $res=($_SESSION['favorites']);
        //var_dump($res);

        

           for ($i=0;$i<count($res);$i++) {
              $id=$_GET['store'];
              //echo $id;
              $nam=$res[$_GET['store']]['name'];
              $image=$res[$_GET['store']]['image'];
              $url=$res[$_GET['store']]['url'];
              $categories=$res[$_GET['store']]['categories'];
              $price=$res[$_GET['store']]['price'];
              $rating=$res[$_GET['store']]['rating'];
              $address=$res[$_GET['store']]['address'];
              $phone=$res[$_GET['store']]['phone'];
              $stmt = $dbh->prepare('select * from favorites');
              $stmt->execute();
              while ($row = $stmt->fetch()) {

                 if ($row[0]==$_GET['store']){
                       continue;
                 }
                 else{
                      $dbh->beginTransaction();
                      $sql="insert into  favorites (id,name,image_url,yelp_page_url,categories,price,rating,address,phone)
                      VALUES ('$id', '$nam','$image','$url' ,'$categories', '$price', '$rating','$address', '$phone')";
                      //echo $sql;
                      $dbh->exec($sql);
                      $dbh->commit();
                      //echo " Value inserted";
                      

                 }
                 
               }
               //$stmt->close();
           }
           echo "<table border=1 style=margin-top:70px>
           <caption><strong>Favorites<strong></caption>

            <th>Name</th>
            <th>Image</th>
            <th>Yelp Url</th>
            <th>Categories</th>
            <th>Price</th>
            <th>Rating</th>
            <th>Address</th>
            <th>Phone</th>";
            $stmt = $dbh->prepare('select * from favorites');
            $stmt->execute();
            while ($row = $stmt->fetch()) {

              
                echo "<tr>";
                echo "<td>" .$row['name']."</td>";
                echo "<td> 
                <img src=".$row['image_url']." width=80px height=80px></a></td>";
                //echo $restaurant['image_url'];
                echo "<td>" .$row['yelp_page_url']."</td>";
                //echo $restaurant["categories"][0]["title"];
                echo"<td>" .$row["categories"]."</td>";
                echo "<td>" .$row['price']."</td>";
                echo "<td>" .$row['rating']."</td>";
//$rest_add=$restaurant['location'];
                //echo $rest_add["address1"];
                echo "<td>" .$row["address"]."</td>";
                echo "<td>" .$row['phone']."</td>";
               

                echo "</tr>";



            }
       
    }
    
        
        
        
        if(isset($_GET['keywords']) && isset($_GET['city'])){
            unset($_SESSION['search']);
            unset($_SESSION['store']);
            unset($_SESSION['favorites']);
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
            //var_dump(($_SESSION['lstsearch']));
           // echo $_SESSION['search'];
           $_SESSION['city']=$arr_mycty[0];
            echo "<table border=1 style=margin-top:70px>
            <caption><strong>Restaurant List<strong></caption>
            <th>Name</th>
            <th>Image</th>
            <th>Yelp Url</th>
            <th>Categories</th>
            <th>Price</th>
            <th>Rating</th>
            <th>Address</th>
            <th>Phone</th>";
            foreach($_SESSION['lstsearch'] as $restaurant) {
                echo "<tr>";
                echo "<td>" .$restaurant['name']."</td>";
                echo "<td> <a  href='yelp.php?store=".$restaurant['id']."'>
                <img src=".$restaurant['image_url']." width=80px height=80px></a></td>";
                //echo $restaurant['image_url'];
                echo "<td>" .$restaurant['url']."</td>";
                //echo $restaurant["categories"][0]["title"];
                echo"<td>" .$restaurant["categories"][0]["title"]."</td>";
                if(isset($restaurant['price'])){
                    
                    echo"<td>" .$restaurant["price"]."</td>";
                }
                else{
                    $restaurant['price']="$";
                    echo "<td>" .$restaurant['price']."</td>";

                }

           
                echo "<td>" .$restaurant['rating']."</td>";
                $rest_add=$restaurant['location'];
                //echo $rest_add["address1"];
                echo "<td>" .$rest_add["address1"]."</td>";
                echo "<td>" .$restaurant['display_phone']."</td>";
                echo "</tr>";
                $_SESSION['search'][(string)$restaurant['id']]= array("name"=>(string)$restaurant['name'],"image"=>(string)$restaurant['image_url'],"rating"=>(string)$restaurant['rating'],"address"=>(string)$rest_add["address1"],"phone"=>$restaurant["display_phone"],"url"=>$restaurant["url"],"categories"=>$restaurant["categories"][0]["title"],"price"=>$restaurant['price']);
                
            }
            
          
            
        }
        
        
       
       
    }
    

        
       ?>
        
   
  </body>
</html>
