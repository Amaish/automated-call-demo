<!DOCTYPE html>
<html class="" lang="en">
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>
<table>
<tr>
    <th>Name</th>
    <th>Balance</th>
    <th>Phone Number</th>
    <th>Due date</th>
    <th>Time</th>
    <th>Counter</th>
  </tr>
  <div>
<?php
date_default_timezone_set("Africa/Nairobi");
$file = fopen("contacts.csv","r");
$count = 0;
$dateDueArray = array();
$idArray = array();
while(! feof($file))
  {
  $array = fgetcsv($file);
      if ($count > 0 && !empty ( $array[0] )) {
        $name = $array[0];
        $balance = $array[1];
        $phoneNumber = $array[2];
        $dateDue = $array[3];// due date format it to "Jan 5, 2021 15:37:25"
        $time = $array[4];
        $hour = substr($time, 0,2);
        $minute = substr($time, 3,2);
        $seconds = substr($time, 6,7);
        $month = substr($dateDue, 0,2);
        $day = substr($dateDue, 3,2);
        $year = "20".substr($dateDue, 6,7);
        $date = date("M d, Y H:i:s", mktime($hour, $minute, $seconds, $month, $day, $year));
        echo "<tr>";
        $id = "counter".$count;
        $idName = "name".$id;
        $idPhone = "phone".$id;
        $idBalance = "balance".$id;
        echo "<td>".$name."</td>";
        echo "<input type='hidden' name='$idName' id='$idName' value='".$name."'>";
        echo "<input type='hidden' name='$idPhone' id='$idPhone' value='".$phoneNumber."'>";
        echo "<input type='hidden' name='$idBalance' id='$idBalance' value='".$balance."'>";
        echo "<td>".$balance."</td>";
        echo "<td>"."+".$phoneNumber."</td>";
        echo "<td>".$dateDue."</td>";
        echo "<td>".$time."</td>";
        $dateDueArray[$id]=$date;
        array_push($idArray,$id);
        echo '<td id="counter'.$count.'"></td>';
        echo "</tr>";
        $response = "Hi $name this is a kind reminder from branch you have a balance of KES $balance due date was " .$array[3]."<br>";
      }
  $count++;
  }
  $dateDueArray_Json = json_encode($dateDueArray);
  $idArray_Json = json_encode($idArray);
  echo "<input type='hidden' name='dateDue' id='dateDue' value='".$dateDueArray_Json."'>";
  echo "<input type='hidden' name='counterId' id='counterId' value='".$idArray_Json."'>";
fclose($file);
?>
</div>
</table>
<ul id="makeCall"></ul>
</body>
<script src="js/main.js" onload="countDownTimer()"></script>
</html>