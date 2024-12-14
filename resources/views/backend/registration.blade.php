<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Alif Medical Center</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('backend/adminlte/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('backend/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('backend/adminlte/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
  <div class="image">
        <img src="{{asset('backend/adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="img-square" style="opacity: .8;height:200px;width:200px;">
    </div>
    <!-- <a href="../../index2.html"><b>Alif Medical Center</a> -->
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="{{route('register')}}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Full name" name="name" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="User ID" name="user_id" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" id="password" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3" id="#rpass">
          <input type="password" class="form-control" placeholder="Retype password" id="passwordr" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <span style="color:red;display:block;" class="mb-3 text-center" id="err-match">Password Not Matched</span>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block" id="submit-btn">Register</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="{{asset('backend/adminlte/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('backend/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('backend/adminlte/dist/js/adminlte.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $('#err-match').hide();
        $('#submit-btn').attr('disabled',true);

        $("#passwordr").on("keyup",function(e){
            if($("#password").val() == $("#passwordr").val()){
                $('#submit-btn').attr('disabled',false);
                $("#rpass").addClass('mb-3');
                $('#err-match').hide();
            }else{
                $('#submit-btn').attr('disabled',true);
                $("#rpass").removeClass('mb-3');
                $('#err-match').show();
            }
        });

    });
</script>
</body>
</html>
