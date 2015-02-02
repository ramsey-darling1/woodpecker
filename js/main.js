var Login, Message, Register, ValidateForm;

$(document).ready(function() {
  var message, validate;
  validate = new ValidateForm;
  message = new Message;
  $('#register input[name="username"]').focusout(function() {
    var username;
    username = $(this).val();
    if (!validate.correct_length(6, username)) {
      message.display_message('Sorry, that username is not long enough', 'warning');
      return $(this).addClass('error');
    } else {
      $(this).removeClass('error');
      return message.remove_message;
    }
  });
  $('#register input[name="email"]').focusout(function() {
    var email;
    email = $(this).val();
    if (!validate.is_email(email)) {
      message.display_message('Sorry, that is not a valid email', 'warning');
      return $(this).addClass('error');
    } else {
      $(this).removeClass('error');
      return message.remove_message;
    }
  });
  $('#register button.create-account').click(function() {
    var email, password, register, username;
    username = $('#register input[name="username"]').val();
    email = $('#register input[name="email"]').val();
    password = $('#register input[name="password"]').val();
    if (username === '' || email === '' || password === '') {
      return message.display_message('Sorry, no blank values');
    } else {
      register = new Register;
      return register.new_account({
        email: email,
        username: username,
        password: password
      });
    }
  });
  return $('#login button.login').click(function() {
    var login, password, username;
    username = $('#login input[name="username"]').val();
    password = $('#login input[name="password"]').val();
    if (username === '' || password === '') {
      return message.display_message('Please fill out both username and password');
    } else {
      login = new Login;
      return login.login(username, password);
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

  ValidateForm.prototype.is_email = function(email) {
    if (email.length < 6 || email.length > 50) {
      return false;
    } else if (email.indexOf('@') === -1 || email.indexOf('.') === -1) {
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

  Message.prototype.remove_message = function() {
    return $('.res-message').fadeOut();
  };

  return Message;

})();

Register = (function() {
  function Register() {}

  Register.prototype.new_account = function(account_data) {
    return $.ajax({
      url: '/api/index.php',
      type: 'POST',
      data: {
        controller: 'account',
        action: 'new_account',
        email: account_data['email'],
        username: account_data['username'],
        password: account_data['password']
      },
      success: function(res) {
        var message;
        if (res === 'log_in') {
          return window.location = '/';
        } else {
          message = new Message;
          return message.display_message(res, 'alert');
        }
      },
      error: function() {
        var message;
        message = new Message;
        return message.display_message('Sorry, we are not able to connect at the moment', 'error');
      }
    });
  };

  return Register;

})();

Login = (function() {
  function Login() {}

  Login.prototype.login = function(username, password) {
    return $.ajax({
      url: '/api/index.php',
      type: 'POST',
      data: {
        controller: 'account',
        action: 'login',
        username: username,
        password: password
      },
      success: function(res) {
        var message;
        if (res === 'log_in') {
          return window.location = '/';
        } else {
          message = new Message;
          return message.display_message(res, 'alert');
        }
      },
      error: function() {
        var message;
        message = new Message;
        return message.display_message('Sorry, we are not able to connect at the moment', 'error');
      }
    });
  };

  return Login;

})();
