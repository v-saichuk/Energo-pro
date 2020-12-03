"use strict";

window.onload = function () {
  if (!window.FormData) {
    alert("Браузер не поддерживает загрузку файлов на этом сайте");
  }
};

jQuery(document).ready(function () {
  var errorTxt = 'Ошибка отправки';
  jQuery("#sendform").validate({
    submitHandler: function submitHandler(form) {
      var form = document.forms.sendform,
          formData = new FormData(form),
          xhr = new XMLHttpRequest();
      jQuery(".header__form").addClass("header__form--wait");
      xhr.open("POST", "mail/multisend.php");

      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
          if (xhr.status == 200) {
            message();
            jQuery(".header__form").removeClass("header__form--wait");
            $('.header__form-input').val('');
          }
        }
      };

      xhr.send(formData);
    }
  });
});

function message() {
  $('#message').html();
  $("#message_box").fadeIn(0).delay(2000).fadeOut(1000);
}

function sendSuccess(callback) {
  jQuery(callback).find();
  startClock();
}