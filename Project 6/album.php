<!DOCTYPE html>
<html lang="en">
  <head>
   <style>
       .myclass {
  background-color: #0000FF;
  color: white;
  text-decoration: none;
  padding : 15px 65px
}
table{
   width: 15%;

}
tr{
   height: 50px;
}
.s{
   float: right;
   margin-top:60px;

}
img{
   border: 3px solid #000000;

}
   </style>
 
    <title>Photo Album </title>
    <meta charset="utf-8"/>
    
  </head>
  <body >
  
    <form action="" method="post" enctype="multipart/form-data">
        Select file to upload:
        <input type="file" name="file">
        <input type="submit" value="Upload file" name="submit">
    </form>

   </form>

<?php

$auth_token ='sl.BSs87SjAGOvVY2yMSIy4OJwZ9SCJji8v9w4oxrrPQXxIjga1tBFnXVtuo-7VqeAQAlrD3WwQuPzq3DdX9faD0JDfYhC9T3XO1uU-0J7OrYvXH8rMcyhHehVrvK4lQmGkj4fhCoUio6Kj';
include "dropbox.php";
$debug = true;

$use="";
error_reporting(E_ALL);
ini_set('display_errors','On');

createFolder("images");
if(isset($_POST['submit'])) {

   $name = $_FILES["file"]["name"];
   $file_path=$_FILES["file"]["tmp_name"];
   //echo "File path is $file_path/$name"."<br>";
   //move_uploaded_file($_FILES['file']['tmp_name'], "/Applications/XAMPP/xamppfiles/htdocs/project7/images/".$name);

   upload($name,"/images");
   

}

$result = listFolder("/images");
$myJSON = json_encode($result['entries']);
$de = json_decode($myJSON,true);

if($de){
echo "
<table border=1 style=margin-top:70px; >
   <caption><strong>Image List<strong></caption>
   <th>Links</th>
   <th>Delete</th>";
foreach($de as $item) { 
   $use = $item['name'];
   $url = $item['path_lower'];
   echo "<tr>";
   //echo "<td>" .$use."</td>";
   echo "<td> <a  href='album.php?display=".$use."'>".$use."</a></td>";
   echo "<td> <a class='myclass' href='album.php?delete=".$use."'>Delete</a></td>";
   echo "</tr>";
}
}
if(isset($_GET['display'])){
   download("/images/$use","tmp/$use");
   echo "<div class=s>"; 
   echo "<p><strong>Image Displayed</strong> </p>";
   echo "<img src=tmp/".$_GET['display']." width=120px height=120px>";
   echo "</div>"   ;
}

if(isset($_GET['delete'])){
   delete("/images/$use");
   //echo "<p>Image is successfully deleted from dropbox</p>";
   echo '<script>
                window.location.replace("http://localhost/project6/album.php");
           </script>';
    

}



   

   
   

 
   //upload("leonidas.jpg","/images");




// print the files in the Dropbox folder images
///$result = listFolder("/images");
//foreach ($result['entries'] as $x) {
   //echo $x['name'], "\n";
//}

// download a file from the Dropbox folder images into the local directory tmp
//download("/images/leonidas.jpg","tmp/tmp.jpg");

// delete a Dropbox file
//delete("/images/leonidas.jpg");

?>
</body>
</html>
