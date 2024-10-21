<div>
<style>
    body a:hover {
      border-bottom: 2px solid #40b3ff;
      opacity: 1;
    }
    .field {
      margin-bottom: 25px;
    }
    .field.full {
      width: 100%;
    }
    .field.half {
      width: calc(50% - 12px);
    }
    .field label {
      display: block;
      text-transform: uppercase;
      font-size: 12px;
      margin-bottom: 8px;
    }
    .field input {
      padding: 12px;
      border-radius: 6px;
      border: 2px solid #e8ebed;
      display: block;
      font-size: 14px;
      width: 100%;
      box-sizing: border-box;
    }
    .field input:placeholder {
      color: #e8ebed !important;
    }
    .flex {
      display: flex;
      flex-direction: row wrap;
      align-items: center;
    }
    .flex.justify-space-between {
      justify-content: space-between;
    }
    .card {
      padding: 50px;
      margin: 50px auto;
      max-width: 850px;
      background: #fff;
      border-radius: 6px;
      box-sizing: border-box;
      box-shadow: 0px 24px 60px -1px rgba(37,44,54,0.14);
    }
    .card .container {
      max-width: 700px;
      margin: 0 auto;
    }
    .card .card-title {
      margin-bottom: 50px;
    }
    .card .card-title h2 {
      margin: 0;
    }
    .card .card-body .payment-type,
    .card .card-body .payment-info {
      margin-bottom: 25px;
    }
    .card .card-body .payment-type h4 {
      margin: 0;
    }
    .card .card-body .payment-type .types {
      margin: 25px 0;
    }
    .card .card-body .payment-type .types .type {
      width: 30%;
      position: relative;
      background: #f2f4f7;
      border: 2px solid #e8ebed;
      padding: 25px;
      box-sizing: border-box;
      border-radius: 6px;
      cursor: pointer;
      text-align: center;
      transition: all 0.5s ease;
    }
    .card .card-body .payment-type .types .type:hover {
      border-color: #28333b;
    }
    .card .card-body .payment-type .types .type:hover .logo,
    .card .card-body .payment-type .types .type:hover p {
      color: #28333b;
    }
    .card .card-body .payment-type .types .type.selected {
      border-color: #40b3ff;
      background: rgba(64,179,255,0.1);
    }
    .card .card-body .payment-type .types .type.selected .logo {
      color: #40b3ff;
    }
    .card .card-body .payment-type .types .type.selected p {
      color: #28333b;
    }
    .card .card-body .payment-type .types .type.selected::after {
      content: '\f00c';
      font-family: 'Font Awesome 5 Free';
      font-weight: 900;
      position: absolute;
      height: 40px;
      width: 40px;
      top: -21px;
      right: -21px;
      background: #fff;
      border: 2px solid #40b3ff;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .card .card-body .payment-type .types .type .logo,
    .card .card-body .payment-type .types .type p {
      transition: all 0.5s ease;
    }
    .card .card-body .payment-type .types .type .logo {
      font-size: 48px;
      color: #8a959c;
    }
    .card .card-body .payment-type .types .type p {
      margin-bottom: 0;
      font-size: 10px;
      text-transform: uppercase;
      font-weight: 600;
      letter-spacing: 0.5px;
      color: #8a959c;
    }
    .card .card-body .payment-info .column {
      width: calc(50% - 25px);
    }
    .card .card-body .payment-info .title {
      display: flex;
      flex-direction: row;
      align-items: center;
    }
    .card .card-body .payment-info .title .num {
      height: 24px;
      width: 24px;
      border-radius: 50%;
      border: 2px solid #40b3ff;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      margin-right: 12px;
      font-size: 12px;
    }
    footer {
      margin: 50px auto;
      max-width: 850px;
      text-align: center;
    }
    .button {
      text-transform: uppercase;
      font-weight: 600;
      font-size: 12px;
      letter-spacing: 0.5px;
      padding: 15px 25px;
      border-radius: 50px;
      cursor: pointer;
      transition: all 0.5s ease;
      background: transparent;
      border: 2px solid transparent;
    }
    .button.button-link {
      padding: 0 0 2px;
      margin: 0 25px;
      border-bottom: 2px solid rgba(64,179,255,0.5);
      border-radius: 0;
      opacity: 0.75;
    }
    .button.button-link:hover {
      border-bottom: 2px solid #40b3ff;
      opacity: 1;
    }
    .button.button-primary {
      background: #40b3ff;
      color: #fff;
    }
    .button.button-primary:hover {
      background: #218fd9;
    }
    .button.button-secondary {
      background: transparent;
      border-color: #e8ebed;
      color: #8a959c;
    }
    .button.button-secondary:hover {
      border-color: #28333b;
      color: #28333b;
    }
    .bcm-form{
        position: fixed;
        width: 100vw;
        height: 100vh;
        top: 0;
        background: rgba(0, 0, 0, 0.664);
        display: none;
    }
    .form-card{
        position: fixed;
        left: 50%;
        top: 20%;
        transform: translateY(-50%);
        transform: translateX(-50%);
        display: none;
    }
    .login-form{
        width: 500px;
        transform: translateY(-50%);    
    }
    .form-logo{
        position: relative;
        top: -37px;
        left: 50%;
        transform: translate(-50%);
        z-index: 1;
    }
    .my-card{
      position: fixed;
      left: 50%;
      top: -20px;
      transform: translateX(-50%);
      border-radius: 10px;
      box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.15),0px 5px 10px rgba(0, 0, 0, 0.15);    
      width: 50vw;
      margin: 3em;
      z-index: 1;
      display: none;
    }
    .left-text{
      width: 100%;
      height: 100%;
      
    }
    .left-side{
        width: auto;
      padding: 3em;
      border-radius: 10px 0 0 10px;
      background-color: rgb(24, 24, 85);
      box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.15),0px 5px 10px rgba(0, 0, 0, 0.15);    
    }
    .right-side{
      background: white;
      line-height: 10px;
    }
    .pay-now-bg{
      position: fixed;
      top: 0;
      width: 100vw;
      height: 100vh;
      background-color: rgba(0, 0, 0, 0.76);
      display: none;
    }
    .user-info{
        display: none;
    }
    .acc-n,.acc-a,.acc-c{
        border: none;
    }
    .conf-pass-bg{
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.753);
        display: none;
        z-index: 2;
    }
    .inf{
      position: fixed;
      width: 80vw;
      left: 50%;
      transform: translateX(-50%);
      top: 30%;
      z-index: 3;
      display: none;
    }
    .paynow{
        position: fixed;
        background: white;
        top: 50%;
        left: 50%;
        transform: translate(-50%);
        padding: 1em;
        border-radius: 10px;
        box-shadow: inset 0 -3em 3em rgba(0, 0, 0, 0.1), 0 0 0 2px rgb(255, 255, 255),
        0.3em 0.3em 1em rgba(0, 0, 0, 0.3);    
        display: none;
        z-index: 3;
    }

        @keyframes flip {
    0% {
        transform: rotateY(0);
    }
    100% {
        transform: rotateY(-180deg);
    }
    }

    .loader {
    width: 65px;
    margin: auto;
    }
    .loader__image {
    display: flex;
    flex-direction: column;
    align-items: center;
    }
    .loader__coin {
    animation: flip 0.5s ease-in-out infinite alternate-reverse both;
    }
    @supports ((-webkit-animation: grow 0.5s cubic-bezier(0.25, 0.25, 0.25, 1) forwards) or (animation: grow 0.5s cubic-bezier(0.25, 0.25, 0.25, 1) forwards)) {
    .tick {
        stroke-opacity: 0;
        stroke-dasharray: 29px;
        stroke-dashoffset: 29px;
        -webkit-animation: draw 0.5s cubic-bezier(0.25, 0.25, 0.25, 1) forwards;
                animation: draw 0.5s cubic-bezier(0.25, 0.25, 0.25, 1) forwards;
        -webkit-animation-delay: 0.6s;
                animation-delay: 0.6s;
    }

    .circle {
        fill-opacity: 0;
        stroke: #219a00;
        stroke-width: 16px;
        transform-origin: center;
        transform: scale(0);
        -webkit-animation: grow 1s cubic-bezier(0.25, 0.25, 0.25, 1.25) forwards;
                animation: grow 1s cubic-bezier(0.25, 0.25, 0.25, 1.25) forwards;
    }
    }
    @-webkit-keyframes grow {
    60% {
        transform: scale(0.8);
        stroke-width: 4px;
        fill-opacity: 0;
    }
    100% {
        transform: scale(0.9);
        stroke-width: 8px;
        fill-opacity: 1;
        fill: #219a00;
    }
    }
    @keyframes grow {
    60% {
        transform: scale(0.8);
        stroke-width: 4px;
        fill-opacity: 0;
    }
    100% {
        transform: scale(0.9);
        stroke-width: 8px;
        fill-opacity: 1;
        fill: #219a00;
    }
    }
    @-webkit-keyframes draw {
    0%, 100% {
        stroke-opacity: 1;
    }
    100% {
        stroke-dashoffset: 0;
    }
    }
    @keyframes draw {
    0%, 100% {
        stroke-opacity: 1;
    }
    100% {
        stroke-dashoffset: 0;
    }
    }
    :root {
    --theme-color: var(--color-purple);
    }
    .bdy {
        position: fixed;
        top: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100vw;
        height: 100vh;
        background-color: #F1F2E6;
    }

    .box {
        position: fixed;
        top: 0;
        width: 100vw;
        height: 100vh;
        background: white;
        display: none;
    }
    .svg-img{
        position: relative;
        top: 320px;
        left: 50%;
        transform: translateX(-50%);
    }
    .left-c{
        width: 75px;
    }
        @media(max-width:420px){
            .type{
                width: 150px;        
            }
            .form-card{
                width: 90vw;
            }
            .login-form{
              padding-top: 70px;
              width: 100%;
            }
            .button{
                padding: 15px;
            }
            .my-card{
                top: 20px;
                width: 90vw;
                margin: 0;
            }
            .left-side{
            padding: 1em;
            width: 100vw;
            border-radius: 10px 10px 0 0;
            }

        }
</style>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=DM+Sans:400,500,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <article class="card">
        <div class="container">
            <div class="card-title">
                <h2>Payment</h2>
            </div>
            <div class="card-body">
                <div class="payment-type">
                    <h4>Choose payment method below</h4>
                    <div class="types row justify-space-between">
                        <div class="col me-2 type credit selected">
                            <div class="logo">
                                <i class="far fa-credit-card"></i>
                            </div>
                            <div class="text">
                                <p>Pay with Credit Card</p>
                            </div>
                        </div>
                        {{-- <div class="type paypal">
                            <div class="logo">
                                <i class="fab fa-paypal"></i>
                            </div>
                            <div class="text">
                                <p>Pay with PayPal</p>
                            </div>
                        </div>
                        <div class="type amazon">
                            <div class="logo">
                                <i class="fab fa-amazon"></i>
                            </div>
                            <div class="text">
                                <p>Pay with Amazon</p>
                            </div>
                        </div> --}}
                        <div class="col ms-2 type bcm bcm-btn">
                            <div class="logo">
                                {{-- <i class="fab fa-amazon"></i> --}}
                                <button class="btn log" disabled><img src="{{asset('assets/imgs/logo/logo.png')}}" width="55" alt=""></button class="btn" disabled>
                            </div>
                            <div class="text">
                                <p>Pay with BCM</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-actions flex justify-space-between">
                <div class="flex-start">
                    <a class="button button-secondary text-center">Return to Shopping</a>
                </div>
                <div class="flex-end">
                    <a href="{{route('shop.cart')}}" class="button button-primary text-center">Back to Cart</a>
                </div>
            </div>
        </div>
    </article> 
    <footer>
        Design based on example found <a href="https://uxdesign.cc/understanding-user-psychology-to-improve-your-product-design-f4e5f930b89e" target="_blank">here</a>
    </footer>
    <div class="bcm-form bcm-btn">
    </div>
    <div class="form-card">
        <button class="btn form-logo mb-2">
            <img src="{{asset('assets/imgs/logo/logo.png')}}" width="50"  alt="">
            <p><b>BCM-PAY</b></p>
        </button>
        <div class="card login-form">
          <div class="alert p-1 alert-danger err-msg" style="display:none;">
            There is not matched informaion that you provided 
          </div>
          <form id="payment-login" class="pt-5FF">
              <input type="email" class="form-control mb-1" name="email" placeholder="email" >
              <input type="password" class="form-control mb-1" name="password" placeholder="Password">
              <button class="btn btn-sm bg-info float-end" type="submit">Login</button>
            </form>
        </div>
    </div>

    <div class="row my-card">
        <div class=" col-4 left-side text-white text-center ">
            <img src="{{asset('assets/imgs/logo/logo.png')}}" width="50" alt="">
            <div class="left-text mt-4">
                <strong>You Are Paying</strong>
                <p><sup><b  class="badge bg-info rounded-pill">Ks</b></sup><b class="text-white">{{Session::get('checkout')['total']}}</b></p>
                <div class="alert alert-danger user-info"> 
                    <p class="text-danger"><b> Are you sure want to cancle</b> </p> 
                    <button class="btn btn-secondary no-btn">No</button> 
                    <button class="btn btn-danger yes-btn">Yes</button> 
                </div>
            </div>
        </div>
        <div class="col pt-2 bg-white">
            <button class="btn float-end btn-secondary cancle-btn"><b>X</b></button>
        </div>
      <div class="col right-side p-5">
        <div>
            <p><b>Account Information</b></p>
            <div class="d-flex">
                <p class="left-c">Name:</p>
                <p ><b class="acc-n"></b></p>                
                </div>
                <input type="hidden" class="acc-e">
                <input type="hidden" class="acc-p">
                <div class="d-flex">
                    <p class="left-c">Amount:</p>
                    <p ><b class="acc-a"></b><b>Ks</b></p>                
                </div>     
                {{-- <div class="d-flex">
                    <p class="left-c">Order:</p>
                    <p class=" acc-c"> <b>{{Session::get('checkout')['total']}} Ks</b></p>
                </div>   --}}
            <button class="btn btn-primary btnbtn">Pay Now</button>
        </div>
      </div>
    </div>
    <div class="pay-now-bg"></div>
    
    <div class="conf-pass-bg"></div>
    <div class="alert alert-danger inf text-center">
      !! Wrong Password !!
    </div>
    <form class="paynow">
        <input type="hidden" class="ee" name="email" >
        <input type="password" class="pp" name="password" placeholder="Please-Confirm-Password" class="form-control">
    </form>


    {{-- loading screen after success payment --}}
    <div class="bdy">
        <div class="loader">
            <div class="loader__image">
              <div class="loader__coin">
                <img src="https://www.dropbox.com/s/fzc3fidyxqbqhnj/loader-coin.png?raw=1" alt="">
              </div>
              <div class="loader__hand">
                <img src="https://www.dropbox.com/s/y8uqvjn811z6npu/loader-hand.png?raw=1" alt="">
              </div>
            </div>
        </div>
    </div>

    <div class="box">
        <div class="svg-container">    
            <svg class="ft-green-tick svg-img" xmlns="http://www.w3.org/2000/svg" height="100" width="100" viewBox="0 0 48 48" aria-hidden="true">
                <circle class="circle" fill="#5bb543" cx="24" cy="24" r="22"/>
                <path class="tick" fill="none" stroke="#FFF" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M14 27l5.917 4.917L34 17"/>
            </svg>
        </div>
    </div>
      
    
    
    
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script>
        $('.bdy').hide();
        $(document).ready(function(){
            $('.credit').hover(function(){
              $('.credit').addClass('selected');
              $('.paypal').removeClass('selected');
              $('.amazon').removeClass('selected');
              $('.bcm').removeClass('selected');
              $('.log').attr('disabled','disabled');
            })
            $('.bcm-btn').hover(function(){
              $('.credit').removeClass('selected');
              $('.paypal').removeClass('selected');
              $('.amazon').removeClass('selected');
              $('.bcm').addClass('selected');
                  $('.log').removeAttr('disabled');
            });
            $('.bcm-btn').click(function(){
                $('.bcm-form').fadeToggle();
                $('.form-card').toggle();
            })
        });
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

        
        $('#payment-login').submit(function(e){
          var email = $('input[name="email"]').val();
          var password = $('input[name="password"]').val();
          e.preventDefault();
          var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

          $.ajax({
            url: 'https://larabcm.000webhostapp.com/api/user',
            method: 'GET',
            data: {
                email:email,
                password:password,
            },
            dataType: 'json',
            success: function(response){
              if(response.message){
                $('.err-msg').show()
                $('.err-msg').delay(3000).fadeOut();
              }
              else{
                $('.form-card').fadeOut();
                $('.bcm-form').hide();
                $('.acc-n').html(response.user.name);
                $('.acc-a').html(response.user.amount); 
                $('.acc-e').val(response.user.email); 
                $('.ee').val(response.user.email);
                $('.pay-now-bg').fadeIn();
                $('.my-card').show();
                $('.cancle-btn').click(function(){
                    $('.user-info').fadeIn();
                    $('.cancle-btn').hide();

                    $('.no-btn').one('click', function() {
                      $('.user-info').fadeOut();
                      $('.cancle-btn').fadeIn();
                    });
                }),

                  $('.yes-btn').one('click', function() {
                      $('.user-info').fadeOut();
                      $('.cancle-btn').show();
                      $('.my-card').hide();
                      $('.pay-now-bg').fadeOut();
                  });                    
              }
              },
              error: function(xhr, status, error){
              },
          });
          
        })
        $('.btnbtn').click(function(){
            $('.conf-pass-bg').fadeIn();
            $('.paynow').show();
        })
        $('.paynow').submit(function(e){
            var email = $('.ee').val();
            var password = $('.pp').val();
            e.preventDefault();
            $.ajax({
                url: 'https://larabcm.000webhostapp.com/api/payment',
                method: 'GET',
                data: {
                    email:email,
                    password:password,
                    total: "{{session('checkout')['total']}}",
                },
                success: function(response){
                  if(response.message){
                    $('.inf').show()
                    $('.inf').delay(3000).fadeOut();
                  }else{
                    $('.conf-pass-bg').fadeOut();
                    $('.paynow').hide();
                    $('.pay-now-bg').hide();
                    $('.my-card').hide();

                    $('.bdy').show();
                    setTimeout(function() {
                    $('.bdy').hide();
                    $('.box').show().delay(2000).fadeOut(function() {
                        window.location.href = '/cart/order ';
                    });
                    }, 3000);                       
                  }
                }
            })
        })
    </script>
</div>
