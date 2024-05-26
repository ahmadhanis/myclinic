<?php
session_start();
if (!isset($_SESSION["email"]) && !isset($_SESSION["password"])) {
    echo "<script>alert('Please Login')</script>";
    echo "<script>window.location.href = 'login.php'</script>";
}
include('dbconnect.php');

if (isset($_GET['submit'])) {
    $operation = $_GET['submit'];
    if ($operation == "delete") {
        $id = $_GET['id'];
        try{
            $sqldeletepatient = "DELETE FROM `tbl_patients` WHERE `patient_id` = '$id'";
            $conn->query($sqldeletepatient);
            echo "<script>alert('Deleted..')</script>";
            echo "<script>window.location.href = 'index.php'</script>";
        }catch (PDOException $e) {
            echo "<script>alert('Failed')</script>";
            // echo $e->getMessage();
        }
    }  
}

if (isset($_GET['button'])) {
    $operation = $_GET['button'];
    if ($operation == 'search') {
        $search = $_GET['search'];
        $option = $_GET['option'];
        if ($option =='name'){
            $sqlloadpatients = "SELECT * FROM `tbl_patients` WHERE `patient_name` LIKE '%$search%'";
        }
        if ($option =='ic'){
            $sqlloadpatients = "SELECT * FROM `tbl_patients` WHERE `patient_ic` LIKE '%$search%'";
        }    
    }
}else{
    $sqlloadpatients = "SELECT * FROM `tbl_patients`";
}

$results_per_page = 15;
if (isset($_GET['pageno'])) {
    $pageno = (int)$_GET['pageno'];
    $page_first_result = ($pageno - 1) * $results_per_page;
} else {
    $pageno = 1;
    $page_first_result = 0;
}

$stmt = $conn->prepare($sqlloadpatients);
$stmt->execute();
$number_of_result = $stmt->rowCount();
$number_of_page = ceil($number_of_result / $results_per_page);

$sqlloadpatients = $sqlloadpatients . " LIMIT $page_first_result , $results_per_page";
$stmt = $conn->prepare($sqlloadpatients);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-  
     awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/mystyle.css">
    <title>My Clinic</title>

</head>

<body>
    <div class="w3-header w3-container w3-teal w3-padding-28 w3-center">
        <h1 style="font-size:calc(8px + 4vw);">MYCLINIC</h1>
        <p style="font-size:calc(8px + 1vw);;">We serve the people</p>
    </div>
    <div class="w3-bar w3-blue-gray">
        <a href="logout.php" class="w3-bar-item w3-button w3-right">Logout</a>
        <a href="newpatient.php" class="w3-bar-item w3-button w3-left">New Patient</a>
        <a href="" class="w3-bar-item w3-button w3-left"
            onclick="document.getElementById('id01').style.display='block';return false;">About</a>
    </div>
    <div style="min-height:100vh;overflow-y: auto;">
        <div class="w3-container w3-padding w3-hide-small">
            <div class="w3-card w3-container w3-padding w3-margin w3-round">
                <h4>Patient Search</h4>
                <form action="index.php">
                    <div class="w3-row">
                        <div class="w3-container w3-half">
                            <input class="w3-input w3-block w3-round w3-border" type="search" id="idsearch"
                                name="search" placeholder="Enter search term" />
                        </div>
                        <div class="w3-container w3-half">
                            <select class="w3-input w3-block w3-round w3-border" name="option" id="srcid">
                                <option value="name">By Name</option>
                                <option value="ic">By IC</option>
                            </select>
                            <p>
                        </div>
                        <div class="w3-container">
                            <button class="w3-button w3-teal w3-round w3-right" type="submit" name="button"
                                value="search">search</button>
                        </div>
                    </div>
                </form>
            </div>

            <?php
                if ($number_of_result > 0){
                    echo " <table class='w3-table w3-striped'>
                    <tr>
                        <th>Patient ID</th>
                        <th>Patient IC</th>
                        <th>Patient Email</th>
                        <th>Patient Name</th>
                        <th>Patient Phone</th>
                        <th>Operations</th>
                    </tr>";
                    $i = 0;
                    foreach ($rows as $patients) {
                        $patientId = $patients['patient_id'];
                        $patientIc = $patients['patient_ic'];
                        $patientEmail = $patients['patient_email'];
                        $patientName = $patients['patient_name'];
                        $patientPhone = $patients['patient_phone'];
                        $patientAddress = $patients['patient_address'];
                        $patientDateReg = date_format(date_create($patients['patient_date_reg']),"d/m/Y H:i a");
                        echo "<tr><td>$patientId</td><td>$patientIc</td><td>$patientEmail</td><td>$patientName</td><td>$patientPhone</td>";
                        echo "<td><a href='index.php?submit=delete&id=$patientId' onclick=\"return confirm('Are you sure?')\"><button>Delete</button></a>&nbsp";
                        echo "<a href='editpatient.php?id=$patientId'><button>&nbsp;Edit&nbsp;&nbsp;&nbsp; </button></a>&nbsp";
                        echo "<a href='' onclick=\"document.getElementById('id0$i').style.display='block';return false;\"><button>Details</button></a></td></tr>";
                        // dynamic modal windows
                        echo "<div class='w3-modal' id='id0$i'>
    <div class='w3-modal-content w3-animate-opacity' style='min-width:40%'>
        <header class='w3-container w3-teal w3-center'>
            <p>$patientName</p>
            <span onclick=\"document.getElementById('id0$i').style.display='none'\" class=\"w3-button w3-display-topright\">&times;</span>
        </header>
        <div class='w3-card w3-container w3-center'>
            <div class='w3-container w3-row'>
                <div class='w3-half'>
                    <img src='assets/$patientId.png' onerror=\"this.onerror=null;this.src='assets/profile.png'\" style='max-width:300px'>
                </div>
                <div class='w3-half' style='text-align:left'>
                    <h4>Patient Details</h4>
                    <ul>
                        <li><b>Patient ID: </b>$patientId</li>
                        <li><b>Patient IC NO: </b>$patientIc</li>
                        <li><b>Patient Email: </b>$patientEmail</li>
                        <li><b>Patient Phone: </b>$patientPhone</li>
                        <li><b>Patient Address: </b>$patientAddress</li>
                        <li><b>Patient Reg Date: </b>$patientDateReg</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>";

                        $i++;
                    }
                }else{
                    echo "<h3>No result found</h3>";
                }
                ?>
            </table>
        </div>
        <div class="w3-container w3-padding w3-hide-large w3-hide-medium">
            <div class="w3-grid-template">
                <?php
                    $i = 0;
                    foreach ($rows as $patients) {
                        $patientId = $patients['patient_id'];
                        $patientIc = $patients['patient_ic'];
                        $patientEmail = $patients['patient_email'];
                        $patientName = $patients['patient_name'];
                        $patientPhone = $patients['patient_phone'];
                        $patientAddress = $patients['patient_address'];
                        $patientDateReg = date_format(date_create($patients['patient_date_reg']),"d/m/Y H:i a");
                        echo "<div class='w3-center'>";
                        echo "<div class='w3-card w3-padding' style='margin:4px'>";
                        echo "<header class='w3-teal'><h5>".$patientName."</h5></header>";
                        echo "<img src='assets/$patientId.png' onerror=this.onerror=null;this.src='assets/profile.png' style='width:80%;height:220px' >";
                        echo "<hr>";
                        echo "$patientIc<br>$patientPhone<br>$patientEmail<br>";
                        echo "</div></div>";
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="w3-container w3-row w3-center">
        <?php
            for ($page = 1; $page <= $number_of_page; $page++) {
                echo '<a href = "index.php?pageno=' . $page . '" style=
                "text-decoration: none">&nbsp&nbsp' . $page . ' </a>';
            }
            echo " ( " . $pageno . " )";
        ?>
    </div>
    <footer class="w3-footer w3-center w3-blue-grey">
        <p>Clinic</p>
    </footer>

    <div class="w3-modal" id="id01">
        <div class="w3-modal-content w3-animate-opacity" style="width:30%">
            <header class="w3-container w3-teal">
                <p>About MyClinic</p>
                <span onclick="document.getElementById('id01').style.display='none'"
                    class="w3-button w3-display-topright">&times;</span>
            </header>
            <div class="w3-container">
                <p>This web app is proprietray system own by MyClinic. No other part of the application can be use
                    withour proper...</p>
            </div>
            <div class="w3-container w3-row">
                <a href="" class="w3-button w3-green">Ok</a>
                <a href="" class="w3-button w3-red">Cancel</a>
            </div>
            <footer>
                <p class="w3-center">MyClinic</p>
            </footer>
        </div>
    </div>
</body>

</html>