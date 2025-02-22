<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
</head>
<body>
    <div>
        <style>
            i#setting{
                font-size: 25px
            }
            .modal{
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                display: none;
            }
            .modal:target{
                display: block;
            }
            .rating {
            display: inline-block;
            position: relative;
            height: 50px;
            line-height: 50px;
            font-size: 50px;
            }
    
            .rating label {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            cursor: pointer;
            }
    
            .rating label:last-child {
            position: static;
            }
    
            .rating label:nth-child(1) {
            z-index: 5;
            }
    
            .rating label:nth-child(2) {
            z-index: 4;
            }
    
            .rating label:nth-child(3) {
            z-index: 3;
            }
    
            .rating label:nth-child(4) {
            z-index: 2;
            }
    
            .rating label:nth-child(5) {
            z-index: 1;
            }
    
            .rating label input {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            }
    
            .rating label .icon {
            float: left;
            color: transparent;
            }
    
            .rating label:last-child .icon {
            color: rgb(170, 165, 165);
            }
    
            .rating:not(:hover) label input:checked ~ .icon,
            .rating:hover label:hover input ~ .icon {
            color: #FF9529;
            }
    
            .rating label input:focus:not(:checked) ~ .icon:last-child {
            color: #000;
            text-shadow: 0 0 5px #FF9529;
            }
            .slidingDiv {
            position: absolute;
            display: none;
            top: 50px;
            height: 780px;
            }    
            .bg{
                height: 600px;
            }
            @meida(max-width:992px){
                .slidingDiv{
                    width:100vw;
                }
            }
            @media(max-width:420px){
                .desc{
                    font-size: 10px;
                }
                .main-m-c,.main-m-n{
                    font-size: 12px;
                }
                .slidingDiv {
                    height: 850px;
                }
            }
        </style>
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{route('home.index')}}" rel="nofollow">Home</a>                    
                    <span></span> FAQ
                </div>
            </div>
        </div>    

        <div class="comments-area p-5">
            <div class="row" style="position: absolute">
                <div class="col-lg-8" >
                    <h4>Customer questions & answers</h4>
                    {{$reviews->links()}} <br>
                    <div class="comment-list">
                        @foreach($reviews as $review)
                            {{-- for replies --}}
                            <div class="row">
                                <div class="col-8 slidingDiv bg-dark ps-5 pe-5 pb-5 pt-2 text-white" id="replycomment-{{ $review->id }}">
                                    <div class="navbar navbar-expand-lg bg-dark text-white mb-3">
                                        <a class="brand btn-reply show_hide text-white" data-id="{{ $review->id }}" onclick="showHide('replycomment-{{ $review->id }}');"> 
                                            <i class='fas fa-arrow-circle-left' style='font-size:30px;color:white'></i></a>
                                        <h1 class="navbar-brand h5 ms-5 text-white">Replies</h1>
                                        <div class="flex-fill"></div>
                                        <ul class="navbar-nav">
                                            <li class="nav-item">
                                            </li>
                                        </ul>
                                    </div>  
                                    {{-- for main comment in replies page --}}
                                        <div class="row mb-5">
                                            {{-- for message owner image --}}
                                            <div class="thumb col-1">
                                                @if($review->user->avatar == null)
                                                    <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius" alt="User-Profile-Image">
                                                @else
                                                    <img src="{{asset('assets/imgs/avatar')}}/{{$review->user->name}}/{{$review->user->avatar}}" alt="">
                                                @endif                                             
                                            </div>
                                            {{-- end --}}

                                            <div class="desc col">
                                                <div>
                                                    @auth
                                                        @if(auth()->user()->id == $review->user_id)
                                                        {{-- for edit/delete review --}}
                                                            <div class="float-end ">
                                                                <a href="" data-bs-toggle="dropdown" class="text-white"><i id="setting" class="fa fa-ellipsis-v p-4" aria-hidden="true"></i></a>
                                                                <ul class="dropdown-menu bg-secondary ">
                                                                    <li><a class="dropdown-item text-white" href="#reviewmodal-{{$review->id}}">Edit</a></li>
                                                                    <li><a class="dropdown-item text-white" href="{{url("/deletereview/$review->id")}}" >Delete</a></li>
                                                                </ul>
                                                            </div> 
                                                        @endif
                                                    @endauth
                                                    {{-- Edit owner message form  --}}
                                                    <div class="modal" id="reviewmodal-{{$review->id}}">
                                                        <div class="box p-5">
                                                            <div class="row">
                                                                <div class="col-2"></div>
                                                                <div class="col">
                                                                    <form wire:submit.prevent="editreply({{$review->id}})">
                                                                        <div class="input-group">
                                                                            <a href="#" class="btn btn-sm text-white" style="font-size: 15px; font-weight:bolder">X</a>
                                                                            <input type="text" class="form-control bg-white" wire:model="edittext" value="{{$review->review}}" />
                                                                            <button type="submit" class="btn btn-info btn-sm">Update</button><br>
                                                                        </div>
                                                                        
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <h4 class="text-white">Share Your Experiences</h4>
                                                                                <div class="rating">
                                                                                    <label>
                                                                                    <input type="radio" name="stars" value="1" wire:model="stars" />
                                                                                    <span class="icon"><i class="fa-solid fa-star" ></i></span>
                                                                                    </label>
                                                                                    <label>
                                                                                    <input type="radio" name="stars" value="2" wire:model="stars"/>
                                                                                    <span class="icon"><i class="fa-solid fa-star" ></i></span>
                                                                                    <span class="icon"><i class="fa-solid fa-star" ></i></span>
                                                                                    </label>
                                                                                    <label>
                                                                                    <input type="radio" name="stars" value="3" wire:model="stars"/>
                                                                                    <span class="icon"><i class="fa-solid fa-star" ></i></span>
                                                                                    <span class="icon"><i class="fa-solid fa-star" ></i></span>
                                                                                    <span class="icon"><i class="fa-solid fa-star" ></i></span>   
                                                                                    </label>
                                                                                    <label>
                                                                                    <input type="radio" name="stars" value="4" wire:model="stars"/>
                                                                                    <span class="icon"><i class="fa-solid fa-star" ></i></span>
                                                                                    <span class="icon"><i class="fa-solid fa-star" ></i></span>
                                                                                    <span class="icon"><i class="fa-solid fa-star" ></i></span>
                                                                                    <span class="icon"><i class="fa-solid fa-star" ></i></span>
                                                                                    </label>
                                                                                    <label>
                                                                                    <input type="radio" name="stars" value="5" wire:model="stars"/>
                                                                                    <span class="icon"><i class="fa-solid fa-star" ></i></span>
                                                                                    <span class="icon"><i class="fa-solid fa-star" ></i></span>
                                                                                    <span class="icon"><i class="fa-solid fa-star" ></i></span>
                                                                                    <span class="icon"><i class="fa-solid fa-star" ></i></span>
                                                                                    <span class="icon"><i class="fa-solid fa-star" ></i></span>
                                                                                    </label>
                                                                                </div>                                                             
                                                                            </div>
                                                                        </div>
                                                                    </form>        
                                                                </div>
                                                                <div class="col-2"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- end  --}}
                                                    
                                                    {{-- main message owner name and content --}}
                                                    <p class="text-white main-m-n">{{$review->user->name}} . <span class="font-xs mr-30 text-muted">{{$review->created_at->diffForHumans()}} </span></p>
                                                    <p class="text-white main-m-c mb-5">{{$review->review}}</p>
                                                    {{-- end --}}
                                                </div>
        
                                                <div class="row">
                                                    @auth
                                                    <div class="col-1 my-auto">
                                                        @if(auth()->user()->avatar == null)
                                                        <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius" alt="User-Profile-Image">
                                                    @else
                                                        <img class="rounded-circle" src="{{asset('assets/imgs/avatar')}}/{{auth()->user()->name}}/{{auth()->user()->avatar}}" alt="">
                                                    @endif    
                                                    </div>
                                                    @endauth
                                                    <div class="col-6">
                                                        {{-- for reply --}}
                                                        @auth
                                                        {{-- for add comment --}}
                                                            <form action="{{url("/faq/reply")}}" method="post">
                                                                @csrf
                                                                <div class="input-group">                                                                
                                                                    <input type="hidden" name="user_id" value="{{$review->user_id}}">
                                                                    <input type="hidden" name="review_id" value="{{$review->id}}">
                                                                    {{-- wire:model="content.{{$review->id}}" --}}
                                                                    <input type="text" class="form-control" name="content"  required>
                                                                </div>
                                                            </form>
                                                        {{-- end add comment --}}
                                                        @endauth
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="replies">
                                                    @foreach($replys as $reply)
                                                    @if($review->id == $reply->review_id )
                                                        <div class="d-flex mb-3">
                                                            <div class="thumb text-center col">
                                                                @if($reply->user->avatar == null)
                                                                    <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius" alt="User-Profile-Image">
                                                                @else
                                                                    <img src="{{asset('assets/imgs/avatar')}}/{{$reply->user->name}}/{{$reply->user->avatar}}" alt="">
                                                                @endif
                                                            </div>
                                                            <div class="col-11">
                        
                                                                {{-- for edit/delete --}}
                                                                @auth
                                                                @if(auth()->user()->id == $reply->user_id || auth()->user()->id == $review->user_id )
                                                                    <div class="float-end">
                                                                        <a href="" data-bs-toggle="dropdown"><i id="setting" class="fa fa-ellipsis-v p-4 text-white" aria-hidden="true"></i></a>
                                                                        <ul class="dropdown-menu bg-secondary ">
                                                                            @if(auth()->user()->id == $reply->user_id)
                                                                                <li><a class="dropdown-item text-white" href="#modal-{{$reply->id}}">Edit</a></li>
                                                                            @endif
                                                                            <li><a class="dropdown-item text-white" href="{{url("/deletereply/$reply->id")}}" >Delete</a></li>
                                                                        </ul>
                                                                    </div>  
                                                                {{-- end edit/delete --}}
                                                                    
                                                                    {{-- hidden box for edit --}}
                                                                    <div class="modal" id="modal-{{$reply->id}}">
                                                                        <div class="box p-5">
                                                                            <div class="row">
                                                                                <div class="col-2"></div>
                                                                                <div class="col">
                                                                                    <form action="{{url("/editreply/$reply->id")}}">
                                                                                        <div class="input-group">
                                                                                            <a href="#" class="btn btn-sm text-white" style="font-size: 15px; font-weight:bolder">X</a>
                                                                                            <textarea class="form-control bg-white" name="edittext" placeholder="{{$reply->content}}"></textarea>
                                                                                            <button type="submit" class="btn btn-info btn-sm">Update</button>
                                                                                        </div>
                                                                                    </form>        
                                                                                </div>
                                                                                <div class="col-2"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    {{-- end hidden box --}}
                                                                
                                                                @endif
                                                                @endauth
                                                                {{-- for content comment --}}
                                                                <p class="text-white">{{$reply->user->name}} .<span class="font-xs mr-3 text-muted">{{$reply->created_at->diffForHumans()}} </span>
                                                            </p>
                                                                <p class="text-white">{{$reply->content}}</p>
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="d-flex align-items-center">
                                                                        {{-- <a class="text-brand btn-reply showhidereply" data-id="{{ $review->id }}" onclick="showHide('replycomment-{{ $review->id }}');">Reply <i class="fi-rs-arrow-right"></i> </a> --}}
                                                                    </div>
                                                                </div>
                                                                {{-- end content --}}
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @endforeach
                                                    {{-- add some space in single comment  --}}
                                                    @if($review->replies->count() < 3)
                                                        <div class="bg"></div>
                                                    @endif    
                                                </div>                
                                            </div>
                                        </div>    
                                </div>
                                <div class="col-3 for-support"></div>
                            </div>
                            {{-- comment --}}
                            <div class="single-comment justify-content-between d-flex">
                                    <div class="user justify-content-between d-flex">
                                        <div class="thumb text-center">
                                            @if($review->user->avatar == null)
                                                <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius" alt="User-Profile-Image">
                                            @else
                                                <img src="{{asset('assets/imgs/avatar')}}/{{$review->user->name}}/{{$review->user->avatar}}" alt="">
                                            @endif
                                            
                                                <h6><a href="#">{{$review->user->name}}</a></h6>
                                        </div>
                                        <div class="desc">
                                            @auth
                                            @if(auth()->user()->id == $review->user_id)
                                            {{-- for edit/delete review --}}
                                                <div class="float-end">
                                                    <a href="" data-bs-toggle="dropdown"><i id="setting" class="fa fa-ellipsis-v p-4" aria-hidden="true"></i></a>
                                                    <ul class="dropdown-menu bg-secondary ">
                                                        <li><a class="dropdown-item text-white" href="#reviewmodal-{{$review->id}}">Edit</a></li>
                                                        <li><a class="dropdown-item text-white" href="{{url("/deletereview/$review->id")}}" >Delete</a></li>
                                                    </ul>
                                                </div> 
                                                 {{-- end  --}}
                                            @endif
                                            @endauth
                                            <div class="modal" id="reviewmodal-{{$review->id}}">
                                                <div class="box p-5">
                                                    <div class="row">
                                                        <div class="col-2"></div>
                                                        <div class="col">
                                                            <form wire:submit.prevent="editreply({{$review->id}})">
                                                                <div class="input-group">
                                                                    <a href="#" class="btn btn-sm text-white" style="font-size: 15px; font-weight:bolder">X</a>
                                                                    <input type="text" class="form-control bg-white" wire:model="edittext" placeholder="{{$review->review}}" />
                                                                    <button type="submit" class="btn btn-info btn-sm">Update</button><br>
                                                                </div>
                                                                
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h4 class="text-white">Share Your Experiences</h4>
                                                                        <div class="rating">
                                                                            <label>
                                                                            <input type="radio" name="stars" value="1" wire:model="stars" />
                                                                            <span class="icon"><i class="fa-solid fa-star" ></i></span>
                                                                            </label>
                                                                            <label>
                                                                            <input type="radio" name="stars" value="2" wire:model="stars"/>
                                                                            <span class="icon"><i class="fa-solid fa-star" ></i></span>
                                                                            <span class="icon"><i class="fa-solid fa-star" ></i></span>
                                                                            </label>
                                                                            <label>
                                                                            <input type="radio" name="stars" value="3" wire:model="stars"/>
                                                                            <span class="icon"><i class="fa-solid fa-star" ></i></span>
                                                                            <span class="icon"><i class="fa-solid fa-star" ></i></span>
                                                                            <span class="icon"><i class="fa-solid fa-star" ></i></span>   
                                                                            </label>
                                                                            <label>
                                                                            <input type="radio" name="stars" value="4" wire:model="stars"/>
                                                                            <span class="icon"><i class="fa-solid fa-star" ></i></span>
                                                                            <span class="icon"><i class="fa-solid fa-star" ></i></span>
                                                                            <span class="icon"><i class="fa-solid fa-star" ></i></span>
                                                                            <span class="icon"><i class="fa-solid fa-star" ></i></span>
                                                                            </label>
                                                                            <label>
                                                                            <input type="radio" name="stars" value="5" wire:model="stars"/>
                                                                            <span class="icon"><i class="fa-solid fa-star" ></i></span>
                                                                            <span class="icon"><i class="fa-solid fa-star" ></i></span>
                                                                            <span class="icon"><i class="fa-solid fa-star" ></i></span>
                                                                            <span class="icon"><i class="fa-solid fa-star" ></i></span>
                                                                            <span class="icon"><i class="fa-solid fa-star" ></i></span>
                                                                            </label>
                                                                        </div>
                                                        
                                                                    </div>
                                                                </div>
                                                            </form>        
                                                        </div>
                                                        <div class="col-2"></div>
                                                    </div>
                                                </div>
                                            </div>
    
                                            {{-- <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width:90%">
                                                </div>
                                            </div> --}}
                                            @if($review->rating == '1')
                                                <img src="{{asset('assets/imgs/review/1star.jpg')}}" width="100">
                                            @elseif($review->rating == '2')
                                                <img src="{{asset('assets/imgs/review/2stars.jpg')}}" width="100">
                                            @elseif($review->rating == '3')
                                                <img src="{{asset('assets/imgs/review/3stars.jpg')}}" width="100">
                                            @elseif($review->rating == '4')
                                                <img src="{{asset('assets/imgs/review/4stars.jpg')}}" width="100">
                                            @else
                                                <img src="{{asset('assets/imgs/review/5stars.jpg')}}" width="100">
                                            @endif
                                            
                                            <p>{{$review->review}}</p>
                                            <div class="d-flex justify-content-between">
                                                <div class="align-items-center">
                                                    <p class="font-xs mr-30">{{$review->created_at->diffForHumans()}} </p><br>
                                                    <ul class="d-flex">
                                                        <li class="pe-5">                                                        
                                                            <a class="text-brand btn-reply show_hide" data-id="{{ $review->id }}" onclick="showHide('replycomment-{{ $review->id }}');"> 
                                                                <i class='far fa-comment-alt' style='font-size:20px;color: royalblue'></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    @if($review->replies->count() > 0)
                                                        <a class="text-brand btn-reply show_hide" data-id="{{ $review->id }}" onclick="showHide('replycomment-{{ $review->id }}');"> 
                                                            <span>
                                                                {{$review->replies->count()}}
                                                            </span>                                                     
                                                            replies 
                                                            <i class="fi-rs-arrow-right"></i> 
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                            {{-- for reply --}}
                                            @auth
                                            {{-- for add comment --}}
                                                {{-- <form id="replycomment-{{ $review->id }}" wire:submit.prevent="reply({{$review->id}})">
                                                    <div class="input-group" style="width: 600px">
                                                        <input type="text" class="form-control" wire:model="content.{{$review->id}}" required>
                                                        <button type="submit" class="btn btn-secondary">Send</button>
                                                    </div>
                                                </form> --}}
                                            {{-- end add comment --}}
                                            @endauth
    
                                        </div>
                                    </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                    
                <div class="col-lg-4">
                    <h4 class="mb-30">Customer reviews</h4>
                    <div class="d-flex mb-30">
                        <div class="product-rate d-inline-block mr-15">
                            <div class="product-rating" style="width:90%">
                            </div>
                        </div>
                        <h6>4.8 out of 5</h6>
                    </div>
                    <div class="progress">
                        <span>5 star</span>
                        <div class="progress-bar" role="progressbar" style="width: {{$s5rate}}%;" aria-valuenow="{{$s5rate}}" aria-valuemin="0" aria-valuemax="100">{{$s5rate}}%</div>
                    </div>
                    <div class="progress">
                        <span>4 star</span>
                        <div class="progress-bar" role="progressbar" style="width: {{$s4rate}}%;" aria-valuenow="{{$s4rate}}" aria-valuemin="0" aria-valuemax="100">{{$s4rate}}%</div>
                    </div>
                    <div class="progress">
                        <span>3 star</span>
                        <div class="progress-bar" role="progressbar" style="width: {{$s3rate}}%;" aria-valuenow="{{$s3rate}}" aria-valuemin="0" aria-valuemax="100">{{$s3rate}}%</div>
                    </div>
                    <div class="progress">
                        <span>2 star</span>
                        <div class="progress-bar" role="progressbar" style="width:{{$s2rate}}%;" aria-valuenow="{{$s2rate}}" aria-valuemin="0" aria-valuemax="100">{{$s2rate}}%</div>
                    </div>
                    <div class="progress mb-30">
                        <span>1 star</span>
                        <div class="progress-bar" role="progressbar" style="width: {{$s1rate}}%;" aria-valuenow="{{$s1rate}}" aria-valuemin="0" aria-valuemax="100">{{$s1rate}}%</div>
                    </div>
                    <a href="#" class="font-xs text-muted">How are ratings calculated?</a><br>
                    <a href="{{route('user.review')}}" class="btn btn-info">Review</a>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('assets/js/vendor/jquery-3.6.0.min.js')}}"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js'></script>
    <script src="{{asset('assets/js/vendor/bootstrap.bundle.min.js')}}"></script>

    {{-- for show/hide reply --}}
    <script>
            $(document).ready(function () {
                $('div[id^="replycomment-"]').hide();
                $(".show_hide").show();
            });    
            function showHide(id){
                $("#"+id).toggle("slide", {direction:'right'});
            }  
            
            function modifyElementsOnSmallScreen() {
                if ($(window).width() <= 992) {
                    $('.for-support').hide();
                    $('.slidingDiv').removeClass('col-8')
                }else{
                    $('.for-support').show();
                    $('.slidingDiv').addClass('col-8')
                }
            }
            // Call the function initially
            modifyElementsOnSmallScreen();

            // Call the function on window resize
            $(window).resize(modifyElementsOnSmallScreen);
    </script>
</body>
</html>