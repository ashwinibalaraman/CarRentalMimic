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
    <h4><u> Top Stores in California which bought new cars in 2016: </u></h4>

  <?php
    
    //require_once 'db_config.php';

    try {

      class Query1
      {
        public $street;
        private $city;
        private $new_cars;

        public function getStreet()     { return $this->street; }
        public function getCity()  { return $this->city; }
        public function getNewCars()   { return $this->new_cars; }
        //public function getAreaEarning()   { return $this->area_earning; }

      }

      function createQueryResult(Query1 $query1){
        print "        <tr>\n";
        print "        <td>" . $query1->getStreet()  . "</td>\n";
        print "        <td>" . $query1->getCity()   . "</td>\n";
        print "        <td>" . $query1->getNewCars() . "</td>\n";
        //print "        <td>" . $query1->getAreaEarning() . "</td>\n";
        print "        </tr>\n";
      }

      require_once 'db_config.php';
      $query1 = "SELECT s.street, s.city, COUNT(f.car_key) as new_cars 
				 FROM fact_car_purchase f, dim_store s, dim_time t 
                 WHERE f.store_key = s.store_key AND s.state = 'California' AND f.time_key = t.time_key AND t.year = 2016 
                 GROUP BY f.store_key 
                 HAVING new_cars > 5 
                 Order by new_cars DESC ";

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