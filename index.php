<!DOCTYPE html>
<html lang="en">
<head>


  <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
  <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />

  <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../favicon.ico">

  <title>Dashboard Template for Bootstrap</title>

  <!-- Custom styles for this template -->
  <link href="dashboard.css" rel="stylesheet">
</head>

<body ng-app="">

  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.18/angular.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.18/angular-route.min.js"></script></span>

  <div ng-include='"nav_bars.php"'></div>

 
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Datamass Car Rental</h1>

        <div class="row placeholders">
          <div class="col-xs-6 col-sm-3 placeholder">
            <img src="images/sedan.jpg" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
            <h4>Sedan</h4>
            <span class="text-muted">As low as $120</span>
          </div>
          <div class="col-xs-6 col-sm-3 placeholder">
            <img src="images/convertible.jpg" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
            <h4>Convertible</h4>
            <span class="text-muted">As low as $200</span>
          </div>
          <div class="col-xs-6 col-sm-3 placeholder">
            <img src="images/suv.jpg" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
            <h4>SUV</h4>
            <span class="text-muted">As low as $185</span>
          </div>

          <div class="col-xs-6 col-sm-3 placeholder">
            <img src="images/truck.jpg" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
            <h4>Truck</h4>
            <span class="text-muted">As low as $155</span>
          </div>
        </div>

        <div class="container">

          <form class="well form-horizontal" action="reserve.php" method="get"  id="contact_form">
            <fieldset>
              <!-- Select State -->

              <?php

              require_once 'db_config.php';

              print '<div class="form-group"> 
              <label class="col-md-4 control-label">State</label>
              <div class="col-md-4 selectContainer">
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                  <select name="state" class="form-control selectpicker">';

                    try {

                      $query = "SELECT DISTINCT(state) FROM BASE_ADDRESS ORDER BY state";  

                      $data = $con->query($query);
                      $data->setFetchMode(PDO::FETCH_ASSOC);


                      foreach ($data as $row) { 
                        foreach ($row as $name => $value) {
                         
                             
                              print "<option> $value </option>";
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


              <!-- Button -->
              <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-4">
                  <button type="submit" class="btn btn-warning" value="Submit">Proceed <span class="glyphicon glyphicon-send"></span></button>
                </div>
              </div>

            </fieldset>
          </form>

           <?php

require_once 'db_config.php';

try {
    
    $query = "SELECT level as Plan_Level, type as When_you_select_car_type, rented_days as When_you_select_for_more_than_these_days, concat(discount,'%') as You_get_a_discount_of  FROM Plan ORDER BY level";
    $result = $con->query($query);
        $row = $result->fetch(PDO::FETCH_ASSOC);

        print '<h2 class="sub-header">Take advantage of our attractive plans</h2>';
        print '<div class="table-responsive">  <table class="table table-striped">'; 
      // Construct the header row of the HTML table.
        print "<tr>\n";
        foreach ($row as $field => $value) {
          print "<th>$field</th>\n";
        }
        print "</tr>\n";

        $data = $con->query($query); 
        $data->setFetchMode(PDO::FETCH_ASSOC);
    // Construct the HTML table row by row.
        foreach ($data as $row) { 
          print " <tr>\n";
          foreach ($row as $name => $value) {
            print " <td>$value</td>\n"; }
            print " </tr>\n"; 
          }

          print "</table></div>\n";

}
catch(PDOException $ex) {
  echo 'ERROR: '.$ex->getMessage();
}        
?>
        </div>

        <br/><br/>

      </div>
    </div>
    </div>
</div>




</body>
</html>
