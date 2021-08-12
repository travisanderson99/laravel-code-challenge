/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

/**
 * Load modal via ajax
 */
 $(".load-modal").click(function(e) {
    e.preventDefault();
    if ($(e.target).is(".complete-task")) {
        event.stopPropagation();
        return;
    }
    var type = $(this).attr("data-type");
    var method = $(this).attr("data-method");
    var url = $(this).attr("href");
    $.ajax({
        type: "GET",
        url: url,
        success: function(response) {
            // Remove existing modal(s) from DOM
            $(".modal").remove();

            // Append modal to body
            if (!$("." + method + "-" + type).length) {
                $("body").append(response);
            }

            // Show modal
            $("." + method + "-" + type).modal("show");
        },
    });
});

/**
 * Submit forms via ajax (default method)
 */
 $(document).on("submit", "form.ajax", function(e) {
    e.preventDefault();
    var form = $(this);
    var method = $(this)
        .find("input[name=_method]")
        .val()
        ? $(this)
              .find("input[name=_method]")
              .val()
        : $("form").attr("method");
    var token = $("input[name=_token]").val();
    var data = new FormData($(this)[0]);
    var button = $(this).find(".btn-success");
    var buttonText = button.text();
    button.text("Processing...").attr("disabled", true);
    data.append("_method", method);
    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": token,
        },
        url: $(this).prop("action"),
        data: data,
        processData: false,
        contentType: false,
        success: function(response) {
            button.text(buttonText).attr("disabled", false);
            successMessage(response, false);
        },
        error: function(response) {
            button.text(buttonText).attr("disabled", false);
            errorMessage(response, form);
        },
    });
});

/**
 * Global success message function
 */
 function successMessage(response, error) {
    if (response.redirect) {
        location.href = response.redirect;
    } else {
        $(".flash-message").fadeIn("slow");
        $(".alert-danger").show();
        $(".alert-success").hide();

        if (response.error) {
            if ($(".alert-danger p").length > 0) {
                $(".alert-danger p").empty();
            }
            $(".alert-danger").append(
                '<p class="m-0">' + response.success + "</p>"
            );
            $(".flash-message")
                .delay(4000)
                .fadeOut(400);
        } else {
            if ($(".alert-success p").length > 0) {
                $(".alert-success p").empty();
            }
            $(".alert-success").append(
                '<p class="m-0">' + response.success + "</p>"
            );
            $(".flash-message")
                .delay(4000)
                .fadeOut(400);
        }
    }
}

/**
 * Global error message function
 */
function errorMessage(response, form) {
    if (!form.siblings(".alert-danger").length) {
        form.before(
            '<div class="alert alert-danger"><ul class="errors m-0"></ul></div>'
        );
    }
    var response = JSON.parse(response.responseText);
    var alert = form.prevAll(".alert-danger:first");
    if (alert) {
        alert.show();
        if (alert.children("ul").children("li").length > 0) {
            alert.children("ul").empty();
        }
        if (response.errors) {
            $(":input").removeClass("is-invalid");
            $.each(response.errors, function(key, value) {
                alert.children("ul").append("<li>" + value + "</li>");
                if (key.split(".").length > 1) {
                    $(":input[name='" + key.split(".")[0] + "[]']")
                        .eq(key.split(".")[1])
                        .addClass("is-invalid");
                } else {
                    $(":input[name='" + key + "']").addClass("is-invalid");
                }
            });
        } else {
            alert.children("ul").append("<li>" + response.message + "</li>");
        }

        // Scroll to alert box
        $("html, body").animate(
            {
                scrollTop: $(alert).offset().top - 75,
            },
            1000
        );
    }
}