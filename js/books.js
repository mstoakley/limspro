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
                    <td><button class="btn btn-primary">Check-Out</button>
                  </tr>`;
    });
    table += `</tbody></table>`;
    return addButton + table;
}

function getselectbox(result) {
    let selectbox = `<select id="ddgenres" class="form-control">`;
    result.forEach(genre => {
        selectbox += `<option value="${genre['GID']}">${genre['GName']}</option>`;
    });
    selectbox += `</select>`;
    return selectbox;
}
    

function GetAllBooks() {
    $.ajax({
        url: "/limspro/ajax/BooksDBAjax.php",
        type: "POST",
        dataType: "JSON",
        data: {action:"GetAllBooks"},  
        beforeSend: function() {
            alert("About to send request");
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

function LoadGenres() {
    $.ajax({
        url: "/limspro/ajax/BooksDBAjax.php",
        type: "POST",
        dataType: "JSON",
        data: {action:"LoadGenres"},  
        beforeSend: function() {
            alert("About to send request");
        },
        success: function(result) {
           //alert("Success");
           let x = JSON.stringify(result);
            //alert(x);
            let html = getselectbox(result);
            //alert(html);
            $("#ddgenres").html(html);
        },
        error:function(){
            alert("Error");
        }
});
}


function pushtotheserver(authortext, booktext, ddgenre) {

    $.ajax({
        url: "/limspro/ajax/BooksDBAjax.php",
        type: "POST",
        dataType: "JSON",
        data: {author:authortext,title:booktext,genre:ddgenre,action:"SendBooks"},  
        beforeSend: function() {
            alert("About to send request");
        },
        success: function(result) {
           //alert("Success");
           let x = JSON.stringify(result);

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
    $(document).ready(
        function() {
        GetAllBooks();
        LoadGenres();
        $(document).on("click", "#btnAddnew", function() {
            $("#modalprogram").modal("show");
        });
        $(document).on("click", "#savebutton", function() {
            let author = $("#authortext").val();
            let title = $("#booktext").val();
            let genre = $("#ddgenres").val();

            if(author != "" && title != "" && genre != "") {
                pushtotheserver(author,title,genre);
            }
            else {
                alert("invalid input");
            }
            
        });
      
    }
);
//As of 10/27/2023 All code is correct and working.