<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>maria.bg - Админ</title>
  
  
  <link rel='stylesheet prefetch' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'>

      <link rel="stylesheet" href="{{ Config::get('view.backend.css') }}/login.css">

  
</head>

<body>
  <div class='brand'>
  <a href='https://www.jamiecoulter.co.uk' target='_blank'>
    <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/217233/logo.png'>
  </a>
</div>
<div class='login'>
  <div class='login_title'>
    <span>Admin Panel</span>
  </div>
  <div class='login_fields'>
    <div class='login_fields__user'>
      <div class='icon'>
        <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/217233/user_icon_copy.png'>
      </div>
      <input placeholder='Имейл' id="email" type='text'>
        <div class='validation'>
          <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/217233/tick.png'>
        </div>
      </input>
    </div>
    <div class='login_fields__password'>
      <div class='icon'>
        <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/217233/lock_icon_copy.png'>
      </div>
      <input placeholder='Парола' id="pass" type='password'>
      <div class='validation'>
        <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/217233/tick.png'>
      </div>
    </div>
    <div class='login_fields__submit'>
      <input type='submit' value='Влез'>
    </div>
  </div>
  <div class='success'>
    <h2>Успешно влизане</h2>
  </div>
  <div  class='disclaimer'>
    <p id="disclaimer"></p>
  </div>
</div>
<div class='authent'>
  <img src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/217233/puff.svg'>
  <p>Удостоверява се...</p>
</div>
<div class='love'>
  <p>Made with <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/217233/love_copy.png" /> by MARIA OFFICIAL 2018</p>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>

    {{-- <script  src="{{ Config::get('view.backend.js') }}/login.js"></script> --}}
    <script type="text/javascript">
      var csrf = "{{ csrf_token() }}";
      $('input[type="submit"]').click(function(){
        
         $.ajax({
                type: "post",
                dataType: "json",
                url: "{{ route('login') }}",
                data: {
                  'email' : document.getElementById('email').value,
                  'password' : document.getElementById('pass').value,
                  '_token': csrf,
                },
                success: function (response) {
                    if (response.success) {
                        showloader();

                    }
                    else {
                        document.getElementById("disclaimer").innerText = response.errormessage;
                    }
                },
                error: function (response) {
                   document.getElementById("disclaimer").innerText = response.errormessage;
                }
            });
          });

        

          function showloader()
          {
            $('.login').addClass('test')
              setTimeout(function(){
                $('.login').addClass('testtwo')
              },300);
              setTimeout(function(){
                $(".authent").show().animate({right:-320},{easing : 'easeOutQuint' ,duration: 600, queue: false });
                $(".authent").animate({opacity: 1},{duration: 200, queue: false }).addClass('visible');
                
                setTimeout(function(){
                  document.location.href = '{{ route('dashboard') }}';
                },600);
                   
              },600);
          }

          function releaseLoader() {
              setTimeout(function(){
                  $(".authent").show().animate({right:90},{easing : 'easeOutQuint' ,duration: 600, queue: false });
                  $(".authent").animate({opacity: 0},{duration: 200, queue: false }).addClass('visible');
                  $('.login').removeClass('testtwo')
                },2500);
                setTimeout(function(){
                  $(".authent").removeClass('visible');
                   $(".authent").css('display', "none");
                  $('.login').removeClass('test')
                },2800);
                  var open = 0;
                  $('.tab').click(function(){
                    $(this).fadeOut(200,function(){
                      $(this).parent().animate({'left':'0'})
                    });

                  });
          }

    </script>


</body>
</html>
