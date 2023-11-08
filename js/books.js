function gethtml(result) {
    const addButton = `<div class"addnew"><button id = "btnAddnew" class ="btn btn-primary">Add Book</button></div>`;
    let table = `<table class ="table table-striped">
                     <thead>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Genre</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>`;
            //column names for the Books table
    result.forEach(book => {
        table += `<tr>
                    <td>${book['AName']}</td>
                    <td>${book['BTitle']}</td>
                    <td>${book['GName']}</td>
                    <td><button class="btn btn-primary" id = "btnchkout">Check-Out</button></td>
                  </tr>`;
    });
    table += `</tbody></table>`;
    return addButton + table;
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
        $(document).on("click", "#btnchkout", () => {
            $("#chkoutbtn").modal("show");
    });
    });
 
    
//As of 10/27/2023 All code is correct and working.