<?php

//this is the core of my website. connection to phpmyadmin database

        $host = "lamp-18.eeecs.qub.ac.uk";
        $user = "mwelsh04";
        $pw = "ksQXc0zrLd5X1DCB";
        $db = "mwelsh04";
 
        $conn = new mysqli($host, $user, $pw, $db);
 
        if($conn->connect_error) {
          echo $conn->connect_error;
        }
 