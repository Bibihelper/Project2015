/* User options */

$("body").on("beforeSubmit", "form#change-password-form, form#change-email-form", proceedChangeForm);

function proceedChangeForm() {
     var form = $(this);
     if (form.find('.has-error').length) {
          return false;
     }
     $.ajax({
          url: form.attr("action"),
          method: "post",
          data: form.serialize(),
          success: function (r) {
                alert(r.message);
          }
     });
     return false;
};


