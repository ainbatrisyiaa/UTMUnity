<?php
    $to="justinejeliza06@gmail.com";
    $subject="smtp_test";
    $msg="hello! 2st test.";
    $from="From:justinejeliza06@gmail.com";

    if(mail($to, $subject, $msg, $from)) {
        echo "email sent.";
    }
    else{
        echo "not sent.";
    }

?>
    