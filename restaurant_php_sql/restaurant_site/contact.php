<!DOCTYPE html>
<html>
    <head>
        <title>WP Eatery - Contact Us</title>
		<?php include 'header.php'?>
    </head>
    <body>
        <div id="wrapper">
            <div id="content" class="clearfix">
                <aside>
                        <h2>Mailing Address</h2>
                        <h3>1385 Woodroffe Ave<br>
                            Ottawa, ON K4C1A4</h3>
                        <h2>Phone Number</h2>
                        <h3>(613)727-4723</h3>
                        <h2>Fax Number</h2>
                        <h3>(613)555-1212</h3>
                        <h2>Email Address</h2>
                        <h3>info@wpeatery.com</h3>
                </aside>
                <div class="main">
				<!-- Javascript function used to change the visibility of our div element that includes the database mailinglist-->
					<script>
					function myFunction() {
					  var x = document.getElementById("showTable");
					  if (x.style.display === "none") {
						x.style.display = "block";
					  } else {
						x.style.display = "none";
					  }
					}
					</script>

					<!-- Place registration form inside contact page with PHP.-->
					<?php include 'form.php' ?>
					
					<hr>
					
					<!-- Database's mailinglist table, inside of a div tag. Default set to hidden.-->
					<div id="showTable" style="display:none"> <?php include 'mailing_list.php'; ?> </div> 
					
					<!-- Button that calls on function to change display style to hidden/shown (none/block)-->
					<p></br><button onclick="myFunction()">Show/Hide Database</button></p>


                </div><!-- End Main -->
            </div><!-- End Content -->
				<footer> <?php include 'footer.php'?> </footer>
        </div><!-- End Wrapper -->
    </body>
</html>
