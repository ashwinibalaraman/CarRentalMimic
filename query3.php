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

  <title>Reservation Confirmed</title>

  <!-- Custom styles for this template -->
  <link href="dashboard.css" rel="stylesheet">
</head>

<body ng-app="">

  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.18/angular.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.18/angular-route.min.js"></script></span>

  <div ng-include='"nav_bars.php"'></div>


  <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h2 class="sub-header">Booking Details</h2>

  <?php
    
    //require_once 'db_config.php';

    try {

      class Query1
      {
        public $year;
        private $sum;

        public function getYear()     { return $this->year; }
        public function getSum()   { return $this->sum; }

      }

      function createQueryResult(Query1 $query1){
        print "        <tr>\n";
        print "        <td>" . $query1->getYear()  . "</td>\n";
        print "        <td>" . $query1->getSum() . "</td>\n";
        print "        </tr>\n";
      }


      $query1 = "SELECT d.year, sum(p.bill_amount) AS sum 
                 FROM fact_reservation_bookings p, dim_store s, dim_time d, dim_car c 
                 WHERE c.car_key = p.car_key AND p.time_key = d.time_key 
                 GROUP By d.year  
                 ORDER BY d.year";

      require_once 'db_config.php';

      $ps1=$con2->prepare($query1);
      $ps1->execute();
      $ps1->setFetchMode(PDO::FETCH_CLASS, "Query1");

      print"Drill Down on:  ";
      print '<div class="form-group"> 
              <label >Years</label>
              
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                  <select name="option" class="form-control selectpicker" onChange="window.location.href=this.value">';
      while ($qry = $ps1->fetch()) {
        $year = $qry->getYear();
        print "<option value ='query1.php?year=$year'> $year</option>";
      }

       print "</select>
                  </div>
                
              </div>";
      print '<div class="table-responsive">  <table class="table table-striped">';



      $result = $con2->prepare($query1);
      $result->execute();
      $row = $result->fetch(PDO::FETCH_ASSOC);
            
       // Construct the header row of the HTML table.
      print "            <tr>\n";
      foreach ($row as $field => $value) {
        print "                <th>$field</th>\n";
      }
      print "            </tr>\n";


      $ps=$con2->prepare($query1);
      $ps->execute();
      $ps->setFetchMode(PDO::FETCH_CLASS, "Query1");
      while ($qery1 = $ps->fetch()) {
        createQueryResult($qery1);
      }

      print"</table><br>\n";         

  } catch(PDOException $ex) {
    echo 'ERROR: '.$ex->getMessage();
  } 

?>


 </div>
    </body>