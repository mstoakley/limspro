function gethtml(result) {
    const addButton = `<div class"addnew"><button id = "btnAddnew" class ="btn btn-primary">Add Book</button></div>`;
    const chkOutBtn = `<div class"addnew"><button id = "btnchkout" class ="btn btn-primary">Check-Out</button></div>`;
    let table = `<table class ="table table-striped">
                     <thead>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Genre</th>
                    </thead>
                    <tbody>`;
            //column names for the Books table
    result.forEach(book => {
        table += `<tr>
                    <td>${book['AName']}</td>
                    <td>${book['BTitle']}</td>
                    <td>${book['GName']}</td>
                  </tr>`;
    });
    table += `</tbody></table>`;
    return addButton + chkOutBtn + table;
}
//dropdown for the genres

  function getselectbox(result) {
    let html = `<select id="ddgenre" class="form-control">`;
    result.forEach(genre => {
        html += `<option value="${genre['GName']}">${genre['GName']}</option>`;
    });
    html += `</select>`;
    return html;
  }  
function availablebooks(result){
    let html = `<select id="ddbooks" class="form-control">`;
    result.forEach(book => {
        html += `<option value="${book['BID']}">${book['BTitle']}</option>`;
    });
    html += `</select>`;
    return html;
}
function GetAllBooks() {
    $.ajax({
        url: "/limspro/ajax/BooksDBAjax.php",
        type: "POST",
        dataType: "JSON",
        data: {action:"GetAllBooks"},  
        beforeSend: function() {
            alert("Before Send");
        },
        success: function(result) {
           //alert("Success");
           //let x = JSON.stringify(result);
            //alert(x);
            let html = gethtml(result);
            //alert(html);
            $("#contentdiv").html(html);
        },
        error:function(){
            alert("Error");
        }
    });
}
function LoadBooks(){
    $.ajax({
        url: "/limspro/ajax/TransactionsDBAjax.php",
        type: "POST",
        dataType: "JSON",
        data: {action:"LoadAvailableBooks"},  
        beforeSend: function() {
            alert("Before Send");
        },
        success: function(result) {
           //alert("Success");
           let x = JSON.stringify(result);
            //alert(x);
            let html = availablebooks(result);
            //alert(html);
            $("#ddbooks").html(html);
        },
        error:function(){
            alert("Error");
        }
    });

}
function LoadGenres(){

    $.ajax({
    url: "/limspro/ajax/BooksDBAjax.php",
    type: "POST",
    dataType: "JSON",
    data: {action:"LoadAllGenres"},  
    beforeSend: function() {
       
    },
    success: function(result) {
       //alert("Success");
       let x = JSON.stringify(result);
       // alert(x);
        let html = getselectbox(result);;
        $("#ddgenre").html(html);
    },
    error:function(){
        alert("Error");
}
    });

}
function pushtoserver(author, title, genre){
    $.ajax({
        url: "/limspro/ajax/BooksDBAjax.php",
        type: "POST",
        dataType: "JSON",
        data: {action:"SaveBook",author:author, title:title, genre:genre},  
        beforeSend: function() {
            
        },
        success: function(result) {
           //alert("Success");
           let x = JSON.stringify(result);
            alert(x);
            $("#modalprogram").modal("hide");
            GetAllBooks();
        },
        error:function(){
            alert("Error");
        }
    });
}

    $(document).ready(() => {
        GetAllBooks();
        LoadGenres();
        LoadBooks();
        //add new book
        $(document).on("click", "#btnAddnew", () => {
            $("#modalprogram").modal("show");
        });

        $(document).on("click", "#savebutton", () => {
            let author = $("#txtauthor").val();
            let title = $("#txttitle").val();
            let genre = $("#ddgenre").val();

            if(author != "" && title != ""  && genre != ""){
                pushtoserver(author, title, genre);
            }
            else{
                alert("invalid");
            }
        });
    });//check out button
        $(document).on("click", "#btnchkout", () => {
            $("#chkoutbtn").modal("show");
    });
    $(document).on("click", "#submitbtn", () => {
        let member = $("#txtmemberid").val();
        let userbook = $("#ddbooks").val();
        if(member && userbook != ""){
            ifMemberExists(member);
            
        }
        else{
            alert("invalid");
        }
    
    });
function ifMemberExists(member, userbook){
    $.ajax({
        url: "/limspro/ajax/MembersBDAjax.php",
        type: "POST",
        dataType: "JSON",
        data: {action:"CheckMember",member:member},  
        beforeSend: function() {
        },
        success: function(result) {
            let x = JSON.stringify(result);
            let userbook = $("#ddbooks").val();
            CheckOutBooks(member, userbook);
            $("#chkoutbtn").modal("hide");
        },
        error:function(){
            $("chkoutbtn").modal("hide"); //New Member Form is spawned
            alert("Member not found: Create new member");  
        }
    });
}  
function CheckOutBooks(member, userbook){
    $.ajax({
        url: "/limspro/ajax/TransactionsDBAjax.php",
        type: "POST",
        dataType: "JSON",
        data: {action:"CheckOut",member:member, userbook:userbook},  
        beforeSend: function() {
            
        },
        success: function(result) {
            let x = JSON.stringify(result);
          
           alert("Checked Out Complete");
            $("#chkoutbtn").modal("hide");
        },
        error:function(){
            $("chkoutbtn").modal("hide");
            alert("Error: Max Books Checked Out");  
        }
    });
}

    
//As of 10/27/2023 All code is correct and working.