<!DOCTYPE html>
    <head>
        <title>Get Books</title>
        <link href="/limspro/css/bootstrap.min.css?v=1" rel="stylesheet">
        <link href="/limspro/css/reports.css?v=1" rel = "stylesheet">
    </head>
    <body>
    
        <main>
            <div class = "heading">
                <h1>LIMSPro: Reports</h1>
            </div>
            <nav class="navbar bg-body-tertiary">
                <div class="container-fluid">
            <a class="navbar-brand" href="#">Reports</a>
            <a class="navbar-brand" href="getBooks.php">All Books</a>
            </div>
            </nav>
            <button class = "btn btn-danger" onclick = "logout()">Log Out</button>
            <button id="bkbtn" class="btn btn-primary">Back to Reports</button>
            <div id="contentdiv" class="test">
            </div>
        
        </main>
        
                
    </body>
        <script src=" /limspro/js/jquery.js"></script>
        <script src=" /limspro/js/reports.js"></script>
        <script src=" /limspro/js/bootstrap.bundle.min.js"></script>
        <script>
             function logout() {
            // Redirect to the login page
            window.location.href = 'login.html';
        }
        </script>
        

    </html>
