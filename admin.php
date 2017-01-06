<?php
session_start();
?>
<head>
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css" rel="stylesheet">



  <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />

  <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
  <!-- Custom styles for this template -->
  <link href="admin.css" rel="stylesheet">
  <!--Script for tabs-->
   <script type="text/javascript">
  function showStuff (id)
  {

        document.getElementById("t1").style.display = "none";
        document.getElementById("t2").style.display = "none";
        document.getElementById("t3").style.display = "none";
        document.getElementById("t4").style.display = "none";
        document.getElementById("t5").style.display = "none";
        document.getElementById("t6").style.display = "none";
        document.getElementById("c1").style.display = "none";
        document.getElementById("c2").style.display = "none";
        document.getElementById("c3").style.display = "none";
        document.getElementById("c4").style.display = "none";
        document.getElementById("c5").style.display = "none";
        document.getElementById("c6").style.display = "none";
        // document.getElementById("t6").style.display = "none";
        document.getElementById(id).style.display = "block";

  }

  function showContent (id)
  {

        document.getElementById("c1").style.display = "none";
        document.getElementById("c2").style.display = "none";
        document.getElementById("c3").style.display = "none";
        document.getElementById("c4").style.display = "none";
        document.getElementById("c5").style.display = "none";
        document.getElementById("c6").style.display = "none";
        // document.getElementById("t6").style.display = "none";
        document.getElementById(id).style.display = "block";

  }

  </script>
</head>
<div class="container">

  <form class="well form-horizontal"  method="post"  id="contact_form">
    <fieldset>

      <!-- Form Name -->
    <legend>  <span class="backtab" ><a href="index.php" style="color:#581845;"><i class="glyphicon glyphicon-chevron-left"></i>BACK</a></span><h1 style="text-align:center;color:031D7C;">Welcome to the <i class="glyphicon glyphicon-user"></i> Admin Dashboard</h1></legend>

      <!-- Text input-->
      <h2 style="text-align:center;color:4EC5E2;">Search from the Menu</h2>
      <div class="form-group">
        <label class="col-md-2 control-label"></label>
        <!-- <div class="col-md-4 inputGroupContainer"> -->
          <div class="input-group">
            <!-- <span class="input-group-addon"></span> -->
               <ul class="nav nav-tabs">
                  <!-- <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" >Reservations -->
                  <!-- <span class="caret"></span></a> -->
                    <!-- <ul class="dropdown-menu"> -->
                      <li id="tab1" onclick = "showStuff('t1')"><a href="#">Date</a></li>
                      <li id="tab2" onclick = "showStuff('t2')"><a href="#">Store Location</a></li>
                      <li id="tab3" onclick = "showStuff('t3')"><a href="#"> Car Model</a></li>
                     <!-- </ul> -->
                   <!-- </li> -->
                 <li id="tab5" onclick = "showStuff('t5')"><a href="#">Sales-Information</a></li>
                 <li id="tab6" onclick = "showStuff('t6')"><a href="#">Customer Point Updates</a></li>
                 <!-- <li id="tab6" onclick = "showStuff('t6')"><a href="#">Customers-Information</a></li> -->
               </ul>
          <!-- </div> -->
        </div>
      </div>

      <!-- Text input-->
      <!-- Display Reservations by Date-->
      <div  class="form-group" id="t1" style="display:none">
      <div class="form-group" >

        <label class="col-md-4 control-label" ><h2>Search Reservations By Date</h2></label>
        <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
            <!-- <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span> -->
            <div class="tab-content"   >
              <h5><label for="fdate"> Enter Date</label></h5>
              <input name="date" id="fdate" placeholder="E.g yyyy-mm-dd" class="form-control"  type="text"/>
            </div>
          </div>
        </div>
      </div>
      <br>
      <!-- Button -->
      <div class="form-group" >
        <label class="col-md-4 control-label"></label>
        <div class="col-md-4">
          <div class="button">

          <button type="submit" class="btn btn-warning" onclick = "showContent('c1')">Search<span class="glyphicon glyphicon-send"></span></button>

        </div>
        </div>
      </div>
      </div>
      <div class="tab1content" id="c1">
      <?php

              require_once 'db_config.php';


              $r_date = filter_input(INPUT_POST, "date");


              //Query 1 starts here......
              $query1="SELECT r.reservation_id as Reservation_ID,concat(cu.first_name,' ',cu.last_name) as Customer_Name,ca.brand as Car_Type,concat(s.street,char(13),b.city,char(13),b.state,char(13),b.zip) as Store_Address,r.from_date as Date,r.plan_level as Type_of_Car_Plan
              FROM customer cu,reservation r,car_details ca,store s,base_address b,all_cars al
              WHERE r.car_vin=al.car_vin and al.car_id=ca.car_id and r.customer_id=cu.customer_id and r.store_id=s.store_id and s.address_id=b.address_id and r.from_date='$r_date'";

              $result = $con->query($query1);
                $row = $result->fetch(PDO::FETCH_ASSOC);

                // print "<h2 class="sub-header">Reservations on $r_date</h2>";
                if($result->rowCount() > 0){
                print '<div class="table-responsive">  <table class="table table-striped">';
              // Construct the header row of the HTML table.
                print "<tr>\n";
                foreach ($row as $field => $value) {
                  print "<th>$field</th>\n";
                }


                print "</tr>\n";
              }

                $data = $con->query($query1);
                $data->setFetchMode(PDO::FETCH_ASSOC);
              // Construct the HTML table row by row.
              if($data->rowCount() > 0){

                foreach ($data as $row) {
                  print " <tr>\n";
                  foreach ($row as $name => $value) {
                    print " <td>$value</td>\n"; }
                    print " </tr>\n";
                  }

                  print "</table></div>\n";

              }

              // else{
              //   print "<p>There are no reservations for the selected date.\n Please try entering another date</p>";
              //   }
                 //Query1 ends here........
                  ?>
    </div>

         <!--Display Reservations by Store or Location-->
         <div class="form-group " id="t2" style="display:none" >
         <div class="form-group "  >
           <label class="col-md-4 control-label" ><h2>Search Reservations By Store Name</h2></label>
           <div class="col-md-4 inputGroupContainer">
             <div class="input-group">
               <!-- <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span> -->


                <h5>  <label for="rstore">Select store location</label></h5>
                 <!-- <input name="Store" id="store" placeholder="E.g 95112" class="form-control"  type="text"/> -->
                  <select name="store_name" id="rstore" class="form-control selectpicker" >
                   <option value=" " >Please select a store name</option>
                   <option value="Alabama">Alabama</option>
                   <option value="Alaska">Alaska</option>
                   <option value="Arizona">Arizona</option>
                   <option value="Arkansas">Arkansas</option>
                   <option value="California">California</option>
                   <option value="Colorado">Colorado</option>
                   <option value="Connecticut">Connecticut</option>
                   <option value="Delaware">Delaware</option>
                   <option value="District of Columbia">District of Columbia</option>
                   <option value="Florida"> Florida</option>
                   <option value="Georgia">Georgia</option>
                   <option value="Hawaii">Hawaii</option>
                   <option value="Idaho">Idaho</option>
                   <option value="Illinois">Illinois</option>
                   <option value="Indiana">Indiana</option>
                   <option value="Iowa">Iowa</option>
                   <option value="Kansas"> Kansas</option>
                   <option value="Kentucky">Kentucky</option>
                   <option value="Louisiana">Louisiana</option>
                   <option value="Maine">Maine</option>
                   <option value="Maryland">Maryland</option>
                   <option value="Mass"> Mass</option>
                   <option value="Michigan" >Michigan</option>
                   <option value="Minnesota" >Minnesota</option>
                   <option value="Mississippi">Mississippi</option>
                   <option value="Missouri">Missouri</option>
                   <option value="Montana">Montana</option>
                   <option value="Nebraska">Nebraska</option>
                   <option value="Nevada">Nevada</option>
                   <option value="New Hampshire">New Hampshire</option>
                   <option value="New Jersey">New Jersey</option>
                   <option value="New Mexico">New Mexico</option>
                   <option value="New York">New York</option>
                   <option value="North Carolina">North Carolina</option>
                   <option value="North Dakota">North Dakota</option>
                   <option value="Ohio<">Ohio</option>
                   <option value="Oklahoma">Oklahoma</option>
                   <option value="Oregon">Oregon</option>
                   <option value="Pennsylvania">Pennsylvania</option>
                   <option value="Rhode Island">Rhode Island</option>
                   <option value="South Carolina">South Carolina</option>
                   <option value="South Dakota">South Dakota</option>
                   <option value="Tennessee">Tennessee</option>
                   <option value="Texas">Texas</option>
                   <option value="Utah"> Utah</option>
                   <option value="Vermont">Vermont</option>
                   <option value="Virginia">Virginia</option>
                   <option value="Washington" >Washington</option>
                   <option value="West Virginia">West Virginia</option>
                   <option value="Wisconsin">Wisconsin</option>
                   <option value="Wyoming">Wyoming</option>
                 </select>

             </div>
           </div>
         </div>
         <br/>
         <!-- Button -->
         <div class="form-group" >
           <label class="col-md-4 control-label"></label>
           <div class="col-md-4">
             <div class="button">
             <button type="submit" class="btn btn-warning" >Search <span class="glyphicon glyphicon-send"></span></button>
           </div>
         </div>
         </div>
       </div>
         <div class="tab2content" id="c2">
         <?php
          //  session_start();
           require_once 'db_config.php';

$state = filter_input(INPUT_POST, "store_name");
//Query2 starts here......
$query2="SELECT s.store_id as Store_ID,s.no_of_employees as Number_of_Employees_at_the_Store,r.from_date as Date,concat(cu.first_name,' ',cu.last_name) as Customer_Details_,cu.points asCustomer_Points,al.availability
FROM store s,customer cu,all_cars al,reservation r,base_address b
WHERE s.address_id=b.address_id and s.store_id=r.store_id and r.customer_id=cu.customer_id and r.car_vin=al.car_vin and b.state='$state'
ORDER BY s.store_id ASC,r.from_date DESC,cu.points DESC,al.availability DESC";
$result = $con->query($query2);
  $row = $result->fetch(PDO::FETCH_ASSOC);

  // print "<h2 class="sub-header">Reservations in $store</h2>";
    if($result->rowCount() > 0){
  print '<div class="table-responsive">  <table class="table table-striped">';
// Construct the header row of the HTML table.
  print "<tr>\n";
  foreach ($row as $field => $value) {
    print "<th>$field</th>\n";
  }
  print "</tr>\n";
}
  $data = $con->query($query2);
  $data->setFetchMode(PDO::FETCH_ASSOC);
// Construct the HTML table row by row.
if($data->rowCount() > 0){

  foreach ($data as $row) {
    print " <tr>\n";
    foreach ($row as $name => $value) {
      print " <td>$value</td>\n"; }
      print " </tr>\n";
    }

    print "</table></div>\n";

}
// else{
//   print "<p>There are no reservations for the selected location.\n Please make a valid selection</p>";
//   }
   //Query2 ends here........
   ?>
       </div>
         <!--Display Reservations by Car Model-->
         <div class="form-group" id="t3" style="display:none">
         <div class="form-group" >
            <label class="col-md-4 control-label" ><h2>Search Reservations By Car Brand</h2></label>
           <div class="col-md-4 inputGroupContainer">
             <div class="input-group">
               <!-- <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span> -->
               <!-- <div > -->

                <h5> <label for="mod"> Enter the Car Brand</label></h5>
                 <select name="model" id="mod"class="form-control selectpicker" >
                   <option value=" " >Please select a brand</option>
                   <option value="Nissan">Nissan</option>
                   <option value="BMW">BMW</option>
                   <option value="Honda">Honda</option>
                   <option value="Toyota">Toyota</option>
                   <option value="Ford">Ford</option>
                   <option value="Kia">Kia</option>
                   <option value="Audi">Audi</option>
                   <option value="Chevrolet">Chevrolet</option>
                   <option value="Jeep">Jeep</option>
                   <option value="Mercedes"> Mercedes</option>
                 </select>
                 <!-- <input name="model" id="model" placeholder="E.g Honda,Toyota,Chrevolet,Nissan,BMW,Mercedes,Kia,Ford.." class="form-control"  type="text"/> -->
               <!-- </div> -->
             </div>
           </div>
         </div>
           <br/>
         <!-- Button -->
         <div class="form-group" >
           <label class="col-md-4 control-label"></label>
           <div class="col-md-4">
             <div class="button">
             <button type="submit" class="btn btn-warning" >Search <span class="glyphicon glyphicon-send"></span></button>
           </div>
         </div>
         </div>
       </div>
         <div class="tab3content" id="c3">
         <?php
          //  session_start();
           require_once 'db_config.php';
$car=filter_input(INPUT_POST,"model");
         //Query3 starts here.........
       $query3="SELECT ca.model as Car_Model,ca.type as Car_Type,ca.no_of_passengers as No_of_Seats,r.plan_level as Plan_Level,p.discount as Discount,r.rental_days asNumber_of_Days_Rented,concat(s.street,',',b.city,char(13),b.state,'-',b.zip) as Store_Location
       FROM store s,car_details ca,base_address b,reservation r,plan p,all_cars al
        WHERE ca.car_id=al.car_id and al.car_vin=r.car_vin and p.level=r.plan_level and p.type=r.type and s.store_id=r.store_id and s.address_id=b.address_id and ca.brand='$car' and al.availability='1'";
        $result = $con->query($query3);
          $row = $result->fetch(PDO::FETCH_ASSOC);

        //  print "<h2 class="sub-header">Reservations on $car</h2>";
            if($result->rowCount() > 0){
          print '<div class="table-responsive">  <table class="table table-striped">';
        // Construct the header row of the HTML table.
          print "<tr>\n";
          foreach ($row as $field => $value) {
            print "<th>$field</th>\n";
          }
          print "</tr>\n";
        }
          $data = $con->query($query3);
          $data->setFetchMode(PDO::FETCH_ASSOC);
        // Construct the HTML table row by row.
        if($data->rowCount() > 0){

          foreach ($data as $row) {
            print " <tr>\n";
            foreach ($row as $name => $value) {
              print " <td>$value</td>\n"; }
              print " </tr>\n";
            }

            print "</table></div>\n";

        }

        // else{
        //   print "<p>There are no reservations under the selected car brand.\n Please make another selection</p>";
        //   }
        //  //Query3 ends here.........
?>
       </div>
         <!-- Display Employees information-->
         <div class="form-group" id="t4" style="display:none">
         <div class="form-group ">
           <label class="col-md-4 control-label" ><h2>Search Employee information</h2></label>
           <div class="col-md-4 inputGroupContainer">
             <div class="input-group">
               <!-- <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span> -->
              <h5> <label for="mon">Enter the month to give the employee details from stores with the highest number of reservations</label></h5>
               <select name="month" id="mon" class="form-control selectpicker" >
                   <option value=" " >Please select a month</option>
                   <option value="01">01</option>
                   <option value="02">02</option>
                   <option value="03">03</option>
                   <option value="04">04</option>
                   <option value="05">05</option>
                   <option value="06">06</option>
                   <option value="07">07</option>
                   <option value="08">08</option>
                   <option value="09">09</option>
                   <option value="10"> 10</option>
                   <option value="11">11</option>
                   <option value="12"> 12</option>
                 </select>


             </div>
           </div>
         </div>
         <br>
         <!-- Button -->
         <div class="form-group">
           <label class="col-md-4 control-label"></label>
           <div class="col-md-4">
             <div class="button">
             <button type="submit" class="btn btn-warning" >Search<span class="glyphicon glyphicon-send"></span></button>
           </div>
           </div>
         </div>
       </div>
         <div class="tab4content" id="c4">
         <?php
          //  session_start();
           require_once 'db_config.php';
           $month=filter_input(INPUT_POST,"month");
           //Query4 starts here........
          $query4="SELECT e.employee_id,concat(e.first_name,' ',e.last_name) as Employee_Name,e.designation as Position,concat(s.street,char(13),b.city,char(13),b.state,char(13),b.zip) as Store_Location,sum(r.rental_days) asTotal_Days_Rented,count(r.discount_amount) as Total_Discount ,avg(r.bill_amount) as Total_Bill_Amount
          FROM reservation r,base_address b,employee e,store s where e.store_id=s.store_id and s.address_id=b.address_id and e.store_id=r.store_id
          and month(r.from_date)='$month'
          GROUP BY e.employee_id";
          $result = $con->query($query4);
            $row = $result->fetch(PDO::FETCH_ASSOC);

            // print "<h2 class="sub-header">Reservations on $month</h2>";
                if($result->rowCount() > 0){
            print '<div class="table-responsive">  <table class="table table-striped">';
          // Construct the header row of the HTML table.
            print "<tr>\n";
            foreach ($row as $field => $value) {
              print "<th>$field</th>\n";
            }
            print "</tr>\n";
          }
            $data = $con->query($query4);
            $data->setFetchMode(PDO::FETCH_ASSOC);
          // Construct the HTML table row by row.
          if($data->rowCount() > 0){

            foreach ($data as $row) {
              print " <tr>\n";
              foreach ($row as $name => $value) {
                print " <td>$value</td>\n"; }
                print " </tr>\n";
              }

              print "</table></div>\n";

          }
          // else{
          //   print "<p>There are no reservations for the selected month.\n Please make another selection</p>";
          //   }
           //Query4 ends here........
           ?>
</div>
         <!-- Display Above Average Sales information-->
         <div class="form-group" id="t5" style="display:none">
         <div class="form-group">
           <label class="col-md-4 control-label" ><h2>Sales Information</h2></label>
           <div class="col-md-4 inputGroupContainer">
             <div class="input-group">
               <!-- <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span> -->
               <!-- <div > -->
                 <h5><label for="loc">Enter the store name to get the customer details with above average sales</label></h5>
                 <select name="store_location" id="loc" class="form-control selectpicker" >
                   <option value=" " >Please select a store name</option>
                   <option value="Alabama">Alabama</option>
                   <option value="Alaska">Alaska</option>
                   <option value="Arizona">Arizona</option>
                   <option value="Arkansas">Arkansas</option>
                   <option value="California">California</option>
                   <option value="Colorado">Colorado</option>
                   <option value="Connecticut">Connecticut</option>
                   <option value="Delaware">Delaware</option>
                   <option value="District of Columbia">District of Columbia</option>
                   <option value="Florida"> Florida</option>
                   <option value="Georgia">Georgia</option>
                   <option value="Hawaii">Hawaii</option>
                   <option value="Idaho">Idaho</option>
                   <option value="Illinois">Illinois</option>
                   <option value="Indiana">Indiana</option>
                   <option value="Iowa">Iowa</option>
                   <option value="Kansas"> Kansas</option>
                   <option value="Kentucky">Kentucky</option>
                   <option value="Louisiana">Louisiana</option>
                   <option value="Maine">Maine</option>
                   <option value="Maryland">Maryland</option>
                   <option value="Mass"> Mass</option>
                   <option value="Michigan" >Michigan</option>
                   <option value="Minnesota" >Minnesota</option>
                   <option value="Mississippi">Mississippi</option>
                   <option value="Missouri">Missouri</option>
                   <option value="Montana">Montana</option>
                   <option value="Nebraska">Nebraska</option>
                   <option value="Nevada">Nevada</option>
                   <option value="New Hampshire">New Hampshire</option>
                   <option value="New Jersey">New Jersey</option>
                   <option value="New Mexico">New Mexico</option>
                   <option value="New York">New York</option>
                   <option value="North Carolina">North Carolina</option>
                   <option value="North Dakota">North Dakota</option>
                   <option value="Ohio<">Ohio</option>
                   <option value="Oklahoma">Oklahoma</option>
                   <option value="Oregon">Oregon</option>
                   <option value="Pennsylvania">Pennsylvania</option>
                   <option value="Rhode Island">Rhode Island</option>
                   <option value="South Carolina">South Carolina</option>
                   <option value="South Dakota">South Dakota</option>
                   <option value="Tennessee">Tennessee</option>
                   <option value="Texas">Texas</option>
                   <option value="Utah"> Utah</option>
                   <option value="Vermont">Vermont</option>
                   <option value="Virginia">Virginia</option>
                   <option value="Washington" >Washington</option>
                   <option value="West Virginia">West Virginia</option>
                   <option value="Wisconsin">Wisconsin</option>
                   <option value="Wyoming">Wyoming</option>
                 </select>
               <!-- </div> -->
             </div>
           </div>
         </div>
         <br>
         <!-- Button -->
         <div class="form-group">
           <label class="col-md-4 control-label"></label>
           <div class="col-md-4">
             <div class="button">
             <button type="submit" class="btn btn-warning">Search<span class="glyphicon glyphicon-send"></span></button>
           </div>
           </div>
         </div>
       </div>
         <div class="tab5content" id="c5">
         <?php
          //  session_start();
           require_once 'db_config.php';
           $location=filter_input(INPUT_POST,"store_location");
           //Query5 starts here...
            $query5="SELECT concat(cu.first_name,' ',cu.last_name) as Customer_Name,s.store_id as Store_ID,concat(s.street,char(13),b.city,char(13),b.state,char(13),b.zip) as Store_Location,r.type,r.rental_days,r.rental_days asNumber_of_days_rented,r.bill_amount as Bill_Amount,r.total_cost as Sales
            FROM Customer cu,Store s,base_address b,reservation r
            WHERE r.customer_id=cu.customer_id and r.store_id=s.store_id and s.address_id=b.address_id and b.state='$location' and r.total_cost > (select avg(total_cost) from reservation)";
            $result = $con->query($query5);
              $row = $result->fetch(PDO::FETCH_ASSOC);

              // print "<h2 class="sub-header">Reservations on $location</h2>";
                  if($result->rowCount() > 0){
              print '<div class="table-responsive">  <table class="table table-striped">';
            // Construct the header row of the HTML table.
              print "<tr>\n";
              foreach ($row as $field => $value) {
                print "<th>$field</th>\n";
              }
              print "</tr>\n";
            }
              $data = $con->query($query5);
              $data->setFetchMode(PDO::FETCH_ASSOC);
            // Construct the HTML table row by row.
            if($data->rowCount() > 0){

              foreach ($data as $row) {
                print " <tr>\n";
                foreach ($row as $name => $value) {
                  print " <td>$value</td>\n"; }
                  print " </tr>\n";
                }

                print "</table></div>\n";

            }
            // else{
            //   print "<p>There are no reservations at the location.\n Please make another selection</p>";
            //   }

?>
       </div>
       <!-- Display Customer points-->
       <div  class="form-group" id="t6" style="display:none">
       <div class="form-group" >

         <label class="col-md-4 control-label" ><h2>Update Customer points</h2></label>
         <div class="col-md-4 inputGroupContainer">
           <div class="input-group">
             <!-- <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span> -->
             <div class="tab-content"   >
               <h3><label for="fponits"> Enter customer point limit</label></h3>
  <?php

   require_once 'db_config.php';
           $result_p = "SELECT max(points) from customer";
           $res = $con->query($result_p);
           $max_points = $res->fetch(PDO::FETCH_ASSOC);

           foreach ($max_points as $field => $value) {
                $temp=implode(',',$max_points);

         }
      echo '<input name="cpoint" id="fpoints" placeholder="Max-points: '.(string)$temp .'" class="form-control"  type="text"/> ';?>

             </div>
           </div>
         </div>
       </div>
       <br>
       <!-- Button -->
       <div class="form-group" >
         <label class="col-md-4 control-label"></label>
         <div class="col-md-4">
           <div class="button">

           <button type="submit" class="btn btn-warning" onclick = "showContent('c6')">Search<span class="glyphicon glyphicon-send"></span></button>

         </div>
         </div>
       </div>
       </div>
       <div class="tab6content" id="c6">
       <?php

               require_once 'db_config.php';


               $point = filter_input(INPUT_POST, "cpoint");
                  if($point!=null){
                 $point=trim($point);
                    $temp="SELECT avg(points) from customer";
                    $res1 = $con->query($temp);
                    $avg_points = $res1->fetch(PDO::FETCH_ASSOC);

                    foreach ($avg_points as $field => $value) {
                         $result_n=implode(',',$avg_points);

                  }
                   settype($point, "integer");
                   settype($result_n, "integer");
                    // $point_i=intval($point);
            // echo gettype($result_n),"$result_n\n";
               $query6="UPDATE customer set points=points+1 where points < $point and points > $result_n";
                $result1 = $con->query($query6);
               $query6_after="SELECT customer_id,concat(first_name,last_name) as Customer_Name,points FROM customer where points < $point";

               $result = $con->query($query6_after);
                 $row = $result->fetch(PDO::FETCH_ASSOC);

                 // print "<h2 class="sub-header">Reservations on $r_date</h2>";
                 if($result->rowCount() > 0){
                 print '<div class="table-responsive">  <table class="table table-striped">';
               // Construct the header row of the HTML table.
                 print "<tr>\n";
                 foreach ($row as $field => $value) {
                   print "<th>$field</th>\n";
                 }


                 print "</tr>\n";
               }

                 $data = $con->query($query6_after);
                 $data->setFetchMode(PDO::FETCH_ASSOC);
               // Construct the HTML table row by row.
               if($data->rowCount() > 0){

                 foreach ($data as $row) {
                   print " <tr>\n";
                   foreach ($row as $name => $value) {
                     print " <td>$value</td>\n"; }
                     print " </tr>\n";
                   }

                   print "</table></div>\n";

               }
             }

              //  else{
              //     print "<h2>There are no reservations for the selected date.\n Please try entering another date</h2>";
              //     }
                  //Query1 ends here........
                   ?>
     </div>

  </fieldset>
</form>
</div>
    </div><!-- /.container -->
