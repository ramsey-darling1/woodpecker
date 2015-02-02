#main scripts for woodpecker project hours app
#@rdarling

$(document).ready(->
    validate = new ValidateForm
    message = new Message
    
    #Register Form
    $('#register input[name="username"]').focusout(->
        username = $(this).val()
        if !validate.correct_length(6,username)
            message.display_message('Sorry, that username is not long enough','warning')
            $(this).addClass('error')
        else
            $(this).removeClass('error')
            message.remove_message
    )
    $('#register input[name="email"]').focusout(->
        email = $(this).val()
        if !validate.is_email(email)
            message.display_message('Sorry, that is not a valid email','warning')
            $(this).addClass('error')
        else
            $(this).removeClass('error')
            message.remove_message
    )
    $('#register button.create-account').click(->
        username = $('#register input[name="username"]').val()
        email = $('#register input[name="email"]').val()
        password = $('#register input[name="password"]').val()
        if username is '' or email is '' or password is ''
            message.display_message('Sorry, no blank values')
        else
            register = new Register
            register.new_account({email:email,username:username,password:password})
    )
    #LogIn
    $('#login button.login').click(->
        username = $('#login input[name="username"]').val()
        password = $('#login input[name="password"]').val()
        if username is '' or password is ''
            message.display_message('Please fill out both username and password')
        else
            login = new Login
            login.login(username,password)
    )
)

#models
class ValidateForm
    correct_length: (length,value) ->
        if value.length < length then false else true
    is_email: (email) ->
        if email.length < 6 or email.length > 50
            false
        else if email.indexOf('@') is -1 or email.indexOf('.') is -1
            false
        else
            true

class Message
    display_message: (message,type) ->
        $('.res-message').html("<div data-alert class=\"alert-box #{type} radius\">#{message}<a href=\"#\" class=\"close\">&times;</a></div>")

    remove_message: ->
        $('.res-message').fadeOut()

class Register
    new_account: (account_data) ->
        $.ajax
            url: '/api/index.php'
            type: 'POST'
            data: {
                controller: 'account',
                action: 'new_account',
                email: account_data['email'],
                username: account_data['username'],
                password: account_data['password']
            },
            success: (res) ->
                #res will be a string, "log_in" or an error message string
                if res is 'log_in'
                    window.location = '/'
                else
                    message = new Message
                    message.display_message(res,'alert')
            error: ->
                message = new Message
                message.display_message('Sorry, we are not able to connect at the moment','error')
class Login
    login: (username,password) ->
        $.ajax
            url: '/api/index.php'
            type: 'POST'
            data: {
                controller: 'account',
                action: 'login',
                username: username,
                password: password
            },
            success: (res) ->
                #res will be a string, "log_in" or an error message string
                if res is 'log_in'
                    window.location = '/'
                else
                    message = new Message
                    message.display_message(res,'alert')
            error: ->
                message = new Message
                message.display_message('Sorry, we are not able to connect at the moment','error')
