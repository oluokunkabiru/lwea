<?php
        // include("header.php");
   $server = "localhost";
   $user = "root";
   $password = "";
   $dbname = "lwea";
   $church= mysqli_connect($server,$user,$password,$dbname);



        $error = [];
        function test_input($data) 
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            $data = str_replace("'", "&apos;", $data);
            return $data;
        }

        if(isset($_POST['testimony'])){
            if(empty($_POST['name'])){
                $error['name'] = "Please provide your fullname";
            }
            if (!preg_match("/^[a-zA-Z ]*$/",$_POST['name'])) {
                $error['name'] = "Only letters and white space allowed";
              }

              if(strlen(trim($_POST['testimony'])) < 10){
                $error['testimony'] = "Please write your full testimony";
            }

           

            if ($_FILES["InputFile"]["size"] > 0) {
                 $target_dir = "testimonies/";
                    if(!is_dir($target_dir)){
                        mkdir($target_dir);
                    }
                $target_file = $target_dir . time(). basename($_FILES["InputFile"]["name"]);
                // echo $target_file;
                $check = getimagesize($_FILES["InputFile"]["tmp_name"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                if($check == false) {
                       $error['image']= "File is not an image.";
                  } 
                  elseif ($_FILES["InputFile"]["size"] > 5000000) {
                    $error['image']= "Sorry, your file is too large.";
                }
                elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
                  $error['image']= "Sorry, only JPG, JPEG & PNG  files are allowed.";
                  }
                  elseif (count($error)==0) {
                    move_uploaded_file($_FILES["InputFile"]["tmp_name"], $target_file);
                } else{
                  $error['image']="Please fill the required areas above";
                }
            }
foreach ($error as $value) {
    # code...
    echo "$value<br>";
}
                $result = json_encode($error);
                if(count($error) > 0){
                    echo $result;
                }

                if(count($error)==0){
                    $name = test_input($_POST['name']);
                    $image = isset($target_file)?$target_file:"";
                    $testimony = test_input($_POST['testimony']);
                    $status = "disabled";
                    $q = mysqli_query($church, "INSERT INTO testimony (name, status, picture, testimony) VALUES('$name', '$status', '$image', '$testimony')");
                    if($q){
                        $error['success'] = "Thanks your testimony have recorded";
                        echo json_encode($error);
                    }else{
                         $error['fail'] = "Fail to add testimony due to serve error, please try again later ". mysqli_error($church);
                         echo json_encode($error);
                    }
                }
            


        }

?>