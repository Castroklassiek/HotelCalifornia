<!-- Footer -->
	<section id="footer">
		<div class="container">
			<div class="row text-center text-xs-center text-sm-left text-md-left">
				<div class="col-xs-12 col-sm-12 col-md-4">
					<img src="http://hotelcalifornia.local/image/logo2.png" width="250" height="102" class="img-fluid" alt="Responsive image">
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4 f1">
					<h5>Quick links</h5>
					<ul class="list-unstyled quick-links">
						<li><a href="/"><i class="fa fa-angle-double-right"></i>Home</a></li>
						<li><a href="/pages/thehotel.php"><i class="fa fa-angle-double-right"></i>the hotel</a></li>
						<li><a href="/pages/thearea.php"><i class="fa fa-angle-double-right"></i>the area</a></li>
						<li><a href="/pages/location.php"><i class="fa fa-angle-double-right"></i>location</a></li>
						<li><a href="/pages/booking.php"><i class="fa fa-angle-double-right"></i>booking</a></li>
						<li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>arrangements</a></li>
					</ul>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4 f1">
					<h5>Contact</h5>
					<ul class="list-unstyled quick-links">
                        <p><i class="fas fa-building"> 506 S Grand Ave, Los Angeles,<br>CA 90071, California</i></p>
                        <p><i class="fas fa-envelope"> Info@HotelCalifornia.com</i></p>
                        <p><i class="fas fa-phone"> +1 213-624-1011</i></p>
                        <p>VAT nr.: US 123456789B01</p>
                        <p>KVK nr.: 12345678</p>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-5">
					<ul class="list-unstyled list-inline social text-center">
						<li class="list-inline-item"><a href="javascript:void();"><i class="fab fa-facebook-f"></i></a></li>
						<li class="list-inline-item"><a href="https://twitter.com/castroklassiek/" target="_blank"><i class="fab fa-twitter"></i></a></li>
						<li class="list-inline-item"><a href="https://www.instagram.com/castroklassiek/" target="_blank"><i class="fab fa-instagram"></i></a></li>
						<li class="list-inline-item"><a href="javascript:void();"><i class="fab fa-google-plus-g"></i></a></li>
						<li class="list-inline-item"><a href="https://www.linkedin.com/in/castroklassiek/" target="_blank"><i class="fab fa-linkedin"></i></a></li>
					</ul>
				</div>
				<hr>
			</div>	
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
					<p><u><a href="https://www.nationaltransaction.com/">National Transaction Corporation</a></u> is a Registered MSP/ISO of Elavon, Inc. Georgia [a wholly owned subsidiary of U.S. Bancorp, Minneapolis, MN]</p>
					<p class="h6">Copyright All Rights reserved to respective owners. &copy 2019<a class="text-green ml-2" href="https://le-nerd.nl" target="_blank">Le Nerd</a></p>
				</div>
				<hr>
			</div>	
		</div>
	</section>
	<button id="topBtn" class="btn btn-danger"><i class="fas fa-arrow-up"></i></button>
	<script type="text/javascript" src="http://hotelcalifornia.local/js/backToTop.js"></script>
	<!-- ./Footer -->
    
	    <!-- Modal -->

    <div class="modal fade" id="Register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Register</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="form-group">
                                <label for="inputEmail">E-mailadres</label>
                                <input type="email" name="email" placeholder="Uw e-mailadres.." class="form-control form-control-lg <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                                <span class="invalid-feedback"><?php echo $email_err; ?></span>
                            </div>
                            <small id="emailHelp" class="form-text text-muted">We will never share your email with anyone else.</small>
                            <br>
                        <div class="form-group">
                            <div class="form-row">
                                <label for="inputPassword">Wachtwoord</label>
                                <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                                <span class="invalid-feedback"><?php echo $password_err; ?></span>
                            </div>
                            <div class="form-row">
                                <label for="inputPassword">Herhaal wachtwoord</label>
                                <input type="password" name="confirm_password" class="form-control form-control-lg <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Voornaam & Achternaam</label>
                                <input type="text" name="name" placeholder="Uw voornaam & achternaam.." class="form-control form-control-lg <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                                <span class="invalid-feedback"><?php echo $name_err; ?></span>
                            </div>
                            
                            <div class="form-group">
                                <label for="inputNumber">Telefoonnummer</label>
                                <input type="text" name="telefoonnummer" placeholder="Uw telefoonnummer.." class="form-control form-control-lg <?php echo (!empty($telefoonnummer_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $telefoonnummer; ?>">
                                <span class="invalid-feedback"><?php echo $telefoonnummer_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">adres</label>
                                <input type="text" name="adres" placeholder="Uw straatnaam & nr + postcode & woonplaats.." class="form-control form-control-lg <?php echo (!empty($adres_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $adres; ?>">
                                <span class="invalid-feedback"><?php echo $adres_err; ?></span>
                            </div>
                            <hr>
                            <div class="form-row">
                            <button type="submit" name="submit" class="btn btn-primary">Sign Up</button>
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal -->
    
       <div class="modal fade" id="Login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Log in</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="form-group">
                            <label for="exampleInputEmail1">E-mailadres</label>
                            <input type="email" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="E-mailadres.." class="form-control form-control-lg <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"><?php echo $email_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Wachtwoord</label>
                            <input type="password" name="password" id="exampleInputPassword1" placeholder="Wachtwoord.." class="form-control form-control-lg <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                            <span class="invalid-feedback"><?php echo $password_err; ?></span>
                        </div>

                        <hr>
                        <div class="form-row">
                        <button type="submit" value="login"class="btn btn-primary">Sign In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</html>