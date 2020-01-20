//registering promise
if (!window.Promise) {
    window.Promise = Promise;
}
//Registering  service worker
if ("serviceWorker" in navigator) {
    navigator.serviceWorker
        .register("/sw.js")
        .then(function() {
            console.log("Service worker registered!");
        })
        .catch(function(err) {
            console.log(err);
        });
}

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

    //post loan repayment
    $(".post-loan").on("click", function(e) {
        // Department id
        e.preventDefault();
        //change text
        var myButtonObj = $(this);
        $(this).text("posting...");
        //get url
        var url_link = $(this).attr("href");

        // AJAX request
        $.get({
            url: url_link
            //type: "get",
            //dataType: "html"
        })
            .done(function(data) {
                myButtonObj.text("Processed")
                           .addClass('disable');
                //reload page
                //location.reload(true);
            })
            .fail(function() {
                myButtonObj.text("Post Loan");
            });
    });

    //end post loan repayment

    //Approve savings deposit
    $(".approve-saving").on("click", function(e) {
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
                //myObj.text("Approve");
                //reload page
                location.reload(true);
            })
            .fail(function() {
                myObj.text("Approve");
            });
    });
});
