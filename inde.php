<?php
$page= $_SERVER['PHP_SELF'];
$sec="10000";
?>
<!DOCTYPE html>
<html>
<head>
 <meta http-equiv="refresh"  content="<?php echo $sec ?>; URL='<?php echo $page?>' ">
  <link rel="stylesheet" href="css.css" type="text/css">
</head>
<body>


<div class="main-div">
        <h1>Overall Summary</h1>
        <div class="center-div">
            <div class="table responsive">
                <table>
                   <thead>
                        <tr>
                          <th>s_no</th>
                          <th>Location</th>
                          <th>c_date</th>
                          <th>c_time</th>
                          <th>Humidity</th>
                          <th>Temperature</th>
                        </tr>
                   </thead>
                   <tbody>

<?php
 $username="u275965903_IOT";
 $password="Iot@123456";
 $server="46.17.175.85";//host ip address
 $db="u275965903_Sensors";

 $con=mysqli_connect($server,$username,$password,$db);

 if($con){
?>
   <script>
     alert('connection succesful');
    </script>
    <?php
 }
 else{
 die("no connection".mysqli_connect_error());}
$selectquery="select* from FireAlarm";
$query=mysqli_query($con,$selectquery);
//$num=mysqli_num_rows($query);
//echo $num. "<br";
$q="select min(Temperature),max(Temperature),min(Humidity),max(Humidity) from FireAlarm ";
$min=mysqli_query($con,$q);
$q1="select avg(Temperature),avg(Humidity) from FireAlarm";
$avg=mysqli_query($con,$q1);

$q2="select max(c_time) from FireAlarm";
$q3="select c_time from FireAlarm where Temperature=(select max(Temperature) from FireAlarm)";
$q4="select c_time from FireAlarm where Humidity=(select min(Humidity) from FireAlarm)";
$q5="select c_time from FireAlarm where Humidity=(select max(Humidity) from FireAlarm)";
$q6="select Temperature from FireAlarm where c_time=(select max(c_time) from FireAlarm)";
$q7="select Humidity from FireAlarm where c_time=(select max(c_time) from FireAlarm)";
//$row = $min->fetch_assoc();
//echo $row['min(Temperature)'];
//$time_mit =mysqli_query($con ,$q2);
//$row=mysqli_fetch_array($time_mit);
//echo " time ".$row['c_time'];


$time =mysqli_query($con ,$q2);
//$row=mysqli_fetch_array($time_mat);
//echo " time ".$row['c_time'];
while($row=$time->fetch_assoc()){
   echo " current time is:".$row['max(c_time)'];
}
$rt=mysqli_query($con,$q6);
while($row=$rt->fetch_assoc()){
    echo "<br> Recent Temperature is:".$row['Temperature'];
    break;
}
$rh=mysqli_query($con,$q7);
while($row=$rh->fetch_assoc()){
    echo "<br> Recent Humidity is:".$row['Humidity'];
    break;
}

while ($row = $min->fetch_assoc()) {
?>
    <div class="pg"> <?php echo "<br><br> min Temperature is :".$row['min(Temperature)']."<br> max Temperature is:".$row['max(Temperature)']; ?> </div>
    <div class="gp"> <?php echo "<br><br> min Humidity is:".$row['min(Humidity)']. "<br> max Humidity is:". $row['max(Humidity)']; ?>  </div>
 <?php
}
while($row= $avg->fetch_assoc()){
        echo "<br><br> avg Temperature is:".$row['avg(Temperature)']."<br> avg Humidity is:" .$row['avg(Humidity)'];

}


while($res=mysqli_fetch_array($query)){
?>
                <tr>
                            <td><?php echo $res['s_no']; ?> </td>
                            <td><?php echo $res['Location']; ?> </td>
                            <td><?php echo $res['c_date']; ?> </td>
                            <td><?php echo $res['c_time']; ?> </td>
                            <td><?php echo $res['Humidity']; ?> </td>
                            <td><?php echo $res['Temperature']; ?> </td>
                        </tr>
<?php
}
 ?>

                   </tbody>
                </table>
            </div>
        </div>
</div>

<?php echo "watch the page is reloded in 10 seconds ";
?>
</body>
</html>
