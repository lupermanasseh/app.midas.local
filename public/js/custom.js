//custom js file
$(document).ready(function() {
    // Department Change
    $("#product_cat").change(function() {
        // Department id
        var id = $(this).val();

        // Empty the dropdown
        //$("#product_item")
        //.find("option")
        //.not(":first")
        //.remove();

        // AJAX request
        $.get({
            url: "/product/items/" + id,
            //type: "get",
            dataType: "html"
        }).done(function(data) {
            $("#product_item").html(data);
            //INIT SELECT
            $("select").formSelect();
        });
    });

    //approve loan
    $(".approve-loan").on("click", function(e) {
        // Department id
        e.preventDefault();
        //change text
        var myObj = $(this);
        $(this).text("wait...");
        //get url
        var url_link = $(this).attr("href");

        // Empty the dropdown
        //$("#product_item")
        //.find("option")
        //.not(":first")
        //.remove();

        // AJAX request
        $.get({
            url: url_link
            //type: "get",
            //dataType: "html"
        })
            .done(function(data) {
                myObj.text("Approve");
                //reload page
                location.reload(true);
            })
            .fail(function() {
                myObj.text("Approve");
            });
    });
});
