<?php

function dd($str)
{
    print("<pre>" . print_r($str, true) . "</pre>");
    die();
}
