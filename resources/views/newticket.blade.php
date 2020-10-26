<!DOCTYPE html>
<html>
<head><title>Customer Home Page</title>
    <script type="text/javascript">
        var subcategory = {
            IssueCategory1: ["Issue 1", "Issue 2", "Issue 3"],
            IssueCategory2: ["Issue 4", "Issue 5", "Issue 6"],
            IssueCategory3: ["Issue 7", "Issue 8", "Issue 9"],

        }

        function makeSubmenu(value) {
            if (value.length == 0) document.getElementById("categorySelect").innerHTML = "<option></option>";
            else {
                var citiesOptions = "";
                for (categoryId in subcategory[value]) {
                    citiesOptions += "<option>" + subcategory[value][categoryId] + "</option>";
                }
                document.getElementById("categorySelect").innerHTML = citiesOptions;
            }
        }
    </script>
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
    <a href="customer">Home</a>
    <a class='active' href="newticket">New Ticket</a>
    <a href="ticketinfo">Ticket Info</a>
    <form action="/">
        <input type="submit" value="logout">
    </form>
</div>
@if (count($errors) > 0)
    <div class = "alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="newt" method="post">
    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
    Select issue Category:
    <select id="category" name="category" size="1" onchange="makeSubmenu(this.value)">
        <option value="" disabled selected>Choose Category</option>
        <option name="issue1" id="issue1">IssueCategory1</option>
        <option name="issue2" id="issue2">IssueCategory2</option>
        <option name="issue3" id="issue3">IssueCategory3</option>
    </select>
    <br>
    Select Issue:
    <select id="categorySelect" name="categoryselect" size="1">
        <option value="" disabled selected>Choose Subcategory</option>
        <option></option>
    </select>
    <br>
    Issue Description:
    <textarea rows="5" cols="20" name="issue" placeholder="Enter Your issue here"></textarea><br>
    <button type="submit" value="submit">create ticket</button>
</form>
</body>
</html>



