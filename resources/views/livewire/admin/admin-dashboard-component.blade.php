<div>
    <style>
        body {
            background-color: #f9f9fa
        }
        .padding {
            padding: 3rem !important
        }

        .user-card-full {
            overflow: hidden;
        }

        .card {
            border-radius: 5px;
            -webkit-box-shadow: 0 1px 20px 0 rgba(69,90,100,0.08);
            box-shadow: 0 1px 20px 0 rgba(69,90,100,0.08);
            border: none;
            margin-bottom: 30px;
        }

        .m-r-0 {
            margin-right: 0px;
        }

        .m-l-0 {
            margin-left: 0px;
        }

        .user-card-full .user-profile {
            border-radius: 5px 0 0 5px;
        }

        .bg-c-lite-green {
                background: -webkit-gradient(linear, left top, right top, from(#f29263), to(#ee5a6f));
            background: linear-gradient(to right, #ee5a6f, #f29263);
        }

        .user-profile {
            padding: 20px 0;
        }

        .card-block {
            padding: 1.25rem;
        }

        .m-b-25 {
            margin-bottom: 25px;
        }

        .img-radius {
            border-radius: 5px;
        }
        h6 {
            font-size: 14px;
        }

        .card .card-block p {
            line-height: 25px;
        }

        @media only screen and (min-width: 1400px){
            p {
                font-size: 14px;
        }
        }

        .card-block {
            padding: 1.25rem;
        }

        .b-b-default {
            border-bottom: 1px solid #e0e0e0;
        }

        .m-b-20 {
            margin-bottom: 20px;
        }

        .p-b-5 {
            padding-bottom: 5px !important;
        }

        .card .card-block p {
            line-height: 25px;
        }

        .m-b-10 {
            margin-bottom: 10px;
        }

        .text-muted {
            color: #919aa3 !important;
        }

        .b-b-default {
            border-bottom: 1px solid #e0e0e0;
        }

        .f-w-600 {
            font-weight: 600;
        }

        .m-b-20 {
            margin-bottom: 20px;
        }

        .m-t-40 {
            margin-top: 20px;
        }

        .p-b-5 {
            padding-bottom: 5px !important;
        }

        .m-b-10 {
            margin-bottom: 10px;
        }

        .m-t-40 {
            margin-top: 20px;
        }

        .user-card-full .social-link li {
            display: inline-block;
        }

        .user-card-full .social-link li a {
            font-size: 20px;
            margin: 0 10px 0 0;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }
        .av-bg{
            position: fixed;
            top: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.712);
            display: none;
        }
        .avatar{
            position: fixed ;
            left: 50%;
            top: 30%;
            transform: translate(-50%);
            width: 525px;
            height: auto;
            z-index: 1;
            display: none;
        }
        .col-4{
            padding-bottom: 95px
        }
        @media(max-width:420px){
            .avatar h3{
                font-size: 15px;
            }
            .avatar,.card-header,.card-body{
                width: 80vw;
            }
        }
    </style>
    <div class="page-content page-container" id="page-content">
        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-xl-6 col-md-12">
                    @if(session('info'))
                        <div class="alert-info p-3 mb-1 text-warning">
                            {{session('info')}}
                        </div>
                    @endif
                    <div class="card user-card-full">
                        <div class="row m-l-0 m-r-0">
                            <div class="col-sm-4 bg-c-lite-green user-profile">
                                <div class="card-block text-center text-white">
                                    <div class="m-b-25">
                                        @if(auth()->user()->avatar == null)
                                            <button class="avtupload btn"><img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius" alt="User-Profile-Image"></button>
                                        @else
                                            <a href="#" class="avtupload"><img src="{{asset('assets/imgs/avatar')}}/{{auth()->user()->name}}/{{auth()->user()->avatar}}" class="img-thumbnail" alt="User-Profile-Image"></a>
                                        @endif
                                    </div>
                                    <h6 class="f-w-600">{{auth()->user()->name}}</h6>
                                    <p>Web Designer</p>
                                    <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="card-block">
                                    
                                    <div>
                                        <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information <span class="float-end"><a href="{{route('logout')}}" class="btn btn-warning float-right btn-sm">Logout</a></span></h6>   
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Email</p>
                                            <h6 class="text-muted f-w-400">{{auth()->user()->email}}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Phone</p>

                                            @if(auth()->user()->ph_num == null)
                                                <form wire:submit.prevent="phnum">
                                                    @csrf
                                                    <div class="input-group">
                                                        <input type="text" name="ph_num" class="form-control" wire:model="ph_num" placeholder="09 XXX XXX XXX" required>
                                                    </div>
                                                </form>
                                            @else
                                                <h6 class="text-muted f-w-400">{{auth()->user()->ph_num}}</h6>
                                            @endif
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">User Role</p>
                                            <small class="text-muted f-w-400">{{auth()->user()->utype}}</small>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Location</p>
                                            @if(auth()->user()->lat == null)
                                                <button class="btn btn-warning btn-sm" id="searchloc">Search Location</button>
                                                <form style="display: none" id="submitloc" wire:submit.prevent="addlocation">
                                                    <button class="btn btn-warning btn-sm mb-1" type="submit">Submit</button>
                                                    <input type="text" id="lati" class="form-control" wire:model.defer="lat" disabled>
                                                    <input type="text" id="langi" class="form-control" wire:model.defer="lang" disabled>
                                                </form>
                                            @else
                                                <small class="text-muted f-w-400">{{auth()->user()->lat}},</small>
                                                <small class="text-muted f-w-400">{{auth()->user()->lang}}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <ul class="social-link list-unstyled m-t-40 m-b-10">
                                        <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="facebook" data-abc="true"><i class="mdi mdi-facebook feather icon-facebook facebook" aria-hidden="true"></i></a></li>
                                        <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="twitter" data-abc="true"><i class="mdi mdi-twitter feather icon-twitter twitter" aria-hidden="true"></i></a></li>
                                        <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="instagram" data-abc="true"><i class="mdi mdi-instagram feather icon-instagram instagram" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="av-bg"></div>
    <div class="avatar">
        <h3 class="card-header text-white bg-secondary"> Add Avatar</h3>
        <div class="card-body bg-info">
            <form class="form-horizontal" action="{{route('avatarUpload')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="input-group bg-white">
                    <input type="file" class="form-control" name="image">
                    <button type="submit" class="btn">Upload</button>
                </div>                       
            </form>
    </div>
    </div>

    {{-- for user Location --}}
    <script src="{{asset('assets/js/vendor/jquery-3.6.0.min.js')}}"></script>
    <script>
        $('.avtupload').click(function(){
            $('.av-bg').fadeIn();
            $('.avatar').show();
        })

        var lat = document.getElementById("lati");
        var lang = document.getElementById("langi");
    
        $('#searchloc').click(function(e){
            e.preventDefault();
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else { 
            x.innerHTML = "Geolocation is not supported by this browser.";
            }
            $('#searchloc').hide();
            $('#submitloc').show();
        })

    
        function showPosition(position) {
            lat.value = position.coords.latitude;
            lat.dispatchEvent(new Event('input'));
            lang.value =  position.coords.longitude;
            lang.dispatchEvent(new Event('input'));
        }
  </script>
  
</div>
