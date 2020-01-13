$(document).ready(function(){
    //document is loaded, ready to run more code

    var search_model = "";
    var search_nickname = "";
    var selected_year = 0;
    var car_id = false;

    all_search();

    $("#search-form").on("submit", function(e){
        e.preventDefault(); //prevent form refresh
    });


    //On keyup start searching cars
    $("#search-form #search-model").on("keyup", function(){
        search_model = $(this).val(); 
        all_search();  
    });

    //On keyup start searching cars
    $("#search-form #search-nickname").on("keyup", function(){
        search_nickname = $(this).val(); 
        all_search();  
    });

    //On change of select field
    $("#year-select").on("change", function(){
        selected_year = $(this).val();
        all_search();
    });

    //on delete button click
    $("#search-results").on("click", "[data-action=delete]", function(){
        car_id = $(this).data("car");

        $("#deleteCarAlert").modal("show");
    });

    //on delete confirmation click
    $("#deleteCarAlert").on("click", "[data-action=confirm-delete]", function(){
        console.log(car_id);
        $.ajax({
            url: "ajax/delete.php",
            type: "POST",
            data: {
                id: car_id
            },
            success: function(result){
                console.log(result);
                $("#deleteCarAlert").modal("hide");
                car_id = false;
                all_search();
            }
        });
    });

    function all_search() {

        $.post(
            'ajax/search.php', //URL of file to call
            {
                search_model: search_model,
                search_nickname: search_nickname,
                year: selected_year
            }, //Data to be passed to field via post
            function(car_data){ //On complete function (returned data)
                if(car_data == "") return;

                var cars = JSON.parse(car_data); //translates php JSON into usable JS 

                var table_rows = '';

                            //for each (index, object)
                $.each(cars, function(i, car){
                    table_rows +=   "<tr><td>"+car.make+
                                    "</td><td>"+car.model+
                                    "</td><td>"+car.year+
                                    "</td><td>"+car.nickname+
                                    "</td><td>"+
                                    "<button class='btn btn-danger' data-action='delete' data-car='"+car.id+"'><i class='fas fa-trash'></i></button>"+
                                    "</td></tr>";
                });

                $("#search-results").html(table_rows);
            }
        ); 

    } //end of all search
    //************************************/

    //on delete confirmation click
    $("button[data-action=add]").on("click", function(){
        var make = $("#add-make").val();
        var model = $("#add-model").val();
        var year = $("#add-year").val();
        var nickname = $("#add-nickname").val();


        $.ajax({
            url: "ajax/insert.php",
            type: "POST",
            data: {
                make: make, 
                model: model,
                year: year,
                nickname: nickname
            },
            success: function(result){
                console.log(result);
                all_search();
            }
        });
    });
});

