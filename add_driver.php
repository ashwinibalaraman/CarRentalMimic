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

    <h2 class="sub-header">Booking Details With Add On Driver Details</h2>
    <?php
    session_start();
    require_once 'db_config.php';



 try {

    class Cust_Reserve
  {
    private $reservation_id;
    private $customer_id;
    private $customer_name;
    private $email;
    private $add_on_name;
    private $add_on_email;
    private $store_name;
    private $car_vin;
    private $car_type;
    private $brand;
    private $model;
    private $from_date;
    private $to_date;
    private $rental_days;
    private $bill_amount;

    public function getreservation_id()     { return $this->reservation_id; }
    public function getcustomer_id()     { return $this->customer_id; }
    public function getcustomer_name()  { return $this->customer_name; }
    public function getemail()   { return $this->email; }
    public function getadd_on_name()  { return $this->add_on_name; }
    public function getadd_on_email()  { return $this->add_on_email; }
    public function getstore_name() { return $this->store_name; }
    public function getcar_vin() { return $this->car_vin; }
    public function getcar_type() { return $this->car_type; }
    public function getbrand() { return $this->brand; }
    public function getmodel() { return $this->model; }
    public function getfrom_date() { return $this->from_date; }
    public function getto_date() { return $this->to_date; }
    public function getrental_days() { return $this->rental_days; }
    public function getbill_amount() { return $this->bill_amount; }

  }     

function createCustomerReservationTable(Cust_Reserve $cust_reserve){
    print "        <tr>\n";
    print "        <td>" . $cust_reserve->getreservation_id()    . "</td>\n";
    print "        <td>" . $cust_reserve->getcustomer_id()    . "</td>\n";
    print "        <td>" . $cust_reserve->getcustomer_name()  . "</td>\n";
    print "        <td>" . $cust_reserve->getemail()   . "</td>\n"; 
    print "        <td>" . $cust_reserve->getadd_on_name()  . "</td>\n";
    print "        <td>" . $cust_reserve->getadd_on_email()   . "</td>\n";
    print "        <td>" . $cust_reserve->getstore_name() . "</td>\n";
    print "        <td>" . $cust_reserve->getcar_vin() . "</td>\n";
    print "        <td>" . $cust_reserve->getcar_type() . "</td>\n";
    print "        <td>" . $cust_reserve->getbrand() . "</td>\n";
    print "        <td>" . $cust_reserve->getmodel() . "</td>\n";
    print "        <td>" . $cust_reserve->getfrom_date() . "</td>\n";
    print "        <td>" . $cust_reserve->getto_date() . "</td>\n";
    print "        <td>" . $cust_reserve->getrental_days() . "</td>\n";
    print "        <td>" . $cust_reserve->getbill_amount() . "</td>\n";
    print "        </tr>\n";
  }

    $first_name = filter_input(INPUT_GET, "first_name");
    $last_name  = filter_input(INPUT_GET, "last_name");
    $email  = filter_input(INPUT_GET, "email");
    $reservation_id  = filter_input(INPUT_GET, "reservation_id");
    

      $query1 = "SELECT email, customer_id FROM Customer WHERE email='$email'";
      $data = $con->query($query1);
      if($data->rowCount() > 0){
        foreach ($data as $row) { 
          $customer_id = $row['customer_id'];
          //print "Customer id exists: ". $customer_id;
        }
      }
      else{
        $query2 = "SELECT MAX(customer_id) AS max_cust_id FROM Customer";
        $data = $con->query($query2);
        foreach ($data as $row) { 
          $max_cust_id = $row['max_cust_id'];

          if ((strlen($first_name) > 0) && (strlen($last_name) > 0) && (strlen($email) > 0)) {
          $query = "INSERT INTO customer (customer_id,first_name,last_name,email) VALUES ('$max_cust_id'+1,'$first_name', '$last_name','$email')";
          $_SESSION['customer_id'] = $max_cust_id+1;

          $con->query($query);
          $customer_id = $max_cust_id+1;
          //echo "New record created successfully";
        }
        }
        
      }

    $update_query = "UPDATE RESERVATION SET add_on_id = $customer_id WHERE reservation_id = $reservation_id";
        
        $result = $con->prepare($update_query);
        //$result->bindParam(':reservation_id',$reservation_id);
        $result->execute();
     

        
        
        $query1="SELECT r.reservation_id, r.customer_id, concat(c.first_name, c.last_name) customer_name, c.email, concat(a.first_name,a.last_name) as add_on_name, a.email as add_on_email, concat(s.site_no,',',s.street) as store_name, r.car_vin, car.type as car_type,car.brand,car.model,r.from_date,r.to_date,r.rental_days,r.bill_amount
              FROM  Reservation r JOIN Car_Details car JOIN ALL_CARS allcar JOIN Store s JOIN Customer c 
ON (c.customer_id = r.customer_id)
JOIN Customer a 
ON (a.customer_id = r.add_on_id)
              WHERE r.car_vin =allcar.car_vin AND allcar.car_id = car.car_id AND r.store_id=s.store_id AND r.reservation_id =:reservation_id";

         print '<div class="table-responsive">  <table class="table table-striped">';

              $result1 = $con->prepare($query1);
              $result1->bindParam(':reservation_id',$reservation_id);
              $result1->execute();
              $row = $result1->fetch(PDO::FETCH_ASSOC);
                    
               // Construct the header row of the HTML table.
              print "            <tr>\n";
              foreach ($row as $field => $value) {
                print "                <th>$field</th>\n";
              }
              print "            </tr>\n";
    

              $ps=$con->prepare($query1);
              $ps->bindParam(':reservation_id',$reservation_id);
              $ps->execute();
              $ps->setFetchMode(PDO::FETCH_CLASS, "Cust_Reserve");
              while ($cust_reserve = $ps->fetch()) {
                createCustomerReservationTable($cust_reserve);
              }

              print"</table><br>\n";

        }
        catch(PDOException $ex) {
          echo 'ERROR: '.$ex->getMessage();
        }        

        ?>

      </div>
    </body>
