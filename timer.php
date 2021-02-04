<?php


date_default_timezone_set('EST');
// echo date_default_timezone_get();
// $currenttime = date('H:i:s');
// echo $currenttime;
// //A: RECORDS TODAY'S Date And Time
// $today = time();

// //B: RECORDS Date And Time OF YOUR EVENT
// $event = mktime(0,0,0,12,25,2021);

// //C: COMPUTES THE DAYS UNTIL THE EVENT.
// $countdown = round(($event - $today)/86400);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "timer";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM timer order by reg_date limit 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
//  while($row = $result->fetch_assoc()) {
    $row = $result->fetch_assoc();
    $first_datetime = $row['first_datetime'];
    $second_datetime = $row['second_datetime'];
//  }
} else {
  echo "0 results";
}
$conn->close();

?>

<!DOCTYPE HTML>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="assets/general.css" rel="stylesheet" />
</head>

<body>

    <div class="container">
        <h1 id="headline">To First DateTime:</h1>
        <div id="countdown">
            <ul>
            <li><span id="days"></span>days</li>
            <li><span id="hours"></span>Hours</li>
            <li><span id="minutes"></span>Minutes</li>
            <li><span id="seconds"></span>Seconds</li>
            </ul>
        </div>
        <div class="message">
            <div id="content">
            <span class="emoji">🥳</span>
            <span class="emoji">🎉</span>
            <span class="emoji">🎂</span>
            </div>
        </div>
    </div>
    

    <script>

    //console.log(<?php //echo date('H:i:s',time());?>//);
    var first_datetime = <?php echo strtotime($first_datetime) ?> * 1000;
    var second_datetime = <?php echo strtotime($second_datetime) ?> * 1000;
    var now = <?php echo time() ?> * 1000;
    var countDownDate, status = 0;

    if (first_datetime > now){
        status = 0;
        countDownDate = first_datetime;
    }else{
        status = 1;
        if (second_datetime > now) {
            countDownDate = second_datetime;
            document.getElementById("countdown").innerHTML = "<h1>ON CALL</h1>";
            document.getElementById("headline").innerText = "To Second DateTime";
        }
        else {
            document.getElementById("headline").innerText = "";
            document.getElementById("countdown").innerHTML = "<h1>END</h1>";
        }
    }

    // Update the count down every 1 second
    var x = setInterval(function() {

        now = now + 1000;

        // Find the distance between now an the count down date
        var distance = countDownDate - now;

        if (status == 0){
            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="days, hours, minutes, seconds"
            document.getElementById("days").innerText = days;
            document.getElementById("hours").innerText = hours;
            document.getElementById("minutes").innerText = minutes;
            document.getElementById("seconds").innerText = seconds;
        }

        // If the count down is over, write some text
        if (distance < 0) {
            document.getElementById("countdown").innerHTML = "<h1>ON CALL</h1>";
            document.getElementById("headline").innerText = "To Second DateTime";
            countDownDate = <?php echo strtotime($second_datetime) ?> * 1000;
            status++;
            if (status > 1){
                clearInterval(x);
                document.getElementById("headline").innerText = "";
                document.getElementById("countdown").innerHTML = "<h1>END</h1>";
            }
        }
    }, 1000);
    </script>
</body>

</html>