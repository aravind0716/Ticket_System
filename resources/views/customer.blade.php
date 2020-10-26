<!DOCTYPE html>
<html>
<head><title>Customer Home Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .topnav {
            overflow: hidden;
            background-color: #333;
        }

        .topnav a {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }

        .topnav a.active {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>

<div class="topnav">
    <a class="active" href="customer">Home</a>
    <a href="newticket">New Ticket</a>
    <a href="ticketinfo">Ticket Info</a>
    <form action="/custlogout" method="post">
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
        <input type="submit" value="logout">
    </form>
</div>

<div style="padding-left:16px">
    <h2>Welcome</h2>
    <p>You can create a new ticket by selecting the New Ticket button</p><br>
    <p>You can also view the existing tickets by selecting the ticket info button</p>
</div>

</body>
</html>


