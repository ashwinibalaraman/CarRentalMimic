<?php
try {

          // Connect to the operational database.
            $con = new PDO("mysql:host=localhost;dbname=project_datamass",
                           "datamass", "sesame");
            $con->setAttribute(PDO::ATTR_ERRMODE,
                               PDO::ERRMODE_EXCEPTION);

          // connect to analytical database
           $con2 = new PDO("mysql:host=localhost;dbname=m_analytical_db",
                           "datamass", "sesame");
           $con2->setAttribute(PDO::ATTR_ERRMODE,
                               PDO::ERRMODE_EXCEPTION);
            
                               }
        catch(PDOException $ex) {
            echo 'ERROR: '.$ex->getMessage();
        }        
    ?>