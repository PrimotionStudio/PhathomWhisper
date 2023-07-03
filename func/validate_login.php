<?php
function parselocation($location) {
    if (stristr(getcwd(), "func")) {
        $location = "../" . $location;
    }
    return $location;
}

function parselocation2() {
    if (!stristr(getcwd(), "func")) {
        header("location: login");
        exit(); // Exit after redirect
    } else {
        $error = "Not Logged In";
        // Handle the error or display a message
    }
}

require_once(parselocation("partials/session.php"));
require_once(parselocation("partials/sql.php"));

if (isset($_SESSION["userid"]) && isset($_SESSION["loginkey"])) {
    $userid = $_SESSION["userid"];
    $loginkey = $_SESSION["loginkey"];
    $selectuser = "SELECT * FROM accounts WHERE id='$userid'";
    $queryuser = mysqli_query($con, $selectuser);
    
    if (mysqli_num_rows($queryuser) > 0) {
        $getuser = mysqli_fetch_assoc($queryuser);
        $chatid = $getuser["chatid"];
        
        if ($loginkey !== $getuser["loginkey"]) {
            parselocation(parselocation2());
        }
    } else {
        parselocation(parselocation2());
    }
} elseif (isset($_GET["chat"])) {
    $selectuser = "SELECT * FROM accounts WHERE chatid='" . $_GET["chat"] . "'";
    $queryuser = mysqli_query($con, $selectuser);
    if (mysqli_num_rows($queryuser) > 0) {
        $getuser = mysqli_fetch_assoc($queryuser);
        if ($getuser["linkstat"] == "closed") {
            $_SESSION["alert"] = "The link is broken";
            parselocation(parselocation2());
        }
        $chatid = $_GET["chat"];
        $_SESSION["chat"] = $_GET["chat"];
    } else {
        parselocation(parselocation2());
    }
} elseif (isset($_POST["chat"])) {
    $selectuser = "SELECT * FROM accounts WHERE chatid='" . $_POST["chat"] . "'";
    $queryuser = mysqli_query($con, $selectuser);
    
    if (mysqli_num_rows($queryuser) > 0) {
        $getuser = mysqli_fetch_assoc($queryuser);
        $chatid = $_POST["chat"];
    } else {
        parselocation(parselocation2());
    }
} else {
    parselocation(parselocation2());
}
?>
