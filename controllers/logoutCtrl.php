<?php

//La session se détruit, on est déconnecté
session_destroy();

header('location: ../index.php');
exit();

