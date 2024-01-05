<?php
$temp = "The date is ";
echo longdate(time());
function longdate($timestamp)
{
    return date("l F jS Y", $timestamp);
}
?>