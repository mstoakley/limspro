function AllBooksCheckedOut() {
    const allBooksBtn = `<div class="btn-group" role="group" aria-label="Basic example"><button id="allBooksCheckdout" class="btn btn-primary">All Books Checked Out</button></div>`;
    return allBooksBtn;
}

function FinesOver20() {
    const FinesBtn = `<div class="btn-group" role="group" aria-label="Basic example"><button id="finesover20" class="btn btn-primary">Fines Over 20$</button></div>`;
    return FinesBtn;
}


function AllMembers() {
    const AllmembsBtn = `<div class="btn-group" role="group" aria-label="Basic example"><button id="allmembs" class="btn btn-primary">All Members</button></div>`;
    return AllmembsBtn;
}

function BackButton(){
    const backBtn = `<div class="btn-group" role="group" aria-label="Basic example"><button id="back" class="btn btn-primary">Back</button></div>`;
    return backBtn;
}
function GetAllBooks() {
    $.ajax({
        url: "/limspro/ajax/ReportsAjax.php",
        type: "POST",
        dataType: "JSON",
        data: { action: "GetAllCheckedOutBooks" },
        beforeSend: function () {},
        success: function (result) {
            let table = `<table class="table table-striped">
            <thead>
               <th>Id</th>
               <th>Title</th>
               <th>Author</th>
               <th>Due Date</th>
           </thead>
           <tbody>`;
            result.forEach(book => {
                table += `<tr>
           <td>${book['BookID']}</td>
           <td>${book['BookTitle']}</td>
           <td>${book['AuthorName']}</td>
           <td>${book['DueDate']}</td>
         </tr>`;
            });
            table += `</tbody></table>`;
            $("#contentdiv").html(table);
           
        },
        error: function () {
            alert("Error");
        }
    });
}



function GetFines() {
    $.ajax({
        url: "/limspro/ajax/ReportsAjax.php",
        type: "POST",
        dataType: "JSON",
        data: { action: "GetFinesOver20" },
        beforeSend: function () {},
        success: function (result) {
            let table = `<table class="table table-striped">
            <thead>
               <th>Member</th>
               <th>Fine</th>
           </thead>
           <tbody>`;
result.forEach(fine => {
table += `<tr>
           <td>${fine['MemberID']}</td>
           <td>${fine['FineAmount']}</td>
         </tr>`;
});
table += `</tbody></table>`;
            $("#contentdiv").html(table);
        },
        error: function () {
            alert("Error");
        }
    });
}



function GetAllMembers() {
    $.ajax({
        url: "/limspro/ajax/ReportsAjax.php",
        type: "POST",
        dataType: "JSON",
        data: { action: "GetAllMembers" },
        beforeSend: function () {},
        success: function (result) {
            let table = `<table class="table table-striped">
                     <thead>
                        <th>Id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Address</th>
                    </thead>
                    <tbody>`;
    result.forEach(member => {
        table += `<tr>
                    <td>${member['ID']}</td>
                    <td>${member['FirstName']}</td>
                    <td>${member['LastName']}</td>
                    <td>${member['Email']}</td>
                    <td>${member['HomeAddress']}</td>
                  </tr>`;
    });
    table += `</tbody></table>`;
            $("#contentdiv").html(table);        
        },
        error: function () {
            alert("Error");
        }
    });
}

$(document).ready(() => {
    $("#contentdiv").html(AllBooksCheckedOut() + FinesOver20() + AllMembers());
   
    $("#allBooksCheckdout").click(function () {
        GetAllBooks();
        
        
    });

    $("#finesover20").click(function () {
        GetFines();
       
    });

    $("#allmembs").click(function () {
        GetAllMembers();
        $("#contentdiv").html(BackButton());
        
    });
});

