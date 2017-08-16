function copyValueTo(fromElem, toElemId) {
    var elem = document.getElementById(toElemId);
    elem.value = fromElem.value;
}

function deleteSimilar(anchor) {
    var counter = 0;
    $(anchor).each(function() {
        if (counter == 0) {
            $(this).removeClass("hidden");
        } else {
            $(this).remove();
        }
        counter += 1;
    });
    return counter;
}

function increaseParams(total, anchor) {
    $(anchor).find(".quantity").attr("value", String(total));

    var oldPrice = $(anchor).find(".singlePrice").text();
    var newPrice = Number(oldPrice.split("$")[1]) * total;

    $(anchor).find(".totalPrice").text('$' + String(newPrice));
}


function showMessageUser() {
    var message = $(".user-profile").attr("id");

    switch (message) {
        case "pass-success":
            $(".success-password").removeClass("hidden");
            break;
        case "pass-error":
            $(".error-password").removeClass("hidden");
            break;
        case "email-success":
            $(".success-email").removeClass("hidden");
            break;
        case "email-error":
            $(".error-email").removeClass("hidden");
            break;
        default:
            break;
    }
}

function showMessageOrder() {
    var message = $(".order-page").attr("id");
    switch (message) {
        case "success":
            alert("Your order has been created!");
            break;
        case "error":
            alert("Failed! Please, try again.");
            break;
        default:
            break;
    }
}


function prepareBasket() {
    $(".hider").each(function() {
        var anchor = "." + $(this).attr("class").split(" ")[0];
        var totalSimilar = deleteSimilar(anchor);
        if (totalSimilar > 1) {
            increaseParams(totalSimilar, anchor);
        }
    });
}


function sendPost(form, url) {
    var formData = form.serialize();
    $.ajax({
        type: "POST",
        url: url,
        data: formData,
        beforeSend: function() {
            form.find('button[type="submit"]').attr("disabled", "disabled");
        },
    });
}



function checkPasses(pass1, pass2) {
    if (pass1.val() != "" && pass2.val() != "") {
        if (pass1.val() == pass2.val()) {
            pass1.parent().removeClass("has-error").addClass("has-success");
            pass2.parent().removeClass("has-error").addClass("has-success");
        } else {
            pass1.parent().removeClass("has-success").addClass("has-error");
            pass2.parent().removeClass("has-success").addClass("has-error");
        }
    }
}




$(".hider").addClass("hidden");


$(document).ready(function() {


    $(".pass1").keyup(function() {
        checkPasses(pass1, pass2);
    });
    $(".pass2").keyup(function() {
        checkPasses(pass1, pass2);
    });


    $(".basket").tooltip();

    prepareBasket();
    showMessageUser();
    showMessageOrder();


    $(".changeBasket").submit(function(e) {
        var form = $(this);
        sendPost(form, "/basket/");
    });

    $(".masterChange").submit(function(e) {
        var form = $(this);
        sendPost(form, "/master/changeGood/");
    });

});