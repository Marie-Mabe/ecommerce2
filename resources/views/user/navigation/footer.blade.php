<!-- Start Footer Section -->

<style>
/* Footer Styles */
.footer-section {
    background-color: #1a1a1a;
    color: #ffffff;
    padding: 60px 0 0;
    font-family: 'Inter', sans-serif;
    position: relative;
}

/* Newsletter Section */
.subscription-form {
    background-color: #2a2a2a;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    margin-bottom: 40px;
}

.subscription-form h3 {
    color: #ffffff;
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
}

.subscription-form h3 img {
    margin-right: 12px;
    width: 24px;
    filter: brightness(0) invert(1);
}

.subscription-form .form-control {
    background-color: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: #ffffff;
    height: 50px;
    padding: 10px 15px;
}

.subscription-form .form-control::placeholder {
    color: rgba(255, 255, 255, 0.6);
}

.subscription-form .btn-primary {
    background-color: #d4a762;
    border: none;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.subscription-form .btn-primary:hover {
    background-color: #c1914b;
    transform: translateY(-2px);
}

/* Logo Section */
.footer-logo-wrap .footer-logo {
    font-size: 28px;
    font-weight: 700;
    color: #ffffff;
}

.footer-logo-wrap .footer-logo span {
    color: #d4a762;
}

.footer-section p {
    color: #aaaaaa;
    line-height: 1.6;
    margin-bottom: 20px;
}

/* Social Icons */
.custom-social {
    display: flex;
    gap: 15px;
    margin-top: 25px;
}

.custom-social li a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    transition: all 0.3s ease;
}

.custom-social li a:hover {
    background-color: #d4a762;
    transform: translateY(-3px);
}

/* Links Section */
.links-wrap {
    margin-top: 10px;
}

.links-wrap ul {
    margin-bottom: 0;
}

.links-wrap li {
    margin-bottom: 12px;
}

.links-wrap a {
    color: #aaaaaa;
    position: relative;
    padding-left: 15px;
    transition: all 0.3s ease;
}

.links-wrap a:hover {
    color: #d4a762;
    padding-left: 20px;
}

.links-wrap a::before {
    content: "•";
    position: absolute;
    left: 0;
    color: #d4a762;
}

/* Copyright Section */
.copyright {
    border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
    padding-top: 30px !important;
    margin-top: 50px;
}

.copyright p {
    color: #777777;
    font-size: 14px;
    margin-bottom: 0;
}

.copyright a {
    color: #d4a762;
    text-decoration: none;
}

.copyright ul {
    gap: 20px;
}

.copyright ul li a {
    color: #aaaaaa;
    font-size: 14px;
    transition: all 0.3s ease;
}

.copyright ul li a:hover {
    color: #d4a762;
}

/* Responsive Design */
@media (max-width: 991.98px) {
    .footer-section {
        text-align: center;
    }
    
    .subscription-form {
        text-align: left;
    }
    
    .custom-social {
        justify-content: center;
    }
    
    .links-wrap {
        margin-top: 30px;
    }
    
    .copyright .text-lg-start,
    .copyright .text-lg-end {
        text-align: center !important;
    }
    
    .copyright ul {
        justify-content: center;
        margin-top: 15px;
    }
}

@media (max-width: 767.98px) {
    .subscription-form .form-control {
        margin-bottom: 10px;
    }
    
    .links-wrap > div {
        margin-bottom: 30px;
    }
}
</style>
		<footer class="footer-section">
			<div class="container relative">

				
				<div class="row">
					<div class="col-lg-8">
						<div class="subscription-form">
							<h3 class="d-flex align-items-center"><span class="me-1"><img src="{{ asset('images/envelope-outline.svg') }}" alt="Image" class="img-fluid"></span><span>Subscribe to Newsletter</span></h3>

							<form action="#" class="row g-3">
								<div class="col-auto">
									<input type="text" class="form-control" placeholder="Enter your name">
								</div>
								<div class="col-auto">
									<input type="email" class="form-control" placeholder="Enter your email">
								</div>
								<div class="col-auto">
									<button class="btn btn-primary">
										<span class="fa fa-paper-plane"></span>
									</button>
								</div>
							</form>

						</div>
					</div>
				</div>

				<div class="row g-5 mb-5">
					<div class="col-lg-4">
						<div class="mb-4 footer-logo-wrap"><a href="#" class="footer-logo">Furni<span>.</span></a></div>
						<p class="mb-4">Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. Pellentesque habitant</p>

						<ul class="list-unstyled custom-social">
							<li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
						</ul>
					</div>

					<div class="col-lg-8">
						<div class="row links-wrap">
							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">About us</a></li>
									<li><a href="#">Contact us</a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">Support</a></li>
									<li><a href="#">Knowledge base</a></li>
									<li><a href="#">Live chat</a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">Jobs</a></li>
									<li><a href="#">Our team</a></li>
									<li><a href="#">Leadership</a></li>
									<li><a href="#">Privacy Policy</a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">Nordic Chair</a></li>
									<li><a href="#">Kruzo Aero</a></li>
									<li><a href="#">Ergonomic Chair</a></li>
								</ul>
							</div>
						</div>
					</div>

				</div>

				<div class="border-top copyright">
					<div class="row pt-4">
						<div class="col-lg-6">
							<p class="mb-2 text-center text-lg-start">Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved. &mdash; Designed with love by <a href="https://untree.co">Untree.co</a>  Distributed By <a href="https://themewagon.com">ThemeWagon</a> <!-- License information: https://untree.co/license/ -->
            </p>
						</div>

						<div class="col-lg-6 text-center text-lg-end">
							<ul class="list-unstyled d-inline-flex ms-auto">
								<li class="me-4"><a href="#">Terms &amp; Conditions</a></li>
								<li><a href="#">Privacy Policy</a></li>
							</ul>
						</div>

					</div>
				</div>

			</div>
		</footer>
		<!-- End Footer Section -->
