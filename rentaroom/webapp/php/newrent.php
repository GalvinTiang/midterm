<?php
    if(isset($_POST["submit"])){
        include_once("../dbconnect.php");
        $contact=$_POST["contact"];
        $title=$_POST["title"];
        $description=$_POST["description"];
        $price=$_POST["price"];
        $deposit=$_POST["deposit"];
        $state=$_POST["state"];
        $area=$_POST["area"];
        $latitude=$_POST["latitude"];
        $longitude=$_POST["longitude"];
        $sqlregister = "INSERT INTO `tbl_room` (`contact`, `title`, `description`,
        `price`, `deposit`, `state`, `area`, `latitude`, `longitude`) VALUES ('$contact', '$title', '$description',
        '$price', '$deposit', '$state', '$area', '$latitude',
        '$longitude')";
        try{
            $conn->exec($sqlregister);
            if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])){
                uploadImage($contact);
                echo "<script>alert('Registration successful')</script>";
                echo "<script>window.location.replace('mainpage.php')</script>";
            }    
            
        }catch (PDOException $e) {
                echo"<script>alert('Registration failed')</script>";
                echo "<script>window.location.replace('newrent.php')</script>";
            }
    }

        function uploadImage($id){
            $target_dir = "../res/images/";
            $target_file = $target_dir . $id . ".png";
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        }
    
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-aswsome.min.css">
    <link rel="stylesheet" href="../style/style.css">
    <script src="../javascript/script.js"></script>
    <title>Customer Details</title>
</head>

<body>
    <div class="w3-header w3-display-container w3-cyan w3-padding-32 w3-center">
        <h1 style="font-size:calc(8px+4vw);">Rental Details<strong></h1>
        <p style="font-size:calc(8px+1vw);">Ideal Room For Your Ideal Life!</p>
    </div>

    <div class="w3-bar w3-light-blue">
        <a href="newcustomer.php" class="w3-bar-item w3-button w3-left">Home</a>
    </div> 
    
    <div class="w3-container w3-padding-64 form-container">
        <div class="w3-card">
            <div class="w3-container w3-cyan">
                <p>New Room Registration</p>
            </div>
            <form class="w3-container w3-padding " name="registerForm" action="newrent.php" method="post" onsubmit="return confirmDialog()" enctype="multipart/form-data">
                <div class="w3-container w3-border w3-center w3-padding">
                    <img class="w3-image w3-round w3-margin"
                    src="../res/images/profile.png" style="width:100%;
                    max-width:600px"><br>
                    <input type="file" onchange="previewFile()" name="fileToUpload"
                    id="fileToUpload"><br>
                </div>
                <p>
                    <label>Contact</label>
                    <input class="w3-input w3-border w3-round" name="contact" id="idcontact"
                    type="phone" required>
                </p>

                <p>
                    <label>Title</label>
                    <input class="w3-input w3-border w3-round" name="title" id="idtitle"
                    type="text" required>
                </p>

                <p>
                    <label>Description</label>
                    <input class="w3-input w3-border w3-round" name="description" id="iddescription"
                    type="text" required>
                </p>

                <p>
                    <label>Price</label>
                    <input class="w3-input w3-border w3-round" name="price" id="idprice"
                    type="text" required>
                </p>

                <p>
                    <label>Deposit</label>
                    <input class="w3-input w3-border w3-round" name="deposit" id="iddeposit"
                    type="text" required>
                </p>

                <p>
                    <label>State</label>
                    <input class="w3-input w3-border w3-round" name="state" id="idstate"
                    type="text" required>
                </p>

                <p>
                    <label>Area</label>
                    <input class="w3-input w3-border w3-round" name="area" id="idarea"
                    type="text" required>
                </p>

                <p>
                    <label>Latitude</label>
                    <input class="w3-input w3-border w3-round" name="latitude" id="idlatitude"
                    type="text" required>
                </p>

                <p>
                    <label>Longitude</label>
                    <input class="w3-input w3-border w3-round" name="longitude" id="idlongitude"
                    type="text" required>
                </p>

                <div class="row">
                    <input class="w3-input w3-border w3-block w3-cyan w3-round" type="submit" 
                    name="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>

    <footer class="w3-footer w3-center w3-light-blue">
        <p>RentARoom</p>
    </footer>
</body>