<!DOCTYPE html>
    <head>
        <title>Get Books</title>
        <link href="/limspro/css/bootstrap.min.css?v=1" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link href="/limspro/css/books.css?v=1" rel = "stylesheet">
    </head>
    <body>
        <main>
            <div class = "heading">
                <h1>Books</h1>
            </div>
            <div id="contentdiv" class="test">
            </div>
        </main>
        <div class="modal" id="modalprogram">
            <div class= "modal-dialog">
                <div class = "modal-content">
                    <div class = "modal-header">
                        <h5 class = "modal-title" >Add New Book</h5>
                        <button class="btn btn-danger" data-bs-dismiss="modal">
                            X
                        </button>
                    </div>
                    <div class = "modal-body">
                      <div class ="userinputelement">
                        <label> Book Author </label>
                        <input id = "txtauthor" type = "text" ></input>
                      </div>

                      <div class ="userinputelement">
                        <label> Book Title </label>
                        <input id = "txttitle" type = "text"></input>
                      </div>

                      <div class ="userinputelement">
                        <label> Genre </label>
                        <select id = "ddgenre">
                            </select>
                      </div>
                    </div>
                    <div class = "modal-footer">
                        <button class = "btn btn-success" id = "savebutton">Save</button>
                        <button class = "btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>   
        </div>
        <script src=" /limspro/js/jquery.js"></script>
        <script src=" /limspro/js/books.js"></script>
        <script src=" /limspro/js/bootstrap.bundle.min.js"></script>
        
        

    </html>
