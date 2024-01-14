<?php
//Simple function for redirecting page
function redirect($page)
{
    header('location: ' .URLROOT . '/' .$page);
}
