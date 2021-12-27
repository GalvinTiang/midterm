<?php
    include_once("../dbconnect.php");
    if(isset($_GET["button"])){
        $op=$_GET["button"];
        $option=$_GET["option"];
        $search=$_GET["search"];
        if ($op == 'search'){
            if ($option == 'title'){
                $sqlroom = "SELECT * FROM tbl_room WHERE title LIKE '%$search%'";          
            }
            if ($option == 'state'){
                $sqlroom = "SELECT * FROM tbl_room WHERE state LIKE '%$search%'";           
            }
        }
    }else {
        $sqlroom = "SELECT * FROM tbl_room ORDER BY datecreated DESC";
    }
    
    $stmt = $conn->prepare($sqlroom);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $rows = $stmt->fetchAll();
    
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-aswsome.min.css">
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    <script src="../javascript/script.js"></script>
    <title>Main page</title>
</head>

<body>
    <div class="w3-header w3-display-container w3-cyan w3-padding-32 w3-center">
        <h1 style="font-size:calc(8px+4vw);"><strong>RentARoom</h1>
        <p style="font-size:calc(8px+1vw);">Find your ideal room!!!</p>
    </div>

    <div class="w3-bar w3-light-blue">
        <a href="#contact" class="w3-bar-item w3-button w3-right">Logout</a>
        <a href="newrent.php" class="w3-bar-item w3-button w3-left">New Room</a>
    </div>
    
    <div class="w3-card w3-container w3-padding w3-margin w3-round">
        <h4>Room Search</h4>
        <form action="mainpage.php">
            <div class="w3-row">
                <div class="w3-half w3-container">
                    <p><input class="w3-input w3-block w3-round w3-border" type="search"
                    id="idsearch" name="search" placeholder="Enter search term"/></p>
                </div>
                <div class="w3-half w3-container">
                    <p><select class="w3-input w3-block w3-round w3-border" name="option"
                    id="srcid">
                    <option value="id">By ID</option>
                    <option value="state">By State</option>
                    <option value="today">Today</option>
                    </select><p>
                </div>
            </div>
            <div class="w3-container">
                <p><button class="w3-button w3-blue w3-round w3-right" type="submit"
                name="button" value="search">search</button></p>
            </div>   
        </form>
    </div>

    <div class="w3-grid-template">
        <?php
            foreach ($rows as $room){
                $id = $room['id'];
                $title = $room['title'];
                $contact = $room['contact'];
                $price = $room['price'];
                $state = $room['state'];
                $area = $room['area'];
                echo "<div class='w3-center w3-padding'>";
                echo "<div class='w3-card-4 w3-dark-grey'>";
                echo "<header class='w3-container w3-blue'>";
                echo "<h5>$title</h5>";
                echo "</header>";
                echo "<img class='w3-image' src=../res/images/$contact.png" .
                " onerror=this.onerro=null; this.src='../res/images/users/profile.png'"
                . "style='width:100%; height:250px'>";
                echo "<div class='w3-container w3-left-align'><hr>";
                echo "<p><i class='fa fa-id-card' style='font-size:16px'></i>
                &nbsp&nbsp$title<br>
                <i class='fa fa-phone' style='font-size:16px'></i>
                &nbsp&nbsp$contact<br>
                <i class='fa fa-money-bill' style='font-size:16px'></i>
                &nbsp&nbsp$price<br>
                <i class='fa fa-search-location' style='font-size:16px'></i>
                &nbsp&nbsp$area $state<br>
                </p><hr>";

                echo "</div>";
                echo "</div>";
                echo "</div>";
             }
        ?>
    </div> 
 

    <footer class="w3-footer w3-center w3-cyan">
        <p>RentARoom</p>
    </footer>
</body>