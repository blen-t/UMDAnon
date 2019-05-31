
<html>

  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="login_stylesheet.css">
    <title> Form </title>
    <style>
      .header h1 {
        width: 100%;
        text-align: center;
      }
      body {
        margin: auto;
        background-image: url("http://www.webdesigndev.com/wp-content/uploads/2015/02/Subtle-Light-Tile-Pattern-Vol5.jpg");
        color: #424242;
        font-family: Consolas, monaco, monospace;
        font-style: normal;
        font-size: 24px;
        max-width: 850px;
      }

      .page {
          margin: 100px 0 40px 0;
          position: relative;
      }

      #un, #pw {
        text-align: center;
        width: 40%;
        margin: 0 auto;
        float: none;
      }

      #btn {
        background-color: white;
        border: 0;
        padding: 10px 15px;
        color: red;
        border-radius: 10px;
        width: 250px;
        cursor: pointer;
        font-size: 18px;
      }

      #btn:hover{
        box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
      }

    </style>
  </head>

  <body style="text-align:center">
    <div class = "page">
      <div class="image">
        <img src="http://life.umd.edu/communications/cmns/images/header-clear-shell7.gif" alt="UMD Shell Logo" width="770" height="185">
      </div>
     <h1>Welcome Terp!</h1>
        <div class="form-group">
        <?php
           $dbuser = 'root';
           $dbpass = 'inst377inst377';
           $dbname = 'umdAnon';

           $conn = new mysqli("localhost", $dbuser, $dbpass, $dbname);
           if ($conn->connect_error) {
             die('Connection Failed: ' . $conn->connect_error);
             window.alert("connection failed");
           }

           require_once 'formr/class.formr.php';
           $form = new Formr('bootstrap');
           $form->required = '*';

           if($form->submit()) {
             $username = $form->post('username', '', 'sanitize_string');
             $password = $form->post('password', '', 'sanitize_string');

             if ($username != "" && $password != ""){

                $sql_query = "select count(*) as cntUser from admin where directoryid='".$username."' and pass='".$password."'";
                $result = mysqli_query($conn,$sql_query);
                $row = mysqli_fetch_array($result);

                $count = $row['cntUser'];

                if($count > 0){
                  $_SESSION['directoryid'] = $username;
                  $conn->close();
                  header("Location:home.html");
                }else{
                  echo "Invalid username and password";
                  $conn->close();
                }
            }





           }

           echo $form->form_open();
           echo $form->input_text('username','','','un','placeholder="Username"');
           echo $form->input_password('password','','','pw','placeholder="Password"');
           echo $form->input_submit('submit', '', '', 'btn', '');
           echo $from->form_close();


        ?>

        </div>
    </div>
  </body>

</html>
