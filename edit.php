<?php
require_once './config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["first_datetime1"])) {
        $first_error1 = "First DateTime is required";
    } else {
        $first_datetime1 = $_POST["first_datetime1"];
    }

    if (empty($_POST["second_datetime1"])) {
        $second_error1 = "Second DateTime is required";
    } else {
        $second_datetime1 = $_POST["second_datetime1"];
        if (strtotime($second_datetime1) < strtotime($first_datetime1) && !isset($first_error1)) {
            $compare_error1 = "Second Datetime must be after First Datetime!";
        }
    }

    if (isset($first_datetime1) && isset($second_datetime1) && !isset($compare_error1)){

        // Create connection
        $conn = new mysqli(SERVER,DB_USER,DB_PASS,DB_NAME);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $type = $_POST['type'];
        $sql = "INSERT INTO timer (first_datetime, second_datetime,type) VALUES ('$first_datetime1','$second_datetime1','$type')";

        if ($conn->query($sql) === TRUE) {
            $success_message1 = "New Timer has been created!";
        } else {
            $error_message1 = "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }

    if (empty($_POST["first_datetime2"])) {
        $first_error2 = "First DateTime is required";
    } else {
        $first_datetime2 = $_POST["first_datetime2"];
    }

    if (empty($_POST["second_datetime2"])) {
        $second_error2 = "Second DateTime is required";
    } else {
        $second_datetime2 = $_POST["second_datetime2"];
        if (strtotime($second_datetime2) < strtotime($first_datetime2) && !isset($first_error2)) {
            $compare_error2 = "Second Datetime must be after First Datetime!";
        }
    }

    if (isset($first_datetime2) && isset($second_datetime2) && !isset($compare_error2)){

        // Create connection
        $conn = new mysqli(SERVER,DB_USER,DB_PASS,DB_NAME);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $type = $_POST['type'];
        $sql = "INSERT INTO timer (first_datetime, second_datetime,type) VALUES ('$first_datetime2','$second_datetime2','$type')";

        if ($conn->query($sql) === TRUE) {
            $success_message2 = "New Timer has been created!";
        } else {
            $error_message2 = "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
}

?>

<!DOCTYPE html>
<html>
    <head>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.4/css/bootstrap-datetimepicker.min.css">
    </head>
    <body>
    <div class="container" style="padding:100px">
        <?php if (isset($success_message1)):?><div class="alert alert-success"><?php echo $success_message1?></div><?php endif ?>
        <?php if (isset($error_message1)):?><div class="alert alert-danger"><?php echo $error_message1?></div><?php endif ?>
        <?php if (isset($compare_error1)):?><div class="alert alert-warning"><?php echo $compare_error1?></div><?php endif ?>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          	<h1 class = "text-center">Timer 1</h1>
            <div><label>First Date/Time</label><input type="text" id="dateTimePicker1" name="first_datetime1" class="form-control"><span style="color:red"><?php if (isset($first_error1)) echo $first_error1 ?></span></div>
            <div><label>Second Date/Time</label><input type="text" id="dateTimePicker2" name="second_datetime1" class="form-control"><span style="color:red"><?php if (isset($second_error1)) echo $second_error1 ?></span></div>
            <input class="btn btn-primary btn-block" style="margin-top:5px" type="submit" value="Create Timer" />
            <input type="hidden" name="type" value="1" />
        </form>
        <div style="margin-top:50px"></div>

        <?php if (isset($success_message2)):?><div class="alert alert-success"><?php echo $success_message2?></div><?php endif ?>
        <?php if (isset($error_message2)):?><div class="alert alert-danger"><?php echo $error_message2?></div><?php endif ?>
        <?php if (isset($compare_error2)):?><div class="alert alert-warning"><?php echo $compare_error2?></div><?php endif ?>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
           	<h1 class = "text-center">Timer 2</h1>
            <div><label>First Date/Time</label><input type="text" id="dateTimePicker3" name="first_datetime2" class="form-control"><span style="color:red"><?php if (isset($first_error2)) echo $first_error2 ?></span></div>
            <div><label>Second Date/Time</label><input type="text" id="dateTimePicker4" name="second_datetime2" class="form-control"><span style="color:red"><?php if (isset($second_error2)) echo $second_error2 ?></span></div>
            <input class="btn btn-primary btn-block" style="margin-top:5px" type="submit" value="Create Timer" />
            <input type="hidden" name="type" value="2" />
        </form>
        <div class="text-center" style="margin-top: 20px;">
            <a href="./timer.php" style="font-size:20px">Watch Timer</a>
        </div>

    </div>

    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://momentjs.com/downloads/moment-timezone-with-data.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.4/js/bootstrap-datetimepicker.min.js"></script>
    <script>
        moment.tz.setDefault("America/New_York");
        console.log(moment.tz.guess())
        console.log(new Date())
        $(function(){
            $('#dateTimePicker1,#dateTimePicker2,#dateTimePicker3,#dateTimePicker4').datetimepicker({
                format: "YYYY-MM-DD HH:mm:ss",
                useSeconds: true,
            });
        });
    </script>

</html>

