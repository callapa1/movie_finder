<?php

$GLOBALS['conn'] = mysqli_connect("localhost","root","");
mysqli_select_db($GLOBALS['conn'], 'movies_db');