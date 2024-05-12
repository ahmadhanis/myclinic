<?php
session_start();
if (!isset($_SESSION["email"]) && !isset($_SESSION["password"])) {
    echo "<script>alert('Please Login')</script>";
    echo "<script>window.location.href = 'login.php'</script>";
}
include('dbconnect.php');
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

$stmt = $conn->prepare($sqlloadpatients);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();
$number_of_result = $stmt->rowCount();

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
                        <th>Patient Address</th>
                        <th>Patient Date Reg</th>
                        <th>Operations</th>
                    </tr>";
                    foreach ($rows as $patients) {
                        $patientId = $patients['patient_id'];
                        $patientIc = $patients['patient_ic'];
                        $patientEmail = $patients['patient_email'];
                        $patientName = $patients['patient_name'];
                        $patientPhone = $patients['patient_phone'];
                        $patientAddress = $patients['patient_address'];
                        $patientDateReg = date_format(date_create($patients['patient_date_reg']),"d/m/Y H:i a");
                        echo "<tr><td>$patientId</td><td>$patientIc</td><td>$patientEmail</td><td>$patientName</td>
                        <td>$patientPhone</td><td>$patientAddress</td><td>$patientDateReg</td>
                        <td><a href=''><button>Delete</button></a><br><a href=''><button>&nbsp;Edit&nbsp;&nbsp;&nbsp; </button></a></td></tr>";
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
    <footer class="w3-footer w3-center w3-blue-grey">
        <p>Clinic</p>
    </footer>


</body>

</html>