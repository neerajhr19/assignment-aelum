window.onload = function () {
    var duration =  60 * 3;      // 180 sec/3 minute duration for countdown
    startTimer(duration);       // initiate timer
    // date picker initiate
    var date_input = $('input[name="dob"]'); 
    var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
    date_input.datepicker({
        format: 'yyyy-mm-dd',
        container: container,
        todayHighlight: true,
        autoclose: true,
    });

    // refresh captcha
    var refreshButton = document.querySelector(".refresh-captcha");
    refreshButton.onclick = function() {
        refreshCaptcha();
    }

    // load captcha on page load
    refreshCaptcha();
};

function refreshCaptcha() {         // get and bind captcha to img tag
    $("#capimg").attr("src", "");
    var baseUrl = $("#base_url").val();
    $.ajax({
        type: "POST",
        url: baseUrl + "Web/refreshcapcha",
        success: function(resultFeed) {
            console.log(resultFeed);
            if (resultFeed.filename != "") {
                $("#capimg").attr("src", resultFeed.newImage);
                $("#capimg").css('display','inline');
            } else {
                return;
            }
        },
        error: function(err) {
            console.log(err);
        }
    });
}


function startTimer(duration) {             // timer
    var timer = duration, minutes, seconds;
    x = setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
        $('#countdown').html('Time Left : '+ minutes+':'+seconds);
        if (--timer < 0) {
            // clear interval on time out
            clearInterval(x);
            $('#countdown').html('Times Out : '+ minutes+':'+seconds);
            $('#countdown').css('color','red');
            $('#timeleft').val(0);     
            alert('Sorry! Times out.');
        }
    }, 1000);
}

function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}


function validate(){        // form validation
    if($('#timeleft').val()==0){
        alert('Sorry! Times out.');
        return;
    }
    $('#nameError').html('');
    if($('#name').val()==''){
        $('#nameError').html('Enter Name');
        $('#name').focus();
        return false;
    }

    $('#emailError').html('');
    if($('#email').val()==''){
        $('#emailError').html('Enter Email');
        $('#email').focus();
        return false;
    }

    if(!validateEmail($('#email').val())){
        $('#emailError').html('Enter Valid Email');
        $('#email').focus();
        return false;
    }

    $('#dobError').html('');
    if($('#dob').val()==''){
        $('#dobError').html('Enter Date Of Birth');
        $('#dob').focus();
        return false;
    }

    $('#editorError').html('');
    if(editor.getData() == ''){
        $('#editorError').html('Enter About Yourself');
        editor.focus();
        return false;
    }
    $('#captchaError').html('');
    if($('#captcha').val()==''){
        $('#captchaError').html('Enter captcha');
        $('#captcha').focus();
        return false;
    }
    editor.updateSourceElement();   // update ckeditor data

    // form submit using ajax
    $.ajax({
        url: $('#base_url').val()+'Web/form_submit',
        type: 'post',
        dataType: 'json',
        data: $('form#user_form').serialize(),
        success: function(json) {
                    alert(json.message);
                    if(json.success==1){
                        window.location.reload();
                    }                    
                 },
                 error: function(e){
                    alert('some error occured, try again later');
                 }
    });
}
