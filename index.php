
<?php
session_start();
require_once './config/config.php';
require_once './include/auth_validate.php';
unset($_SESSION['province']);
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>UCT - LISTAHANAN</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

<script src="custom/js/jquery-1.11.1.min.js"></script>

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
    <style>

/**
 * Profile image component
 */
.profile-header-container{
    margin: left;
    text-align: left;
	float: left;
}




.profile-header-img {
   padding: 54px;
	float: left;

}


td {
  padding-top:5px;
  padding-bottom:5px;
  padding-right:5px;   
  width:1px; 
}

td:first-child {
  padding-left:5px;
  padding-right:0;
  width:1px; 
}
th {
  padding-top:5px;
  padding-bottom:5px;
  padding-right:5px;  
  width:2px; 
}

th:first-child {
  padding-left:5px;
  padding-right:0;
}

</style>
  </head>

  <body id="page-top" >

   <?php include("include/header.php")?>

      <div id="content-wrapper">

        <div class="container-fluid">

		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
				
        <?php
		
    if(isset($_SESSION['fullname']))
{
?>

<div class="alert alert-info" id="success-alert">

<strong>Welcome! </strong> <?php echo $_SESSION['fullname']?> today is <?php echo date("m/d/yy")?>
</div>

<?php
unset($_SESSION['fullname']);

}
?>
    <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
          </ol>
		<div class="row">
      
					<div class="profile-header-container" style="padding-left: 5px;">   
						<div class="profile-header-img">

            <iframe class="embed-responsive-item" src="charts/user_index/chart_sample.HTML" width="450" height="550" frameBorder='0'></iframe>
            
              </div>   
              </div>  


        <div style="display: inline-block;padding:40px;">





								<h2>UCT LISTAHANAN CLEANLIST</h2>
								<table class = "table table-bordered table-condensed table-striped">	
																			
								<thead class="thead-light">
																		
																			<th>PROVINCE</th>
																			<th>HH COUNT </th>
														
								
																			
																			</thead>	
																			<tbody>

                                      <?php
									
                  $sql="SELECT present_address1_provname as prov,count(*) as bilang FROM `uct_cleanlist`GROUP by present_address1_provname";
                              $total=0;
                                      if($stmt = $mysqli->prepare($sql)){
                                        
                                    // $stmt->bind_param("s", $param_hhid);
                                     // $param_hhid = $complete_hhid;
                                        if($stmt->execute()){
                                          $stmt->store_result();
                                          if($stmt->num_rows != 0){                    
                                          $stmt->bind_result($prov,$bilang);
                                          while($stmt->fetch()){
                                          $total += $bilang;
                                          ?>


<tr>
<td><?php echo $prov?></td><td><?php echo number_format($bilang)?></td>
</tr>














                                          <?php } ?>

                                          <tr><td style="text-align:right"><strong>TOTAL:</strong></td><td><strong><?php echo number_format($total);?></strong></td></tr>
                                          <?php
                                          }
                                        }
                                      }
            ?>
                  </tbody>
              </table>
            </div>
            <!--end table-->
    
       


								





<div class="row">
      
      <div class="profile-header-container" style="padding-left: 5px;">   
        <div class="profile-header-img">

        <iframe class="embed-responsive-item" src="try/chart-pie_status/index.php" width="650" height="700" frameBorder='0'></iframe>
        
          </div>   
          </div>  


    <div style="display: inline-block;padding:40px;">





            <h2>STATUS ON REVALIDATION 2021-2021</h2>
            <table class = "table table-bordered table-condensed table-striped">	
                                  
            <thead class="thead-light">
                                
                                  <th>STATUS</th>
                                  <th>COUNT </th>
                        
            
                                  
                                  </thead>	
                                  <tbody>

                                  <?php
              
              $sql="SELECT status, count(*)
              from uct_list_110
              GROUP by status order by status ASC";
                          $total=0;
                                  if($stmt = $mysqli->prepare($sql)){
                                    
                                // $stmt->bind_param("s", $param_hhid);
                                 // $param_hhid = $complete_hhid;
                                    if($stmt->execute()){
                                      $stmt->store_result();
                                      if($stmt->num_rows != 0){                    
                                      $stmt->bind_result($prov,$bilang);
                                      while($stmt->fetch()){
                                      $total += $bilang;
                                      ?>


<tr>
<td><?php echo $prov?></td><td><?php echo number_format($bilang)?></td>
</tr>














                                      <?php } ?>

                                      <tr><td style="text-align:right"><strong>TOTAL:</strong></td><td><strong><?php echo number_format($total);?></strong></td></tr>
                                      <?php
                                      }
                                    }
                                  }
        ?>
              </tbody>
          </table>
        </div>






          
<div style="clear: left;"/>


    <!-- When document is ready make an ajax request 
		
		    <canvas id="barChart"></canvas>
    

    <script>
        $(document).ready(function(){
            $.ajax({
                beforeSend: function() {
                    console.log("Making AJAX request");
                },
                cache: false,
                url: 'bargraph.php',
                dataType: 'json',
                success: function(res) {
                    var graphLabels = [],
                        graphData = [];
                    for(var i=0;i<res.length;i++){
                        graphData.push(res[i].visits);
                        graphLabels.push(res[i].province);
                    }
                    //Make a call to the function to draw the bar graph
                    drawGraph(graphLabels, graphData);
                },
                complete: function() {
                    console.log("AJAX request done");
                },
                error: function() {
                    console.log("Error occurred during AJAX request")
                }               
            });
        }); 
        
        function drawGraph(Labels, Data){
              var ctxB = document.getElementById("barChart").getContext('2d');
            var myBarChart = new Chart(ctxB, {
                type: 'bar',
                data: {
                    labels: Labels,
                    datasets: [{
                        label: 'UCT Listahanan Beneficiary',
                        data: Data,
                        backgroundColor:'#028c02',
                        borderWidth: 1
                    }]
                },
                optionss: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });  
        }
        
    </script>

		
      -->
		
		
		
		
		
		
		
		
		
		
		
		

          <!-- Breadcrumbs-->
      

          <!-- Icon Cards-->
          <div class="row">
            <div class="col-xl-4 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-users"></i>

                  </div><h3 class = "counter-count">
				  <?php
                        $sql = 'SELECT count(*) total from uct_list_110';
                        if($stmt = $mysqli->prepare($sql)){							
                            if($stmt->execute()){
                               $result =  $stmt->get_result();
							   $result = $result->fetch_array(MYSQLI_ASSOC);
							   $count = $result['total'];
							}
						}
						$english_format_number = number_format($count);
						echo $count;
								?>
</h3>
				  
				  
				  
                  <div class="mr-5">Beneficiaries saved on Database</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="beneficiaries">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
	
        <div class="col-xl-4 col-sm-6 mb-3">
              <div class="card text-white bg-info o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-users"></i>
                  </div><h3 class = "counter-count">31876 </h3>
                  <div class="mr-5">Number of Images of UCT Listahnanan Beneficiaries Stored on System</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
               <div class="col-xl-4 col-sm-6 mb-3">	
              <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                  </div>
				  
				  
				  
				  
				  
                  <div class="mr-5"><h4 class="counter-count">82213</h4> Listahanan Cleanlist</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
			
		  
		  
		  
		  
		  
		  
		  
		  
        </div>
		
		
		
		
		
		
		
		
		
		
		
		
		  <div class="row">
                <?php $sql = 'select count(*) as cnt from pantawid';
                        if($stmt = $mysqli->prepare($sql)){							
                            if($stmt->execute()){
                               $result =  $stmt->get_result();
							   $result = $result->fetch_array(MYSQLI_ASSOC);
							   $count = $result['cnt'];
							}
						}
						$english_format_number = number_format($count);
						//echo $english_format_number;
								?>
            <div class="col-xl-4 col-sm-6 mb-3">
              <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-list"></i>
                  </div><h3 class="counter-count"><?php echo $count?> </h3>
                  <div class="mr-5">Number of Pantawid beneficiaries identified by 4P's NPMO</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="pantawid_benes">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
			
			
				    <?php $sql = 'select count(*) as cnt from uct_list_edit_history where type_of_update = "Change Address"';
                        if($stmt = $mysqli->prepare($sql)){							
                            if($stmt->execute()){
                               $result =  $stmt->get_result();
							   $result = $result->fetch_array(MYSQLI_ASSOC);
							   $count = $result['cnt'];
							}
						}
						$english_format_number = number_format($count);

								?>
            <div class="col-xl-4 col-sm-6 mb-3">
              <div class="card text-white bg-secondary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-list"></i>
                  </div>
                  <div class="mr-5">Number of Change Address in the database<h3><?php echo $english_format_number;?> </h3></div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="edited_bene_change_address">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
			
			
			
			
			
          
				    <?php $sql = 'select count(*) as cnt from uct_list_edit_history where type_of_update = "Change Basic information"';
                        if($stmt = $mysqli->prepare($sql)){							
                            if($stmt->execute()){
                               $result =  $stmt->get_result();
							   $result = $result->fetch_array(MYSQLI_ASSOC);
							   $count = $result['cnt'];
							}
						}
						$english_format_number = number_format($count);
						//echo $english_format_number;
								?>
            <div class="col-xl-4 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-list"></i>
                  </div>
                  <div class="mr-5">Number of Change in basic information in the database<h3><?php echo $english_format_number;?> </h3></div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="edited_bene_change_basic">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
		  
		  
		  
		  
		  
        </div>
		
		
		
		
		
		
		
		
				  <div class="row">
                <?php $sql = 'select count(*) as cnt from uct_list_edit_history where type_of_update = "Change Grantee"';
                        if($stmt = $mysqli->prepare($sql)){							
                            if($stmt->execute()){
                               $result =  $stmt->get_result();
							   $result = $result->fetch_array(MYSQLI_ASSOC);
							   $count = $result['cnt'];
							}
						}
						$english_format_number = number_format($count);
						//echo $english_format_number;
								?>
    
			
			
				    <?php $sql = 'select count(*) as cnt from uct_list_edit_history where type_of_update = "Change Address"';
                        if($stmt = $mysqli->prepare($sql)){							
                            if($stmt->execute()){
                               $result =  $stmt->get_result();
							   $result = $result->fetch_array(MYSQLI_ASSOC);
							   $count = $result['cnt'];
							}
						}
						$english_format_number = number_format($count);
						//echo $english_format_number;
								?>
            <div class="col-xl-4 col-sm-6 mb-3">
              <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-place"></i>
                  </div>
                  <div class="mr-5">LBP Servicing Branch Assignments<h3><?php //echo $english_format_number;?> </h3></div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="lbp_branches">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
			
			
			
			
			
          
				    <?php $sql = 'select count(*) as cnt from uct_list_edit_history where type_of_update = "Change Basic information"';
                        if($stmt = $mysqli->prepare($sql)){							
                            if($stmt->execute()){
                               $result =  $stmt->get_result();
							   $result = $result->fetch_array(MYSQLI_ASSOC);
							   $count = $result['cnt'];
							}
						}
						$english_format_number = number_format($count);
						//echo $english_format_number;
								?>
            <div class="col-xl-4 col-sm-6 mb-3">
              <div class="card text-white bg-secondary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-crosshairs"></i>
                  </div>
                  <div class="mr-5">Neutral Ground Facilities<h3><?php //////echo $english_format_number;?> </h3></div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
		  
		  
		  
		 




      
				    <?php $sql = 'select count(*) as cnt from uct_list_edit_history where type_of_update = "Change Basic information"';
                        if($stmt = $mysqli->prepare($sql)){							
                            if($stmt->execute()){
                               $result =  $stmt->get_result();
							   $result = $result->fetch_array(MYSQLI_ASSOC);
							   $count = $result['cnt'];
							}
						}
						$english_format_number = number_format($count);
						//echo $english_format_number;
								?>
            <div class="col-xl-4 col-sm-6 mb-3">
              <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-map"></i>
                  </div>
                  <div class="mr-5">Stakeholders Directory<h3><?php //////echo $english_format_number;?> </h3></div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="https://docs.google.com/spreadsheets/d/18zBM49ioLgscHJpXHc5ujNTZLXlh3t7Ii0ptoHlByPg/edit?usp=sharing" target="_BLank">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
		  















		 
		  
        </div>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
        <!-- /.container-fluid -->
      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->
<script>
$('.counter-count').each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
            duration: 5000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });


</script>
	<?php include("include/footer.php")?>

  </body>

</html>













<script language=JavaScript>


function clickNS4(e){
if (document.layers||document.getElementById&&!document.all){
if (e.which==2||e.which==3){
alert(message);
return false;
}
}
}

if (document.layers){
document.captureEvents(Event.MOUSEDOWN);
document.onmousedown=clickNS4;
}
else if (document.all&&!document.getElementById){
document.onmousedown=clickIE4;
}

document.oncontextmenu=new Function("alert(message);return false")

</script>