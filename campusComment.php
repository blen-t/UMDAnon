<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="comment.css">
    <style>
      ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #333; }
      li {float: left; }
      li a {
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none; }
      li a:hover {
        background-color: #708090;
      }
    </style>
</head>
<body>
  <ul>
    <li><a class="active" href="home.html">Home</a></li>
    <li><a href="loginpage.html">Logout</a></li>
    <li><a href="form.php">Submit a Form</a></li>
  </ul>
    <section id="content">
        <h1>Campus Concerns</h1>
        <p>Read comments about Campus from other students.</p>
    </section>
    <section id="comments">
       <?php
       $servername = "localhost";
        $username = "root";
        $password = "inst377inst377";
        $dbname = "umdAnon";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM comments WHERE department_id=5";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<P>". $row["comment_text"]. "<br>". $row["time_entered"]. "</p>"."<hr>";
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
    </section>
</body>
</html>
