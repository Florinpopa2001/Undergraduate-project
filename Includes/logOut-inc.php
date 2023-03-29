<?php

session_start();
session_unset(); //clears out the session for usage.
session_destroy(); //destroys all of the data associated with the current session

header("location: ../index.php");
exit();