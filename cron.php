<?php
/*  THIS IS A CRON FILE DESIGNED BY ABDULRAUF YAMTA SUN NOV 12 2017
    Mail Me for any suggestions and/ or comments <yamta.a@gmail.com>
*/

//  GET DATABASE CONNECTIONS
require('db.php');
require('dbTo.php');

//  DECLARE VARIABLES
$username;
$password;
$firstname;
$lastname;
$email;

echo "welcome!... <br />";
echo "cron begining... <br />";
echo "db successfully connected... <br /> ";

//  FETCH THE STUDENT DATA FROM REGISTRATION DATABASE
$sql = "SELECT a.admission_id, s.fname,s.lname,s.oname, s.contact_email, u.password FROM `adm_no` a JOIN student s ON a.student_id=s.student_id JOIN users u ON a.admission_id=u.username";
echo "fetching data... <br />";
//  PROCESS FETCHED DATA FROM REGISTRATION DATABASE  DATA CLEANUP
$getData = mysqli_query($con, $sql);
$fetchData = mysqli_fetch_array($getData,MYSQLI_ASSOC);
$num_rows = mysqli_num_rows($getData);
echo "number of rows: " . $num_rows. "<br />";

$result = $con->query($sql);
if ($result->num_rows > 0) {
    //  output data of each row
    //  echo "Printing fetched records... <br />";
    echo "writing records to new database... <br />";
    while($row = $result->fetch_assoc()) {
        // echo "id: " . $row["admission_id"]. " - Name: " . $row["fname"]. " " . $row["password"]. "<br>";
        $username = $row["admission_id"];
        $password = $row["password"];
        $firstname = $row["fname"];
        $lastname = $row["lname"];
        $email = $row["email"];
        
        $insertCron = "INSERT INTO mdlwv_user (username,password,firstname,lastname,email) SELECT * FROM (SELECT '$username','$password','$firstname','$lastname','$email') AS tmp WHERE NOT EXISTS (SELECT username FROM mdlwv_user WHERE username = '$username') LIMIT 1;";
        //  INSERT PROCESSED DATA INTO MOODLE DATABASE
        //  $setData = mysqli_query($conTo, $insertCron); 
        $setData = $conTo->query($insertCron);
    }
} else {
    echo "oops! no records returned from sql query";
}
echo "Cron All Done! ";
/*	ABDULRAUF YAMTA	ALL RIGHTS RESERVED	2017
    Finished: Jan 31 2018
*/
?>