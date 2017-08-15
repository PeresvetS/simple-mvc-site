var allProductTypes = [
    "Men",
    "Women",
    "Kids"
];


function copyValueTo(fromElem, toElemId) {
    var elem = document.getElementById(toElemId);
    elem.value = fromElem.value;
    if (toElemIdSecond !== null) {
        var elemSecond = document.getElementById(toElemIdSecond);
        elemSecond.value = fromElem.value;
    }
}

function deleteSimilar(anchor) {
    var counter = 0;
    $("tr").each(function() {
        var targetEl = $(this).hasClass(anchor);
        if (targetEl) {
            if (counter == 0) {
                $(this).removeClass("hidden");
            }
            counter += 1;
        }
    });
    return counter;
}

function increaseParams(total, anchor) {
    $("." + anchor).find(".quantity").attr("value", String(total));

    var oldPrice = $("." + anchor).find(".singlePrice").text();
    var newPrice = Number(oldPrice.split("$")[1]) * total;

    $("." + anchor).find(".totalPrice").text('$' + String(newPrice));
}

function prepareBasket(arr) {
    arr.forEach(function(anchor) {
        var totalSimilar = deleteSimilar(anchor);
        if (totalSimilar > 1) {
            increaseParams(totalSimilar, anchor);
        }
    });
}

$(".hider").addClass("hidden");



$(document).ready(function() {

    $(".basket").tooltip();
    prepareBasket(allProductTypes);

    $(".addToBasket").submit(function(e) {
        var form = $(this);
        var form_data = form.serialize();
        var isLogin = $(this).hasClass("canBuy");
        $.ajax({
            type: "POST",
            url: "/basket/",
            data: form_data,
            beforeSend: function(data) {
                form
                    .find('button[type="submit"]')
                    .attr("disabled", "disabled");
            },
            success: function() {
                $("#basket").load("/ .basket");
            },
            complete: function(data) {
                form.find('button[type="submit"]').prop("disabled", false);
            }
        });
        if (isLogin) {
            e.preventDefault();
        }
    });

});