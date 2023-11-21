function gethtml(result) {
    const addButton = `<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups"><div class="btn-group mr-5" role="group" aria-label="Basic example"><button id = "btnAddnew" class="row-xs-1 col-xs-4  btn btn-secondary">Add Book</button></div>`;
    const chkOutBtn = `<button type ="button" button id = "btnchkout" class="row-xs-1 col-xs-4  btn btn-secondary ">Check-Out</button>`;
    const NewmemberBtn = `<button type ="button" button id = "addnewmemb" class="row-xs-1 col-xs-4 btn btn-secondary  ">Add New Member</button>`
    const ReturnBtn = `<button type ="button" button id = "btnreturn" class="row-xs-1 col-xs-4 btn btn-secondary">Return Book</button>`;
    const DeleteBtn = `<button type ="button" button id = "btndelete" class="row-xs-1 col-xs-4  btn btn-secondary">Delete Book</button></div></div>`;

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
    return addButton + chkOutBtn + NewmemberBtn+ ReturnBtn+DeleteBtn+table ;
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
function deleteBooks(result){
    let html = `<select id="ddDeletebooks" class="form-control">`;
    result.forEach(book => {
        html += `<option value="${book['BID']}">${book['BTitle']}</option>`;
    });
    html += `</select>`;
    return html;
}
function availableReturnbooks(result){
    let html = `<select id="ddrbooks" class="form-control">`;
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
function LoadBookTitles(){
    $.ajax({
        url: "/limspro/ajax/BooksDBAjax.php",
        type: "POST",
        dataType: "JSON",
        data: {action:"LoadAllBookTitles"},  
        beforeSend: function() {
            
        },
        success: function(result) {
           //alert("Success");
           let x = JSON.stringify(result);
            //alert(x);
            let html = deleteBooks(result);
            //alert(html);
            $("#ddDeletebooks").html(html);
        },
        error:function(){
            alert("Error");
        }
    });
}
function DeleteBook(userbook){
    $.ajax({
        url: "/limspro/ajax/BooksDBAjax.php",
        type: "POST",
        dataType: "JSON",
        data: {action:"DeleteBook",userbook:userbook},
        beforeSend: function() {
            
        },
        success: function(result) {
           //alert("Success");
           let x = JSON.stringify(result);
            //alert(x);
            alert("Book Deleted");
            $("#deletebtnfrm").modal("hide");
        },
        error:function(){
            alert("Error");
        }

});
}
function LoadCheckedoutBooks(){
    $.ajax({
        url: "/limspro/ajax/TransactionsDBAjax.php",
        type: "POST",
        dataType: "JSON",
        data: {action:"LoadAvailableBooksReturn"},  
        beforeSend: function() {
            
        },
        success: function(result) {
           //alert("Success");
           let x = JSON.stringify(result);
            //alert(x);
            let html = availableReturnbooks(result);
            //alert(html);
            $("#ddrbooks").html(html);
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
        LoadCheckedoutBooks();
        LoadBookTitles();
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
    //delete button
    $(document).on("click", "#btndelete", () => {
        $("#deletebtnfrm").modal("show");
});
$(document).on("click", "#deletesubmitbtn", () => {
    let userbook = $("#ddDeletebooks").val();
    if( userbook != ""){
        DeleteBook(userbook);
        
    }
    else{
        alert("invalid");
    }
});
    //add new member button
    $(document).on("click", "#addnewmemb", () => {
        $("#addmemberbtn").modal("show");
    });

    $(document).on("click", "#membsubmitbtn", () => {
        let firstName = $("#fname").val();
        let lastName = $("#lname").val();
        let email = $("#email").val();
        let address = $("#address").val();
        if(firstName != "" && lastName != "" && email != "" && address != ""){
            addNewMember(firstName, lastName, email, address);
        }
        else{
            alert("invalid");
        }
    });
    //return book button
    $(document).on("click", "#btnreturn", () => {
        $("#returnbtn").modal("show");
    });
    $(document).on("click", "#returnsubmitbtn", () => {
        let returnmember = $("#txtrmemberid").val();
        let returnuserbook = $("#ddrbooks").val();
        if(returnmember && returnuserbook != ""){
            ifCheckedBookOut(returnmember, returnuserbook);
        }
    });

function ifCheckedBookOut(returnmember, returnuserbook){
    $.ajax({
        url: "/limspro/ajax/TransactionsDBAjax.php",
        type: "POST",
        dataType: "JSON",
        data: {action:"CheckCheckOut",returnmember:returnmember, returnuserbook:returnuserbook},  
        beforeSend: function() {
            
        },
        success: function(result) {
            let x = JSON.stringify(result);
           ReturnBooks(returnmember, returnuserbook);
            $("#returnbtn").modal("hide");
        },
        error:function(){
            alert("Member has not checked out this book or Member does not exist");  
        }
    });
    }
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
            $("#addmemberbtn").modal("show"); 

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
function ReturnBooks(returnmember, returnuserbook){
    $.ajax({
        url: "/limspro/ajax/TransactionsDBAjax.php",
        type: "POST",
        dataType: "JSON",
        data: {action:"ReturnBook",returnmember:returnmember, returnuserbook:returnuserbook},  
        beforeSend: function() {
            
        },
        success: function(result) {
            let x = JSON.stringify(result);
          
          DeleteCheckOut(returnmember, returnuserbook);
        },
        error:function(){
            $("#returnbtn").modal("hide");
            alert("Error");  
        }
    });

}
function DeleteCheckOut(returnmember, returnuserbook){
    $.ajax({
        url: "/limspro/ajax/TransactionsDBAjax.php",
        type: "POST",
        dataType: "JSON",
        data: {action:"ReturnBook",returnmember:returnmember, returnuserbook:returnuserbook},  
        beforeSend: function() {
            
        },
        success: function(result) {
            let x = JSON.stringify(result);
          
           alert("Return Complete");
            $$("#returnbtn").modal("hide");
        },
        error:function(){
            $("#returnbtn").modal("hide");
            alert("Error");  
        }
    });


}
function addNewMember(firstName, lastName, email, address){
    $.ajax({
        url: "/limspro/ajax/MembersBDAjax.php",
        type: "POST",
        dataType: "JSON",
        data: {action:"AddMember",firstName:firstName, lastName:lastName, email:email, address:address},  
        beforeSend: function() {
            
        },
        success: function(result) {
            let x = JSON.stringify(result);
            alert("New Member Added: ID is " + x + "");
            $("#addmemberbtn").modal("hide");
        },
        error:function(){
            alert("Error: Member not Added");  
        }
    });
}

    
//As of 10/27/2023 All code is correct and working.