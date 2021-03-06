var Hours, Login, Message, Project, Register, ValidateForm;

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
  $('#login button.login').click(function() {
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
  $('#new_project button.add-project').click(function() {
    var description, project, project_name;
    project_name = $('#new_project input[name="name"]').val();
    description = $('#new_project textarea[name="description"]').val();
    if (project_name === '') {
      return message.display_message('Project must be named');
    } else {
      project = new Project;
      return project.new_project(project_name, description);
    }
  });
  $('#list_projects .projects-wrap .row').click(function() {
    var pid, project;
    pid = $(this).attr('data-pid');
    if (pid === '') {
      return message.display_message('Sorry, there was an error, we can not display that project', 'warning');
    } else {
      project = new Project;
      return project.view_project(pid);
    }
  });
  return $('.record-hours').click(function() {
    var amount, date, hours, pid;
    pid = $(this).attr('data-pid');
    amount = $('input[name="hours"]').val();
    date = $('input[name="date"]').val();
    if (pid === '' || amount === '' || date === '') {
      return message.display_message('Please fill in hours and date fields', 'warning');
    } else {
      hours = new Hours;
      hours.record(pid, amount, date);
      return hours.load(pid);
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
        return message.display_message('Sorry, we are not able to connect at the moment', 'alert');
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
        return message.display_message('Sorry, we are not able to connect at the moment', 'alert');
      }
    });
  };

  return Login;

})();

Project = (function() {
  function Project() {}

  Project.prototype.new_project = function(project_name, description) {
    var message;
    message = new Message;
    return $.ajax({
      url: '/api/index.php',
      type: 'POST',
      data: {
        controller: 'project',
        action: 'new_project',
        name: project_name,
        description: description
      },
      success: function(res) {
        if (res === 'success') {
          return message.display_message('Thanks, project successfully created', 'success');
        } else if (res === 'fail') {
          return message.display_message('Sorry, we were not able to create your project. It may be a duplicate', 'alert');
        } else {
          return message.display_message('Sorry, something unexpected happened', 'warning');
        }
      },
      error: function() {
        return message.display_message('Sorry, we are not able to connect at the moment', 'alert');
      }
    });
  };

  Project.prototype.view_project = function(pid) {
    return window.location = "/index.php?page=view_project&project=" + pid;
  };

  return Project;

})();

Hours = (function() {
  function Hours() {}

  Hours.prototype.record = function(pid, amount, date) {
    var message;
    message = new Message;
    return $.ajax({
      url: '/api/index.php',
      type: 'POST',
      data: {
        controller: 'hours',
        action: 'record_hours',
        pid: pid,
        amount: amount,
        date: date
      },
      success: function(res) {
        if (res === 'success') {
          return message.display_message('Thanks, we successfully recorded those hours', 'success');
        } else if (res === 'fail') {
          return message.display_message('Sorry, we were not able to record that time at this time', 'alert');
        } else {
          return message.display_message('Sorry, something weird happened', 'warning');
        }
      },
      error: function() {
        return message.display_message('Sorry, there was a network error, those hours were not recorded', 'alert');
      }
    });
  };

  Hours.prototype.load = function(pid) {
    return $.ajax({
      url: '/api/index.php',
      type: 'GET',
      data: {
        controller: 'hours',
        action: 'load_hours',
        pid: pid
      },
      success: function(res) {
        return $('.project-hours-wrap').html(res);
      },
      error: function() {
        return $('.project-hours-wrap').html('Please refresh the page');
      }
    });
  };

  return Hours;

})();
