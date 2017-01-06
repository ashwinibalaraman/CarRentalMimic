
<?php
session_start();
?>

<html>
<head>

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />
  <link href="dashboard.css" rel="stylesheet">

  <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
  <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

 <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
     <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.js"></script>


  <script src="//s.codepen.io/assets/libs/modernizr.js" type="text/javascript"></script>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="robots" content="noindex, nofollow">
  <meta name="googlebot" content="noindex, nofollow">

  <script type="text/javascript" src="//code.jquery.com/ui/1.9.2/jquery-ui.js"></script>


  
  <script type="text/javascript" src="reservation.js"></script>
</head>

<body ng-app="">

  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.18/angular.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.18/angular-route.min.js"></script></span>

  <div ng-include='"nav_bars.php"'></div>

  <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

    <div class="container">

      <form class="well form-horizontal" action="bill.php" method="get"  id="contact_form">
        <fieldset>

          <!-- Form Name -->
          <legend>Reserve a Car!</legend>

          <!-- Text input-->

          <div class="form-group">
            <label class="col-md-4 control-label">First Name</label>  
            <div class="col-md-4 inputGroupContainer">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input  name="first_name" placeholder="First Name" class="form-control"  type="text">
              </div>
            </div>
          </div>

          <!-- Text input-->

          <div class="form-group">
            <label class="col-md-4 control-label" >Last Name</label> 
            <div class="col-md-4 inputGroupContainer">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input name="last_name" placeholder="Last Name" class="form-control"  type="text">
              </div>
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label">E-Mail</label>  
            <div class="col-md-4 inputGroupContainer">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                <input name="email" placeholder="E-Mail Address" class="form-email form-control"  type="text" required>
              </div>
            </div>
          </div>


          <!-- Text input-->

          <div class="form-group">
            <label class="col-md-4 control-label">Phone #</label>  
            <div class="col-md-4 inputGroupContainer">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                <input name="phone" placeholder="(845)555-1212" class="form-control" type="text">
              </div>
            </div>
          </div>

          <!-- radio checks -->
          <div class="form-group">
            <label class="col-md-4 control-label">Gender</label>
            <div class="col-md-4">
              <div class="radio">
                <label>
                  <input type="radio" name="gender" value="F" /> Female
                </label>
              </div>
              <div class="radio">
                <label>
                  <input type="radio" name="gender" value="M" /> Male
                </label>
              </div>
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label">License Number</label>  
            <div class="col-md-4 inputGroupContainer">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i></span>
                <input name="license_number" placeholder="JD123456" class="form-control"  type="text" required>
              </div>
            </div>
          </div>


          <?php

          require_once 'db_config.php';


          $state = filter_input(INPUT_GET, "state");

          $state = trim($state);

          print '<div class="form-group"> 
          <label class="col-md-4 control-label">Store</label>
          <div class="col-md-4 selectContainer">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
              <select name="store_id" class="form-control selectpicker" >
                <option value=" ">Please select a store</option>';

                try {

                  $query = "SELECT address_id,city,zip FROM BASE_ADDRESS WHERE state = '$state'";  
                  $data = $con->query($query);
                  $data->setFetchMode(PDO::FETCH_ASSOC);


                  foreach ($data as $row) { 
                    $address_id = $row['address_id'];
                    $city = $row['city'];
                    $zip = $row['zip'];

                    $query2 = "SELECT concat(site_no, ', ' ,street,' Dr') AS address, store_id FROM STORE WHERE address_id = '$address_id'"; 
                    $data2 = $con->query($query2);
                    $data2->setFetchMode(PDO::FETCH_ASSOC);


                    foreach ($data2 as $row) { 
                      $store_id = $row['store_id'];

                      print "<option value=$store_id>";
                      print $row['address'] . ", ".  $city .", ". $zip;
                      print "</option>";
                    }
                  }
                }
                catch(PDOException $ex) {
                  echo 'ERROR: '.$ex->getMessage();
                }        

                print ' </select>
              </div>
            </div>
          </div>';
          ?>


          <!-- car type -->
          <div class="form-group"> 
            <label class="col-md-4 control-label">Car Type</label>
            <div class="col-md-4 selectContainer">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                <select name="car_type" class="form-control selectpicker" >
                  <option value="Sedan">Sedan</option>
                  <option value="SUV">SUV</option>
                  <option value="Convertible">Convertible</option>
                  <option value="Van">Van</option>
                  <option value="Truck">Truck</option>
                </select>
              </div>
            </div>
          </div>

          <!--dates-->
          <div class="form-group">
            <label class="col-md-4 control-label">Dates</label>  
            <div class="col-md-4 inputGroupContainer">
             <div class='input-group date' id='datetimepicker1'>
               <span class="input-group-addon">
                <span name="daterange" class="glyphicon glyphicon-calendar"></span>
              </span>
              <p>Date From :
                <input type="text" id="from_date" name="from_date"  />
              </p>
              <p>Date To :
                <input type="text" id="to_date" name="to_date"  />
              </p>
              <p>Rental Days :
                <input type="text" id="rental_days" name="rental_days" />
              </p>
            </div>
          </div>
        </div>

          <script type='text/javascript'>//<![CDATA[


          </script>



          <!-- Button -->
          <div class="form-group">
            <label class="col-md-4 control-label"></label>
            <div class="col-md-4">
              <button type="submit" class="btn btn-warning" >Reserve <span class="glyphicon glyphicon-send"></span></button>
            </div>
          </div>

        </fieldset>
      </form>
    </div>



  </div><!-- /.container -->

</body>
</html>