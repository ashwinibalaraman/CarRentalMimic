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

require_once 'db_config.php';
session_start();

$reservation_id = filter_input(INPUT_GET, "reservation_id");

try {

  /************************/

  /**OO Class for customer details***/
  class Customer
  {
    public $customer_id;
    private $first_name;
    private $last_name;
    private $email;
    private $customer_points;
    private $license_no;

    public function getCustomerId()     { return $this->customer_id; }
    public function getfirst_name()  { return $this->first_name; }
    public function getlast_name()   { return $this->last_name; }
    public function getemail() { return $this->email; }
    public function getcustomer_points() { return $this->customer_points; }
    public function getlicense_no() { return $this->license_no; }

  }

                //OO CLASS FOR CUSTOMER-RESERVATION_STORE JOIN DETAILS
  class Cust_Reserve_Store_Car
  {
    private $reservation_id;
    private $customer_id;
    private $first_name;
    private $last_name;
    private $email;
    private $store_name;
    private $car_vin;
    private $car_type;
    private $brand;
    private $model;
    private $from_date;
    private $to_date;
    private $rental_days;
    private $total_cost;

    public function getreservation_id()     { return $this->reservation_id; }
    public function getcustomer_id()     { return $this->customer_id; }
    public function getfirst_name()  { return $this->first_name; }
    public function getlast_name()   { return $this->last_name; }
    public function getemail()   { return $this->email; }
    public function getstore_name() { return $this->store_name; }
    public function getcar_vin() { return $this->car_vin; }
    public function getcar_type() { return $this->car_type; }
    public function getbrand() { return $this->brand; }
    public function getmodel() { return $this->model; }
    public function getfrom_date() { return $this->from_date; }
    public function getto_date() { return $this->to_date; }
    public function getbill_amount() { return $this->bill_amount; }
    public function getrental_days() { return $this->rental_days; }

  }     

  function createCustomerTable(Customer $customer){
    print "        <tr>\n";
    print "        <td>" . $customer->getfirst_name()  . "</td>\n";
    print "        <td>" . $customer->getlast_name()   . "</td>\n";
    print "        <td>" . $customer->getemail() . "</td>\n";
    print "        </tr>\n";
  }


  function createCustomerReservationTable(Cust_Reserve_Store_Car $cust_reserve_store_car){
    print "        <tr>\n";
    print "        <td>" . $cust_reserve_store_car->getreservation_id()    . "</td>\n";
    print "        <td>" . $cust_reserve_store_car->getcustomer_id()    . "</td>\n";
    print "        <td>" . $cust_reserve_store_car->getfirst_name()  . "</td>\n";
    print "        <td>" . $cust_reserve_store_car->getlast_name()   . "</td>\n";
    print "        <td>" . $cust_reserve_store_car->getemail()   . "</td>\n";
    print "        <td>" . $cust_reserve_store_car->getstore_name() . "</td>\n";
    print "        <td>" . $cust_reserve_store_car->getcar_vin() . "</td>\n";
    print "        <td>" . $cust_reserve_store_car->getcar_type() . "</td>\n";
    print "        <td>" . $cust_reserve_store_car->getbrand() . "</td>\n";
    print "        <td>" . $cust_reserve_store_car->getmodel() . "</td>\n";
    print "        <td>" . $cust_reserve_store_car->getfrom_date() . "</td>\n";
    print "        <td>" . $cust_reserve_store_car->getto_date() . "</td>\n";
    print "        <td>" . $cust_reserve_store_car->getbill_amount() . "</td>\n";
    print "        <td>" . $cust_reserve_store_car->getrental_days() . "</td>\n";
    print "        </tr>\n";
  }


  $query1="UPDATE Reservation SET add_on_id =:add_on_id
              WHERE reservation_id =:reservation_id";

               print '<div class="table-responsive">  <table class="table table-striped">';

              $result = $con->prepare($query1);
              $result->bindParam(':add_on_id',$add_on_id);
              $result->bindParam(':reservation_id',$reservation_id);
              $result->execute();
              $row = $result->fetch(PDO::FETCH_ASSOC);
                
              $query2= "SELECT * FROM Reservation where reservation_id=:reservation_id";
              $result2 = $con->prepare($query2);
              $result2->bindParam(':reservation_id',$reservation_id);
              $result2->execute();
              $row = $result2->fetch(PDO::FETCH_ASSOC);  
               // Construct the header row of the HTML table.
              print "            <tr>\n";
              foreach ($row as $field => $value) {
                print "                <th>$field</th>\n";
              }
              print "            </tr>\n";
    

              $ps=$con->prepare($query1);
              $ps->bindParam(':customer_id',$customer_id);
              $ps->execute();
              $ps->setFetchMode(PDO::FETCH_CLASS, "Cust_Reserve_Store_Car");
              while ($cust_reserve_store_car = $ps->fetch()) {
                createCustomerReservationTable($cust_reserve_store_car);
              }

              print"</table><br>\n";


}
catch(PDOException $ex) {
  echo 'ERROR: '.$ex->getMessage();
}        
?>

 </div>
    </body>