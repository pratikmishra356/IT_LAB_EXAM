<?php  
$host="127.0.0.1";
$port=3306;
$socket="";
$user="root";
$password="mysqlpratik";
$dbname="Library";
$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());

//$con->close();?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
	<title>Lab Exam Pratik Mishra</title>

	<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>

	<!--Adding demo page css file -->
	<link rel="stylesheet" type="text/css" href="./demo-page-styles.css">

	<!--Adding plugin css file -->
	<link rel="stylesheet" type="text/css" href="./pratik-2.css">
</head>


<body>
	<section class="demo-section-box" style="background-color: #f2f2f0;">
		<div class="section-container">
			<div class="demo-box">

				
				<div class="breaking-news-ticker" id="newsTicker1">
				  <div class="bn-label">Pratik Mishra</div>
				  
				  <div class="bn-news">
					<ul>
					<?php 
						$sql = "SELECT * FROM books";
						$result = mysqli_query($conn,$sql);
						if (mysqli_num_rows($result) > 0) {
							while($row = mysqli_fetch_array($result)) {
								
					?>
						<li>
							<a href="#"><?php echo $row['SecurityCode']; ?>  <?php echo $row['High']; ?></a>
						</li>
					<?php
							}
						}
					?>
					  
					</ul>
				  </div>
				  <div class="bn-controls">
					<button><span class="bn-arrow bn-prev"></span></button>
					<button><span class="bn-action"></span></button>
					<button><span class="bn-arrow bn-next"></span></button>
				  </div>
				</div>
			    <!-- *********************** -->

			</div>
		</div>
	</section>


	<div class="section-container">
		<form action="" method="post" enctype="multipart/form-data">
			<strong>Select File</strong>
			<input type="file" name="xmlfile" required>
			<input type="submit" value="Upload">
		</form>
	</div>


	<?php 

		$rowaffected = 0;

		if (isset($_FILES['xmlfile']) && ($_FILES['xmlfile']['error'] == UPLOAD_ERR_OK)) {
			$xml = simplexml_load_file($_FILES['xmlfile']['tmp_name']);

			foreach ($xml->$book as $row) {
				$title =  $row['title'];
				$price = $row['price'];
				$author = $row['author'];
				
				$sql = "INSERT INTO books(title,price,author) VALUES ('" . $title . "','" . $price . "','" . $author . "',)";
				
				$result = mysqli_query($con, $sql);
				
				if (! empty($result)) {
					$affectedRow ++;
				} else {
					$error_message = mysqli_error($con) . "\n";
				}
			}

		}
		

	?>

	<div class="alert-alert-success">
		<?php 
			if (isset($msg)) {
				echo $msg;
			}
		?>
	</div>

	<div class="alert-alert-success">
		<?php 
			if (!empty($errorMsg)) {
				echo $errorMsg;
			}
		?>
	</div>

	<!-- Adding jquery library. minimum version 1.10.0 -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="./pratik-1.min.js"></script>


	<script type="text/javascript">

		jQuery(document).ready(function($){

			$('#newsTicker1').breakingNews();
		});

	</script>

</body>

</html>






<style>
body {  
    font-family: Arial;
}
.affected-row {
	background: #cae4ca;
	padding: 10px;
	margin-bottom: 20px;
	border: #bdd6bd 1px solid;
	border-radius: 2px;
    color: #6e716e;
}
.error-message {
    background: #eac0c0;
    padding: 10px;
    margin-bottom: 20px;
    border: #dab2b2 1px solid;
    border-radius: 2px;
    color: #5d5b5b;
}
</style>
