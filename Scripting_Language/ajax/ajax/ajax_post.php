<?php
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $name = htmlspecialchars (trim ($_POST["name"]));
    $comment = htmlspecialchars (trim ($_POST["comment"]));
    if (!empty($name) && !empty($comment)) {
        echo "<p>Hi, <b> $name </b>.Your Comment has been received successfully.<p>";
        echo"<p> Here's the comment that you've entered: <b>$comment</b></p>";
}
else
echo "<p> please fill all the fields in the form! </p>";
}

else
echo "<p>Something went wrong. Please try again.</p>";
?>