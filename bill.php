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

  <title>Booking Details</title>

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
    session_start();
    require_once 'db_config.php';




    $first_name = filter_input(INPUT_GET, "first_name");
    $last_name  = filter_input(INPUT_GET, "last_name");
    $email  = filter_input(INPUT_GET, "email");
    $phone  = filter_input(INPUT_GET, "phone");
    $gender  = filter_input(INPUT_GET, "gender");
    $license_no  = filter_input(INPUT_GET, "license_no");

      $query1 = "SELECT email, customer_id FROM Customer WHERE email='$email'";
      $data = $con->query($query1);
      if($data->rowCount() > 0){
        foreach ($data as $row) { 
          $customer_id = $row['customer_id'];
          print "Customer id exists: ". $customer_id;
        }
      }
      else{
        $query2 = "SELECT MAX(customer_id) AS max_cust_id FROM Customer";
        $data = $con->query($query2);
        foreach ($data as $row) { 
          $max_cust_id = $row['max_cust_id'];
        }

    // Constrain the query if we got first and last names.
        if ((strlen($first_name) > 0) && (strlen($last_name) > 0) && (strlen($email) > 0)) {
          $query = "INSERT INTO customer (customer_id,first_name,last_name,email,gender,license_no) VALUES ('$max_cust_id'+1,'$first_name', '$last_name','$email','$gender','$license_no')";
          $_SESSION['customer_id'] = $max_cust_id+1;
          $con->query($query);
          //echo "New record created successfully";
        }
      }


      $from_date  = filter_input(INPUT_GET, "from_date");
      $to_date  = filter_input(INPUT_GET, "to_date");
      $car_type  = filter_input(INPUT_GET, "car_type");
      $rental_days  = filter_input(INPUT_GET, "rental_days");
      $store_id  = filter_input(INPUT_GET, "store_id");

      $_SESSION['from_date'] = $from_date;
      $_SESSION['to_date'] = $to_date;
      $_SESSION['rental_days'] = $rental_days;
      $_SESSION['store_id'] = $store_id;


      try {

        $rate_query = "SELECT base_rate FROM type WHERE type = '$car_type'";
        $data = $con->query($rate_query); 
        $data->setFetchMode(PDO::FETCH_ASSOC);
        foreach ($data as $row) { 
          $base_rate = $row['base_rate'];
        }

        $plan_query = "SELECT level,discount FROM plan WHERE type = '$car_type' AND rented_days>='$rental_days'";

        $data = $con->query($plan_query); 
        $data->setFetchMode(PDO::FETCH_ASSOC);
        foreach ($data as $row) { 
          $level = $row['level'];
          $discount = $row['discount'];
        }


        $total_cost = $base_rate * $rental_days;
        $discount_amount = $discount * $total_cost/100;
        $final_cost = $total_cost - $discount_amount;

        $_SESSION['total_cost'] = $total_cost;
        $_SESSION['discount_amount'] = $discount_amount;
        $_SESSION['final_cost'] = $final_cost;
        $_SESSION['level'] = $level;
        $_SESSION['car_type'] = $car_type;

      // We're going to construct an HTML table.
        print '<div class="table-responsive">  <table class="table table-striped">';
        print "<tr>\n";

        print "<th>From Date</th>";
        print "<th>To Date</th>";
        print "<th>Rental Days</th>";
        print "<th>Rate per day</th>";
        print "<th>Cost</th>";
        print "<th>Car Type</th>";
        print "<th>Plan</th>";
        print "<th>Discount</th>";
        print "<th>Final_Cost</th>";

        print "</tr>\n";

        print "<tr>\n";

        print "<td>$from_date</td>";
        print "<td>$to_date</td>";
        print "<td>$rental_days</td>";
        print "<td>$$base_rate</td>";
        print "<td>$$total_cost</td>";
        print "<td>$car_type</td>";
        print "<td>$level</td>";
        print "<td>$discount"."%</td>";
        print "<td>$$final_cost</td>";
        print "</th>";

        print "</tr>\n";

        print "</table></div>\n";

        print '<form action="confirm.php"><center><button class="btn btn-warning">Confirm</button></form>';
        $query = "SELECT brand,model,type,no_of_passengers,no_of_bags FROM car_details WHERE type='$car_type'";

      // Fetch the database field names.
        $result = $con->query($query);
        $row = $result->fetch(PDO::FETCH_ASSOC);

        print '<h2 class="sub-header">One of the following cars will be reserved for you</h2>';
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

          $car_query = "SELECT car_vin FROM ALL_CARS a, CAR_DETAILS c WHERE c.type = '$car_type' AND a.car_id = c.car_id ORDER BY RAND() LIMIT 1";
          $data = $con->query($car_query);
          $row = $result->fetch(PDO::FETCH_ASSOC);

          foreach ($data as $row) { 
            $car_vin = $row['car_vin'];
          }
          $_SESSION['car_vin'] = $car_vin;
        }
        catch(PDOException $ex) {
          echo 'ERROR: '.$ex->getMessage();
        }        

        ?>

      </div>
    </body>
