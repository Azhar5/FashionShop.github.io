<div id="messagebox" style="background: black; color: white; width: 500px; height: 500px;"></div>

<form onsubmit="return sendMessage($('#message').val());">
    <input type="text" id="message" style="    width: 500px; border: 1px solid green; height: 50px;"/>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>

function sendMessage(msg) {
    if(msg === ''){
        return false;
    }
    $.post("/demo/chat/test.php", {msg: msg}).done(function (response) {
    });
    return false;
}

function start(time) {
    setTimeout(function () {
        $.get("/demo/chat/test.php", {time: time}).done(function (response) {
            response = JSON.parse(response);
            if (parseInt(response[0]) !== parseInt(response[1])) {
                $("#messagebox").append("<br>" + response[2]);
            }
            start(response[0]);
        });
    }, 2000);
}

start(0);

$data = isset($_POST["msg"]) ? $_POST["msg"] : '';
$new_message_request = isset($_GET["time"]) ? $_GET["time"] : '';
 
 if ($data != '') {
    $filename = getcwd() . "/data.txt";
    file_put_contents($filename, $data);
    exit;
}
 if ($new_message_request != '') {
    $array = array();
    $filename = getcwd() . "/data.txt";
    $time = filemtime($filename);
    if ($new_message_request != $time) {
        $array[0] = $time;
        $array[1] = $new_message_request;
        $array[2] = $_SERVER["REMOTE_ADDR"] ." : ".  file_get_contents($filename);
        echo json_encode($array);
    } else {
        $array[0] = $time;
        $array[1] = $new_message_request;
        $array[2] = $_SERVER["REMOTE_ADDR"] ." : ".  file_get_contents($filename);
        echo json_encode($array);
    }
    exit;
}


59
60
61
62
63
 
<?php
$data = isset($_POST["msg"]) ? $_POST["msg"] : '';
$new_message_request = isset($_GET["time"]) ? $_GET["time"] : '';
if ($data != '') {
    $filename = getcwd() . "/data.txt";
    file_put_contents($filename, $data);
    exit;
}
if ($new_message_request != '') {
    $array = array();
    $filename = getcwd() . "/data.txt";
    $time = filemtime($filename);
    if ($new_message_request != $time) {
        $array[0] = $time;
        $array[1] = $new_message_request;
        $array[2] = $_SERVER["REMOTE_ADDR"] ." : ".  file_get_contents($filename);
        echo json_encode($array);
    } else {
        $array[0] = $time;
        $array[1] = $new_message_request;
        $array[2] = $_SERVER["REMOTE_ADDR"] ." : ".  file_get_contents($filename);
        echo json_encode($array);
    }
    exit;
}
?>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
        <script>
function sendMessage(msg) {
    if(msg === ''){
        return false;
    }
    $.post("/demo/chat/test.php", {msg: msg}).done(function (response) {
    });
    return false;
}
function start(time) {
    setTimeout(function () {
        $.get("/demo/chat/test.php", {time: time}).done(function (response) {
            response = JSON.parse(response);
            if (parseInt(response[0]) !== parseInt(response[1])) {
                $("#messagebox").append("<br>" + response[2]);
            }
            start(response[0]);
        });
    }, 2000);
}
            start(0);
        </script>
    </head>
    <body>
        <div id="messagebox" style="background: black; color: white; width: 300px; height: 300px;">
 
        </div>
        <form onsubmit="return sendMessage($('#message').val());">
            <input type="text" id="message" style="    width: 300px; border: 1px solid green; height: 42px;"/>
        </form>
    </body>
</html>
 