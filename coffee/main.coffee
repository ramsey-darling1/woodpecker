#main scripts for woodpecker project hours app
#@rdarling

$(document).ready(->
    validate = new ValidateForm
    message = new Message
    
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
    )
)

class ValidateForm
    correct_length: (length,value) ->
        if value.length < length then false else true

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
                action: 'new_account'
            }
