<?php

  //$con goes here 
    $result=$conn->query("SELECT pname FROM products");
    $response["stuff"] = array();

        while($row = $result->fetch_assoc())    {

            $stuff= array();

            /* ADD THE TABLE COLUMNS TO THE JSON OBJECT CONTENTS */
            $stuff["pname"] = $row['pname'];
            array_push($response["stuff"], $stuff);

            // $response[] = $row;
        }
        // success
        $response["success"] = 1;
        echo(json_encode($response));


    /* CLOSE THE CONNECTION */
    mysqli_close($conn );
    ?>