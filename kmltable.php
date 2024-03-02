<!DOCTYPE html>
<html>
<style>
table, th, td {
  border:1px solid black;

}
p {
  font-size: 14px;
}
</style>

<header>
  <img src="banner.png" width="100%">
</header>

<?php 
$servername = "208.109.75.17";
$username = "";
$password = "";
$database = "KMLDatabase";
$tableForSearch = "KMLDatabase";
$value = $_POST["valueForTable"];

date_default_timezone_set("America/New_York");


$conn = mysqli_connect($servername, $username, $password, $database);
if(!$conn){
  echo "This is not working";
};
$sql = "SELECT CONCAT(Last_Name, \", \", First_Name) AS Name, Bad_Actor, Designation_Number, County, Telephone, TRIM(BOTH \" Branch\" FROM District_Office) AS District_Office , Expiration_Date FROM KMLDatabase WHERE County = \"$value\" AND Expiration_Date >= CURDATE() ORDER BY Name";
$result = mysqli_query($conn,$sql);
echo "<h4>List of loggers who have a current KML Designation for <b>$value County</b>. List Generated on ".date("n/d/Y"). ".<h4>
<p>This list includes loggers that have designated this county as their address and does not include counties that they work in. <br><br>    (If you are looking for Master Loggers in your area it may be beneficial to check surrounding counties)</p>";

echo "<table style= \"width:100%\">
        <tr>
            <th>Name</th>
            <th>Designation Number</th>
            <th>County</th>
            <th>Phone</th>
            <th>Expiration Date</th>
            <th>Bad Actor</th>
        <tr/>";

while($row = mysqli_fetch_assoc($result)){
  $Name = $row["Name"];
  $Des = $row["Designation_Number"];
  $county = $row["County"];
  $phone = $row["Telephone"];
  // $branch = $row["District_Office"];
  $expire = $row["Expiration_Date"];
  $badActor = $row["Bad_Actor"];
  
 echo "<tr>
        <td>$Name</td>
        <td>$Des</td>
        <td>$county</td>
        <td>$phone</td>
        <td>$expire</td>
        <td>$badActor</td>
       </tr>";
}

echo "</table> <br><br><br>";

echo "Updated: ".date("n/d/Y")."<br>";
?>
<button onclick="window.print()">Print this page</button>   <button onclick="window.location.href='https:\/\/kentuckymasterlogger.ukfnrext.org/'">Go back to map</button>
<html>