
<html>

  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title> Form </title>
    <style>
      .header h1 {
        width: 100%;
        text-align: center;
      }
      body {
        margin: auto;
        background: #F6F5F4;
        color: #424242;
        font-family: Consolas, monaco, monospace;
        font-style: normal;
        max-width: 850px;
      }
      ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        width: 850px;
        height:47px;
        overflow: hidden;
        background-color: #333; }
      li {float: left; }
      li a {
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none; }
      li a:hover:not(.active) {
        background-color: #555;
        color: white;
      }
      li a.active {
      background-color: #708090;
      color: white;
      }
      .page {
          margin: 100px 0 40px 0;
          position: relative;
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
    <ul>
      <li><a href="home.html">Home</a></li>
      <li><a href="loginpage.html">Logout</a></li>
      <li><a class="active" href="form.php">Submit a Form</a></li>
    </ul>
    <div class = "page">
     <h1>What do you have to say?</h1>
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
             $comment_text = $form->post('comment_text', '', 'sanitize_string');

             if($form->value('dropdown') == "Dining") {
                  $department_id = 1;
              } else if($form->value('dropdown') == 'DOTS') {
                  $department_id = 2;
              } else if($form->value('dropdown') == "Health and wellness") {
                  $department_id = 3;
              } else if($form->value('dropdown') == "Academic concerns") {
                  $department_id = 4;
              } else if($form->value('dropdown') == "Campus concerns") {
                  $department_id = 5;
              } else if($form->value('dropdown') == "Housing concerns") {
                  $department_id = 6;
              }

            $sql = "INSERT INTO comments(comment_text, department_id) VALUES('$comment_text', '$department_id')";
            $result = $conn->query($sql);

            $conn->close();

            header("Location:home.html");

           }

           $options = array(
            'Dining' => 'Dining',
            'DOTS' => 'DOTS',
            'Health and wellness' => 'Health and wellness',
            'Academic concerns' => 'Academic concerns',
            'Campus concerns' => 'Campus concerns',
            'Housing concerns' => 'Housing concerns',
           );

           echo $form->form_open();
           echo $form->input_textarea('comment_text','','','','placeholder="Write your anonymous feedback here...", rows="8"');
           echo $form->input_select('dropdown','','','','','','Choose a Department', $options);
           echo $form->input_submit('submit', '', '', 'btn', '');
           echo $from->form_close();
        ?>

        </div>
    </div>
  </body>

</html>
