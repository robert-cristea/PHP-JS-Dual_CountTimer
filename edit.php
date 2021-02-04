<?php
//session_start();
//
//$first_datetime = $second_datetime = "";
//
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
//    if (empty($_POST["first_datetime"])) {
//        $error1 = "First DateTime is required";
//    } else {
//        $first_datetime = $_POST["first_datetime"];
//    }
//
//    if (empty($_POST["second_datetime"])) {
//        $error2 = "Second DateTime is required";
//    } else {
//        $second_datetime = $_POST["second_datetime"];
//    }
//}
//
//if ($first_datetime !== null && $second_datetime !== null){
//
//    $servername = "localhost";
//    $username = "root";
//    $password = "";
//    $dbname = "timer";
//
//    // Create connection
//    $conn = new mysqli($servername, $username, $password, $dbname);
//    // Check connection
//    if ($conn->connect_error) {
//      die("Connection failed: " . $conn->connect_error);
//    }
//
//    $sql = "INSERT INTO timer (first_datetime, second_datetime)
//    VALUES (`$first_datetime`,`$second_datetime`)";
//
//    if ($conn->query($sql) === TRUE) {
//      echo "New record created successfully";
//    } else {
//      echo "Error: " . $sql . "<br>" . $conn->error;
//    }
//
//    $conn->close();
//}
//
//
//?>

<!DOCTYPE html>
<html>
    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />
    <style>
        .dateselecter label,.dateselecter input,.dateselecter i{
            display:inline-block;
        }
    </style>

    </head>
    <body>
    <div class="container">
        <h3>Calendar with 24 hour time format(yyyy-MM-dd hh:mm:ss)</h3>

        <div style="text-align:left; margin:10px auto 10px auto;" class="dateselecter">
            <label for="demo1">Please enter a date here &gt;&gt;</label>
            <input type="Text" class="form-control" id="demo1" maxlength="25" size="25" style="width:200px;" />
            <i class="glyphicon glyphicon-calendar" onclick="javascript:NewCssCal ('demo1','yyyyMMdd','arrow',true,'24',true)" style="cursor:pointer; font-size:18px;"/></i>
        </div>
    </div>
<!--        <div>-->
<!--            <form method="POST" action="--><?php //echo htmlspecialchars($_SERVER["PHP_SELF"]);?><!--">-->
<!--                <label>First DateTime</label>-->
<!--                <input type="date" name='first_datetime' />-->
<!--                <label>Second DateTime</label>-->
<!--                <input type="date" name='second_datetime' />-->
<!--                <input type="submit" value="Submit">-->
<!--            </form>-->
<!--        </div>-->
    </body>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js"></script>
<script>
    $(function () {
        var bindDatePicker = function() {
            $(".date").datetimepicker({
                format:'YYYY-MM-DD',
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
            }).find('input:first').on("blur",function () {
                // check if the date is correct. We can accept dd-mm-yyyy and yyyy-mm-dd.
                // update the format if it's yyyy-mm-dd
                var date = parseDate($(this).val());

                if (! isValidDate(date)) {
                    //create date based on momentjs (we have that)
                    date = moment().format('YYYY-MM-DD HH:mm:ss');
                }

                $(this).val(date);
            });
        }

        var isValidDate = function(value, format) {
            format = format || false;
            // lets parse the date to the best of our knowledge
            if (format) {
                value = parseDate(value);
            }

            var timestamp = Date.parse(value);

            return isNaN(timestamp) == false;
        }

        var parseDate = function(value) {
            var m = value.match(/^(\d{1,2})(\/|-)?(\d{1,2})(\/|-)?(\d{4})$/);
            if (m)
                value = m[5] + '-' + ("00" + m[3]).slice(-2) + '-' + ("00" + m[1]).slice(-2);

            return value;
        }

        bindDatePicker();
    });
</script>
</html>

