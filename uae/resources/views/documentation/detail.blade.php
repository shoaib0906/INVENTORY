@extends('layouts.documentation')

	@section('content')
		<div class="page-heading animated fadeInDownBig">
			<h1>Employer Zone <small>Documentation</small></h1>
		</div>
		<div class="box-info">
			<div class="row">
				<div class="col-md-6">
					<h4><strong>About </strong> Employer Zone</h4>
					<ul class="faq">
						<li>
							<a class="faq-question" data-toggle="collapse" data-target="#faq01">
								<i class="fa fa-question-circle"></i>
								What is employer zone?
							</a>
							<div id="faq01" class="faq-answer collapse">
							Employer zone is a web based human resource management application, which can be used to maitain the records of human resource of your organization.
							It is a light weight application which is focused to maintain the records with ease.
							</div>
						</li>
						<li>
							<a class="faq-question" data-toggle="collapse" data-target="#faq02">
								<i class="fa fa-question-circle"></i>
								What is the current version of EZ?
							</a>
							<div id="faq02" class="faq-answer collapse">
							Latest Version is 2.0 which is released on 13th Sep 2015. <br />
							Initial Version 1.0 was released on 17th July 2015. You may visit this page to get the latest version release information
							</div>
						</li>
						<li>
							<a class="faq-question" data-toggle="collapse" data-target="#faq03">
								<i class="fa fa-question-circle"></i>
								What is support policy?
							</a>
							<div id="faq03" class="faq-answer collapse">
							<strong>Supports only available to my customers who have bought this application from envato only. </strong>
							<p>You can either comment on the comment section of this application or go to support section and fill out the form. Support available from 5pm (IST) to 11pm(IST). You can also mail me at support@wmlab.in Dont forget to mention your purchase code if you are asking for support first time. Purchase code is available in the download section of every application.</p>
							</div>
						</li>
						<li>
							<a class="faq-question" data-toggle="collapse" data-target="#faq04">
								<i class="fa fa-question-circle"></i>
								Can I use this application on my local computer system?
							</a>
							<div id="faq04" class="faq-answer collapse">
							<p>Yes, you can use it in your local system with local server installed in your system. You must have Apache/MYSQL/PHP support on your server. You can also use this application on local network.</p>
							</div>
						</li>
						<li>
							<a class="faq-question" data-toggle="collapse" data-target="#faq05">
								<i class="fa fa-question-circle"></i>
								How can I send mail using SMTP?
							</a>
							<div id="faq05" class="faq-answer collapse">
							<ul>
								<li>Open app/config/mail.php.</li>
								<li>Change the "driver" to smtp & set host,from,username,password,port values.</li>
								<li>You are now ready to send mail via SMTP!!</li>
							</ul>
							</div>
						</li>
						<li>
							<a class="faq-question" data-toggle="collapse" data-target="#faq07">
								<i class="fa fa-question-circle"></i>
								How can I send SMS?
							</a>
							<div id="faq07" class="faq-answer collapse">
								To use this module, you need to have a working XML SMS API. You can integrate any SMS API as you want. This module only provide SMS interface. You can ask the developer to integrate the API.
							</div>
						</li>
					</ul>
				</div>
				<div class="col-md-6">
					<h4><strong>Installation </strong> FAQ</h4>
					<p style='text-align:justify;'>Please note: It is good practice to install this application either in a subdomain or in a virtual host (If you are installing it your local system).
					A nice tutorial on how to create a virtual host can be found <a href="http://www.techrepublic.com/blog/smb-technologist/create-virtual-hosts-in-a-wamp-server/" target=_blank>here</a>. <Br />
					After extracting file contents to desired folder, if you get installation screen by navigating to <yourdomain>/install path, it means you are ready to install.
					<ul class="faq">
						<li>
							<a class="faq-question" data-toggle="collapse" data-target="#faq1">
								<i class="fa fa-question-circle"></i>
								What are the pre-requisite for installation this application?
							</a>
							<div id="faq1" class="faq-answer collapse">
							<strong>It is designed in laravel 5.1 framework with MVC structure. Everything that requires to be installed for laravel is required by this application. </strong>
							<br /><br />
							<p>The Laravel framework has a few system requirements:</p>
							<ul>
								<li>PHP >= 5.5</li>
								<li>MCrypt PHP Extension</li>
							</ul>

							<p>This application also uses following packages as supplymentry. Requirement by these supplements will also be required by this application:</p>
							<ul>
								<li>Zizaco/Confide</li>
								<li>Zizaco/Entrust</li>
								<li>Cviebrock/image-validator</li>
								<li>intervention/image</li>
								<li>felixkiss/uniquewith-validator</li>
								<li>spatie/activitylog</li>
							</ul>
							</div>
						</li>
						<li>
							<a class="faq-question" data-toggle="collapse" data-target="#faq2">
								<i class="fa fa-question-circle"></i>
								How to install this application?
							</a>
							<div id="faq2" class="faq-answer collapse">
							<ul>
								<li>Download the latest version available on codecanyon.</li>
								<li>Extract it on your server.</li>
								<li>Open /install with your browser.</li>
								<li>Enter details in the input fields. Make sure these information are correct. You must create a database with the same name which you have provided here.</li>
								<li>Click on 'Install App' button and wait for completion. This might take few minutes depending on your server configuration.</li>
								<li>After completion if you receive primary message then you have primaryfully install this application & you can now log in!!</li>
							</ul>

							<p>If you want to install it in your local system then you can create a virtual host. A nice tutorial on how to create a virtual host can be found <a href="http://www.techrepublic.com/blog/smb-technologist/create-virtual-hosts-in-a-wamp-server/" target=_blank>here</a>. </p>

							<p>If you want to install it in any subfolder of your webserver then you have to configure few files. A nice tutorial on how to setup laravel application on subfolder can be found <a target=_blank href="http://stackoverflow.com/questions/16683046/how-to-install-laravel-4-to-a-web-host-subfolder-without-publicly-exposing-app"> here</a>. </p>

							<p>You can also install it manually by following these stpes: </p>
							<ul>
								<li>Download the latest version available on codecanyon.</li>
								<li>Extract it on your server.</li>
								<li>Create a new database.</li>
								<li>Open app/config/database.php</li>
								<li>Set hostname, username, password, database name</li>
								<li>Import the SQL file located in app/database folder.</li>
								<li>Now you can open your project with any browser by navigating to</li>
							</ul>
							<p>If you found difficulty in installing the application then you can mail me at support@wmlab.in</p>
							</div>
						</li>
						<li>
							<a class="faq-question" data-toggle="collapse" data-target="#faq3">
								<i class="fa fa-question-circle"></i>
								I am not able to access any link. What to do?
							</a>
							<div id="faq3" class="faq-answer collapse">
								Go to setting, give full permission to admin & then save.
							</div>
						</li>
						<li>
							<a class="faq-question" data-toggle="collapse" data-target="#faq6">
								<i class="fa fa-question-circle"></i>
								I am getting an error "We can't verify you as our customer."
							</a>
							<div id="faq6" class="faq-answer collapse">
								Since this is a paid product, therefore we require verfication of purchase. If you have purchased it from envato then
								you must have envato username & purchase code of this product. Getting this error means you have not entered these details correctly.
							</div>
						</li>
						<li>
							<a class="faq-question" data-toggle="collapse" data-target="#faq7">
								<i class="fa fa-question-circle"></i>
								I am getting an error "Connection could not be established."
							</a>
							<div id="faq7" class="faq-answer collapse">
								Check your database details like database username, database password, database name & hostname. A little mistake leads to this error.
							</div>
						</li>
						<li>
							<a class="faq-question" data-toggle="collapse" data-target="#faq8">
								<i class="fa fa-question-circle"></i>
								I am getting an error "Database file not found"
							</a>
							<div id="faq8" class="faq-answer collapse">
								Go to database folder & check whether database.sql file exists or not. If not then download the product again & proceed.
							</div>
						</li>
						<li>
							<a class="faq-question" data-toggle="collapse" data-target="#faq9">
								<i class="fa fa-question-circle"></i>
								I am getting an error "database.php file is not writable"
							</a>
							<div id="faq9" class="faq-answer collapse">
								Make sure that config/database.php file has permission to write.
							</div>
						</li>
						
						<li>
							<a class="faq-question" data-toggle="collapse" data-target="#faq4">
								<i class="fa fa-question-circle"></i>
								How to upgrade from 1.3.2 to 1.4?
							</a>
							<div id="faq4" class="faq-answer collapse">
								<ul>
									<li>Extract zip file.</li>
									<li>Replace your current app folder with extracted app folder. Rewrite the database connection in app/config/database.php file.</li>
									<li>Add 1 new column 'display_name' VARCHAR(100) Default NULL in roles table.</li>
									<li>Add 1 new column 'display_name' VARCHAR(100) Default NULL in permission table.</li>
								</ul>
								You have done it.
							</div>
						</li>
						<li>
							<a class="faq-question" data-toggle="collapse" data-target="#faq5">
								<i class="fa fa-question-circle"></i>
								How to upgrade from 1.4 to 2?
							</a>
							<div id="faq5" class="faq-answer collapse">
								Since, we have change a few things in database, therefore it is very easy to upgrade this application to version 2.0.
								<ul>
									<li>Backup all the files & database.</li>
									<li>Extract zip file.</li>
									<li>Replace all the files.</li>
									<li>Go to config/database.php & set database details(db username, db password, db name & hostname)</li>
									<li>Rename table password_reminders to password_resets</li>
									<li>Rename table assigned_roles to role_user</li>
									<li>Rename field last_activity to last_login in users table & add a column last_login_ip (VARCHAR 100) in it</li>
									<li>Do check database prefix.</li>
								</ul>
								You have done it.
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	@stop