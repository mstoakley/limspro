<!DOCTYPE html>
    <head>
        <title>Get Books</title>
        <link href="/limspro/css/bootstrap.min.css?v=1" rel="stylesheet">
        <link href="/limspro/css/books.css?v=1" rel = "stylesheet">
    </head>
    <body>
    
        <main>
            <div class = "heading">
                <h1>LIMSPro: All Books</h1>
            </div>
            <nav class="navbar bg-body-tertiary">
                <div class="container-fluid">
            <a class="navbar-brand" href="Reports.php">Reports</a>
            <a class="navbar-brand" href="#">All Books</a>
            </div>
           
            </nav>
            <button class = "btn btn-danger" onclick = "logout()">Log Out</button>
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
    

        <div class="modal" id="chkoutbtn">
            <div class= "modal-dialog">
                <div class = "modal-content">
                    <div class = "modal-header">
                        <h5 class = "modal-title" >Check-Out Book</h5>
                        <button class="btn btn-danger" data-bs-dismiss="modal">
                            X
                        </button>
                    </div>
                    <div class = "modal-body">
                      <div class ="userinputelement">
                        <label> Enter Member ID </label>
                        <input id = "txtmemberid" type = "text" ></input>
                      </div>

                      <div class ="userinputelement">
                        <label> Genre </label>
                        <select id = "ddbooks">
                            </select>
                      </div>
                    </div>
                    <div class = "modal-footer">
                        <button class = "btn btn-success" id = "submitbtn">Submit</button>
                        <button class = "btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>   
        </div>

        <div class="modal" id="addmemberbtn">
            <div class= "modal-dialog">
                <div class = "modal-content">
                    <div class = "modal-header">
                        <h5 class = "modal-title" >New Member</h5>
                        <button class="btn btn-danger" data-bs-dismiss="modal">
                            X
                        </button>
                    </div>
                    <div class = "modal-body">
                      <div class ="userinputelement">
                        <label> First Name </label>
                        <input id = "fname" type = "text" ></input>
                      </div>

                      <div class ="userinputelement">
                        <label> Last Name </label>
                        <input id = "lname" type = "text" ></input>
                      </div>

                      <div class ="userinputelement">
                        <label> Email </label>
                        <input id = "email" type = "text" ></input>
                      </div>

                      <div class ="userinputelement">
                        <label> Home Address </label>
                        <input id = "address" type = "text" ></input>
                      </div>
                    </div>
                    <div class = "modal-footer">
                        <button class = "btn btn-success" id = "membsubmitbtn">Submit</button>
                        <button class = "btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>   
        </div>

        <div class="modal" id="returnbtn">
            <div class= "modal-dialog">
                <div class = "modal-content">
                    <div class = "modal-header">
                        <h5 class = "modal-title" >Return Book</h5>
                        <button class="btn btn-danger" data-bs-dismiss="modal">
                            X
                        </button>
                    </div>
                    <div class = "modal-body">
                      <div class ="userinputelement">
                        <label> Enter Member ID </label>
                        <input id = "txtrmemberid" type = "text" ></input>
                      </div>

                      <div class ="userinputelement">
                        <label> Books to Return </label>
                        <select id = "ddrbooks">
                            </select>
                      </div>
                    </div>
                    <div class = "modal-footer">
                        <button class = "btn btn-success" id = "returnsubmitbtn">Submit</button>
                        <button class = "btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>   
        </div>

        <div class="modal" id="deletebtnfrm">
            <div class= "modal-dialog">
                <div class = "modal-content">
                    <div class = "modal-header">
                        <h5 class = "modal-title" >Delete Book</h5>
                        <button class="btn btn-danger" data-bs-dismiss="modal">
                            X
                        </button>
                    </div>
                    <div class = "modal-body">
                      <div class ="userinputelement">
                        <label> Books Available For Deletion </label>
                        <select id = "ddDeletebooks">
                            </select>
                      </div>
                    </div>
                    <div class = "modal-footer">
                        <button class = "btn btn-success" id = "deletesubmitbtn">Submit</button>
                        <button class = "btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>   
        </div>
       
    </body>
        <script src=" /limspro/js/jquery.js"></script>
        <script src=" /limspro/js/books.js"></script>
        <script src=" /limspro/js/bootstrap.bundle.min.js"></script>
        <script>
             function logout() {
            // Redirect to the login page
            window.location.href = 'login.html';
        }
        </script>

    </html>
