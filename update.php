<?php
/* THIS IS A UPDATE CRON FILE DESIGNED BY ABDULRAUF YAMTA SUN NOV 12 2017
*/

//GET DATABASE CONNECTIONS
require('db.php');
require('dbTo.php');

//DECLARE VARIABLES
$username;
$password;
$firstname;
$lastname;
$email;

echo "welcome!... <br />";
echo "Cron Begining... <br />";
echo "db successfully connected... <br /> ";

//	FETCH THE STUDENT DATA FROM REGISTRATION DATABASE
$sql = "SELECT a.admission_id, s.fname,s.lname,s.oname, s.contact_email, u.password FROM `adm_no` a JOIN student s ON a.student_id=s.student_id JOIN users u ON a.admission_id=u.username where s.contact_email IS NOT NULL AND TRIM(s.contact_email) <> ''";
echo "fetching data... <br />";
//	PROCESS FETCHED DATA FROM REGISTRATION DATABASE  DATA CLEANUP
$getData = mysqli_query($con, $sql);
$fetchData = mysqli_fetch_array($getData,MYSQLI_ASSOC);


$num_rows = mysqli_num_rows($getData);
echo "Number of Rows: " . $num_rows. "<br />";

$result = $con->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    //echo "Printing fetched records... <br />";
    echo "updating records from database... <br />";
    while($row = $result->fetch_assoc()) {
        // echo "id: " . $row["admission_id"]. " - Name: " . $row["fname"]. " " . $row["password"]. "<br>";
        $username = $row["admission_id"];
        $password = $row["password"];
        $firstname = $row["fname"];
        $lastname = $row["lname"];
        $email = $row["contact_email"];
        
        $insertCron = "UPDATE mdlwv_user SET confirmed = 1, mnethostid =1, email = '$email' where username = '$username';";
        //INSERT PROCESSED DATA INTO MOODLE DATABASE
        //$setData = mysqli_query($conTo, $insertCron); 
        $setData = $conTo->query($insertCron);
    }
} else {
    echo "oops! no records found from SQL Query";
}
echo "Cron records updated All Done! ";
//	ABDULRAUF YAMTA	ALL RIGHTS RESERVED	2017
?>
