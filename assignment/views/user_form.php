<!DOCTYPE html>
<html lang="en">
<head>
  <title>User Form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
  <script src="<?=base_url() ?>assets/js/user.js"></script>
  <style>
    .refresh{
        background-color: #969696;
        padding: 15px;
        font-size: 18px;
        color: white;
        margin: 0px 10px;
        height: 50px;
        width: 50px;
        border-radius: 5px;
    }
  </style>
</head>
<body>
<div class="container">
    <input type="hidden" id="base_url" value="<?=base_url(); ?>">
    <input type="hidden" id="timeleft" value="1">
  <h2>Fill the following details: <span style="float: right; color: green;" id="countdown"></span></h2>
  <form id="user_form" autocomplete="off" action="#">
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
      <span id="nameError" style="color: red;"></span>
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
      <span id="emailError" style="color: red;"></span>
    </div>   
    <div class="form-group">
       <label for="dob">Date Of Birth:</label>
       <input type="text" id="dob" name="dob" size="20" class="form-control input" placeholder="mm/dd/yyyy" />
       <span id="dobError" style="color: red;"></span>
    </div>
    <div class="form-group">
      <label for="editor">About Yourself:</label>
      <textarea name="content" id="editor">
        </textarea>
      <span id="editorError" style="color: red;"></span>
    </div>
    <script>
        let editor;
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then( newEditor => {
                editor = newEditor;
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
<div class="form-group">
    <div class="row">
        <div class="col-md-6">
           <label for="captcha">Captcha:</label>
            <input type="text" class="form-control" id="captcha" name="captcha" pattern="[A-Z]{6}">
            <span id="captchaError" style="color: red;"></span>
        </div>
        <div class="col-md-6" style="margin-top:10px">
            <img src="<?=base_url(); ?>assets/captcha/captcha.php" alt="CAPTCHA" class="captcha-image">
            <i class="fas fa-redo refresh-captcha refresh"></i>           
        </div>
    </div>
</div>


    <div class="form-group" style="text-align: center">
        <button type="button" onclick="validate();" id="submit" class="btn btn-primary">Submit</button>
    </div>

  </form>
</div>
</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />
</html>
