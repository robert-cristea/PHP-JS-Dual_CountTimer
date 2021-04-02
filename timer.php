<?php
require_once './config.php';

// Create connection
$conn = new mysqli(SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql1 = "SELECT * FROM timer WHERE type = 1 order by reg_date DESC limit 1";
$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) {
    $row1 = $result1->fetch_assoc();
    $first_datetime1 = $row1['first_datetime'];
    $second_datetime1 = $row1['second_datetime'];
} else {
  $firstTimerEmpty = "There is no First Timer!";
}

$sql2 = "SELECT * FROM timer WHERE type = 2 order by reg_date DESC limit 1";
$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
    $row2 = $result2->fetch_assoc();
    $first_datetime2 = $row2['first_datetime'];
    $second_datetime2 = $row2['second_datetime'];
} else {
    $secondTimerEmpty = "There is no Second Timer!";
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
        <?php if (!isset($firstTimerEmpty)): ?>
        <div id="timer1">
            <h1 id="headline1"></h1>
            <div id="countdown1">
                <ul>
                <li><span id="days1"></span>days</li>
                <li><span id="hours1"></span>Hours</li>
                <li><span id="minutes1"></span>Minutes</li>
                <li><span id="seconds1"></span>Seconds</li>
                </ul>
            </div>
        </div>
        <?php else:?>
        <h1><?php echo $firstTimerEmpty ?></h1>
        <?php endif; ?>

        <hr>
        <?php if (!isset($secondTimerEmpty)): ?>
        <div id="timer2" style="margin-top:30px">
            <h1 id="headline2"></h1>
            <div id="countdown2">
                <ul>
                <li><span id="days2"></span>days</li>
                <li><span id="hours2"></span>Hours</li>
                <li><span id="minutes2"></span>Minutes</li>
                <li><span id="seconds2"></span>Seconds</li>
                </ul>
            </div>
        </div>
        <?php else:?>
            <h1><?php echo $secondTimerEmpty ?></h1>
        <?php endif; ?>
        <div class="text-center" style="margin-top: 20px;">
            <a href="./edit.php" style="font-size:20px">Create New Timer</a>
        </div>
    </div>

    <script>
    <?php if (isset($first_datetime1) && isset($second_datetime1)): ?>

    var first_datetime1 = <?php if (isset($first_datetime1)) echo strtotime($first_datetime1); else echo 0; ?> * 1000;
    var second_datetime1 = <?php if (isset($second_datetime1)) echo strtotime($second_datetime1); else echo 0; ?> * 1000;
    var now1 = <?php echo time() ?> * 1000;
    var countDownDate1, status1 = 0;

    if (first_datetime1 > now1){

        status1 = 0;
        countDownDate1 = first_datetime1;
        document.getElementById("headline1").innerHTML = "To First DateTime: <span style='font-weight: bold; font-size:3rem'>Until Call</span>";
    }else{
        status1 = 1;
        if (second_datetime1 > now1) {
            countDownDate1 = second_datetime1;
            document.getElementById("headline1").innerHTML = "To Second DateTime: <span style='font-weight: bold; font-size:3rem'>On Call</span>";
        }
        else {
            document.getElementById("headline1").innerText = "";
            document.getElementById("countdown1").innerHTML = "<h1 style='font-size:100px'>END</h1>";
        }
    }

    // Update the count down every 1 second
    var x1 = setInterval(function() {

        now1 = now1 + 1000;

        // Find the distance between now an the count down date
        var distance1 = countDownDate1 - now1;
        // If the count down is over, write some text
        if (distance1 < 0) {

            if (status1 == 0) {
                document.getElementById("headline1").innerHTML = "To Second DateTime:<span style = 'font-weight:bold;font-size:3rem;'> On Call</span>";
                countDownDate1 = second_datetime1;
                distance1 = countDownDate1 - now1;
            }

            status1++;

            if (status1 > 1){
                clearInterval(x1);
                document.getElementById("headline1").innerText = "";
                document.getElementById("countdown1").innerHTML = "<h1 style='font-size:100px'>END</h1>";
            }
        }

        // Time calculations for days, hours, minutes and seconds
        var days1 = Math.floor(distance1 / (1000 * 60 * 60 * 24));
        var hours1 = Math.floor((distance1 % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes1 = Math.floor((distance1 % (1000 * 60 * 60)) / (1000 * 60));
        var seconds1 = Math.floor((distance1 % (1000 * 60)) / 1000);

        // Output the result in an element with id="days, hours, minutes, seconds"
        document.getElementById("days1").innerText = days1;
        document.getElementById("hours1").innerText = hours1;
        document.getElementById("minutes1").innerText = minutes1;
        document.getElementById("seconds1").innerText = seconds1;
    }, 1000);
    <?php endif; ?>

    <?php if (isset($first_datetime2) && isset($second_datetime2)): ?>
    var first_datetime2 = <?php if (isset($first_datetime2)) echo strtotime($first_datetime2); else echo 0;?> * 1000;
    var second_datetime2 = <?php if (isset($second_datetime2)) echo strtotime($second_datetime2); else echo 0;?> * 1000;
    var now2 = <?php echo time() ?> * 1000;
    var countDownDate2, status2 = 0;

    if (first_datetime2 > now2){
        status2 = 0;
        countDownDate2 = first_datetime2;
        document.getElementById("headline2").innerHTML = "To First DateTime: <span style='font-weight: bold; font-size:3rem'>Until Call</span>";
    }else{
        status2 = 1;
        if (second_datetime2 > now2) {
            countDownDate2 = second_datetime2;
            document.getElementById("headline2").innerHTML = "To Second DateTime: <span style='font-weight: bold; font-size:3rem'>On Call</span>";
        }
        else {
            document.getElementById("headline2").innerText = "";
            document.getElementById("countdown2").innerHTML = "<h1 style='font-size:100px'>END</h1>";
        }
    }

    // Update the count down every 1 second
    var x2 = setInterval(function() {

        now2 = now2 + 1000;

        // Find the distance between now an the count down date
        var distance2 = countDownDate2 - now2;

        // If the count down is over, write some text
        if (distance2 < 0) {

            if (status2 == 0) {
                document.getElementById("headline2").innerHTML = "To Second DateTime:<span style = 'font-weight:bold;font-size:3rem;'> On Call</span>";
                countDownDate2 = second_datetime2;
                distance2 = countDownDate2 - now2;
            }

            status2++;

            if (status2 > 1){
                clearInterval(x2);
                document.getElementById("headline2").innerText = "";
                document.getElementById("countdown2").innerHTML = "<h1 style='font-size:100px'>END</h1>";
            }
        }
        // Time calculations for days, hours, minutes and seconds
        var days2 = Math.floor(distance2 / (1000 * 60 * 60 * 24));
        var hours2 = Math.floor((distance2 % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes2 = Math.floor((distance2 % (1000 * 60 * 60)) / (1000 * 60));
        var seconds2 = Math.floor((distance2 % (1000 * 60)) / 1000);

        // Output the result in an element with id="days, hours, minutes, seconds"
        document.getElementById("days2").innerText = days2;
        document.getElementById("hours2").innerText = hours2;
        document.getElementById("minutes2").innerText = minutes2;
        document.getElementById("seconds2").innerText = seconds2;
    }, 1000);
    <?php endif; ?>
    </script>
</body>
</html>