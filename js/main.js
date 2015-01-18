var Message, ValidateForm;

$(document).ready(function() {
  return $('#register input[name="username"]').focusout(function() {
    var message, username, validate;
    username = $(this).val();
    validate = new ValidateForm;
    if (!validate.correct_length(6, username)) {
      message = new Message;
      message.display_message('Sorry, that username is not long enough', 'warning');
      return $(this).addClass('error');
    } else {
      return $(this).removeClass('error');
    }
  });
});

ValidateForm = (function() {
  function ValidateForm() {}

  ValidateForm.prototype.correct_length = function(length, value) {
    if (value.length < length) {
      return false;
    } else {
      return true;
    }
  };

  return ValidateForm;

})();

Message = (function() {
  function Message() {}

  Message.prototype.display_message = function(message, type) {
    return $('.res-message').html("<div data-alert class=\"alert-box " + type + " radius\">" + message + "<a href=\"#\" class=\"close\">&times;</a></div>");
  };

  return Message;

})();
