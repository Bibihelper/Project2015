/* Company info */

$("#ci-submit").click(function() {
    var form = $("#company-info-form");
    var sbtn = this;
    
    $.ajax({
        url: "/company/save-info/",
        method: "POST",
        data: form.serialize(),
        dataType: "json",
        success: function(r) {
            if (r.status === "OK") {
                $(sbtn).attr("disabled", "disabled");
            }
        }
    });
});

$("#ci-info").keyup(function() {
    $("#ci-submit").removeAttr("disabled");
});




