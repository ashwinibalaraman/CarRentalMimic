 <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Datamass</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#">Login</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-3 col-md-2 sidebar">
        <ul class="nav nav-sidebar">
          <li class="active"><a href="index.php"><i class="glyphicon glyphicon-home"></i> Home <span class="sr-only">(current)</span></a></li>
          <li><a href="admin.php"><i class="glyphicon glyphicon-user"></i> Admin Dashboard</a></li>
          
        </ul>

        <ul class="nav nav-sidebar">
          <li id="res" onclick='document.getElementById("res").class = "active";''><a href="reserve.php"><i class="glyphicon glyphicon-scale"></i>  Reserve a Car</a></li>
          <li><a href="add_on_driver.php"><i class="glyphicon glyphicon-user"></i>  Add on Driver</a></li>
          
        </ul>

        <ul class="nav nav-sidebar">
          <li><a href="query3.php"><i class="glyphicon glyphicon-sort"></i>   Drill up and Drill down on profit per year</a></li>
          <li><a href="query2.php"><i class="glyphicon glyphicon-fullscreen"></i>   Slice on profit per area</a></li>
          <li><a href="query6.php"><i class="glyphicon glyphicon-transfer"></i>   Dice on brand and quarter</a></li>
          <li><a href="query12.php"><i class="glyphicon glyphicon-star-empty"></i>   Stores having new cars in a state</a></li>
          
        </ul>
        <ul class="nav nav-sidebar">
         
        </ul>
      </div>