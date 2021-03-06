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
        private $quarter;
        private $month;
        private $sum;

        public function getYear()     { return $this->year; }
        public function getQuarter()  { return $this->quarter; }
        public function getMonth()  { return $this->month; }
        public function getSum()   { return $this->sum; }

      }

      function createQueryResult(Query1 $query1){
        print "        <tr>\n";
        print "        <td>" . $query1->getYear()  . "</td>\n";
        print "        <td>" . $query1->getQuarter()   . "</td>\n";
        print "        <td>" . $query1->getMonth()   . "</td>\n";
        print "        <td>" . $query1->getSum() . "</td>\n";
        print "        </tr>\n";
      }
      
      $quarter = $_GET['quarter'];
      $year = $_GET['year'];
      require_once 'db_config.php';
      $query1 = "SELECT d.year, d.quarter, d.month, sum(p.bill_amount) AS sum 
                 FROM fact_reservation_bookings p, dim_store s, dim_time d, dim_car c 
                 WHERE c.car_key = p.car_key AND p.time_key = d.time_key AND d.year= '$year' AND d.quarter='$quarter'
                 GROUP By d.year, d.quarter, d.month ORDER BY d.year, d.quarter, d.month";

      print "<a href='query1.php?year=$year'>Drill Up</a>";

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