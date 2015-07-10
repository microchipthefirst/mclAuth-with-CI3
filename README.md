A simple authentication system for Codeigniter 3.

1.	Set up Auth for Codeigniter 3 from complete system.
2.	Prepping your system
3.	Prepping Codeigniter for your system (new or complete system)
4.	Integrating auth into your pages.

INTRODUCTION<br />
There are two versions of the mcl-Auth system, one each for the two versions of Codeigniter.
mcl-Auth has two variants in each version: a bare system to be copied into an existing Codeigniter install, or a complete system that needs only a couple of config changes to run.
These note describe the version for Codeigniter 3.
There are several watch-points that need to be addressed when moving from CI2 to CI3.  Only two are relevant to this project.  The major one is that all controllers and models need UCFirst() on the filename and class names.  The second is that the CI sessions are now based on the PHP session rather than a separate implementation. Instead of session_start() at the beginning of each controller that uses sessions, the session is started when the class is invoked (in my case by autoload).

ASSUMPTIONS<br />
I am going to assume that you are using an apache server on test server.  I always use a separate server to handle website development since any webserver running on a development machine seems to rum so much slower.  If you can’t run your own server locally, sign up for a 30-day free trial at Microsoft Azure and set up a website there.

SETTING UP MCL-AUTH COMPLETE SYSTEM.<br />
There are three steps to getting the system up and running.  We need a database to hold the user and group tables.  If you don’t have a database server or webserver, set up a WAMP system on your dev machine.
First: Create or use an existing database and run the SQL code in the file mysql.sql.  This creates and populates two tables with two groups (Please don’t delete them, you’ll break the mcl-Auth system) and one admin user.
Second: In your IDE (I use Netbeans) open application/config/autoload.php.
In the Libraries section add database, form validation and session.  In the helpers section add url and form.  The line should look like this:
```
	$autoload['libraries'] = array('database','form_validation','session');
	$autoload['helper'] = array('url','form');
```	
Save and close the file.
Open config.php from the same folder.
In the base_url section type in your domain name for the test server.  The line should look similar to:
```
	$config['base_url'] = 'http://www.domainname.com/';
```	
Note the final slash is needed.  Check the Index_page entry has an empty string.  If it shows index.php, remove it.
Further down the page find the encryption_key entry.  Obtain a Codeigniter enctyption key from the internet and paste it into the entry.  Save the file and close it.
Now open the database.php file in the same directory.  Type in the username for your database, the user’s password and the database name.		
Third: Check you have an .htaccess file in the project root.  The complete system has a file but it may not suit your system.  The only way to find out is to try it.
Upload the entire project to your server and open a browser and go to your site.  You should get my home page.  You have a working website you can now adapt to your own uses.
To use the login and admin side of things, see my later notes.

GETTING MCL-AUTH INVOLVED<br />
First we need to be able to login.  We are going to add an if-then statement that will either display Login or Logout depending on whether a user is logged in.
In the header.php file, type in the following after the ContactUs list item.
```
	  <?php 
	    if($this->session->userdata('loggedin')){                                
	      echo "<li><a href=";
	      echo base_url('/admin/login/logout'). ">Logout</a></li>";                        
	    }else{
	      echo "<li><a href=";
	      echo base_url('/admin/login/login'). ">Login</a></li>";
	    }
	  ?>
```  
Save the file and refresh the browser.  We now have a Login item on the right of the menu.
Click it.  The mcl-Auth login page should appear.  The user’s name is admin and the password is Pa$$w@rd.
When you have logged on, the Login changes to Logout.  Click Logout.  That is the login process working.
As admins we need to be able to manage our user and group accounts.  What we need is another menu item.  We will set up that menu item to appear only when a member of the admin group is logged in.
In between the Home and Example menu items insert the following code:
```
	  <?php 
	    if($this->session->userdata('loggedin') && $this->session->userdata('group') == '1'){                                
	      echo "<li><a href=";
	      echo base_url('/admin/admin_view'). ">Admin</a></li>";                        
	    }
	  ?>
```	  
This code checks if the session-group variable is set and that it is set to ‘1’ for the admin group.  If both are true, the Admin menu link is displayed.  We have to check if the group variable exists because when no one is logged in, it doesn’t exist and the group=1 check will through a php error.
Login as admin.  The Admin menu item is there, click it.
We can now work with our users and groups accounts.  Create a new user.
All data items are required.  The loginname must be unique, the email should be in lower case, the password at least 8 characters long. 
Notice the user group is pre-selected.  You need a conscious decision and action to create a admin user.  Similarly, all new users and groups are not activated.  Once created you need to activate the user or group.  I haven’t added these function to the user or group listing because I want the admin to make a conscious decision and act on it to activate or deactivate a user.  Otherwise someone could accidentally deactivate a user in the user list.
Adding security to your own controllers.
I could have used the MY_Controller technique to enforce security for new controllers but stuck with modifying each one individually for the moment.
Create a new controller called Secrets.php and add the following text to it:
```
	  <?php
	  class Secret extends CI_Controller{
	      function __construct() {
	          parent::__construct();
	          session_start();
	          if (!$this->session->userdata('loggedin')) {  
	              redirect('Location:admin/login');
	          } else {
	              if ($this->session->userdata('group') != '1') {
	                  redirect('Location:/admin/login');
	              }
	          }
	      }
	
	      function index() {
	          $data['title'] = 'secrets/secret_hoard';
	          $this->load->view('start', $data);
	      }
	  }
 ``` 
Now we need a view to display our secrets.  Create a new folder in the views folder called secrets and inside that, a file called secret_hoard.php.  Type in something secret only admins should read.
Save both files and add the word secret to the address bar.  You should have
	www.yourdomain.com/secret
Press Enter and your secret should be revealed (if you’re logged in as admin)
If you didn’t create a new user a little earlier, create one now, making sure they are in the Users group not Admin.
Login as that user and try to access the secret page.  Hoho straight to the login page.  But still logged in, look at the Logout button in the menu.
I have chosen to put people back to the login page simply for convenience.  You will need your own Access Denied landing page if you want to change that.

Ok, you have a working system, Good luck.

