<div>
    <style>
        .navigation{
            padding: 0;
        }
        .noti{
            position: fixed;
            z-index: 10;
            right: 10%;
            top: 35px;
            width: 35vw;
            display: none;
            border-width: 4px;
            border-style: solid;
            border-image: linear-gradient(to bottom, #33ccff 0%, #ff99cc 100%) 1;
            height: 500px;     
            background: white;                                                                           
            overflow-x: hidden;
            overflow-y: auto;
        }
        .media{
            width: 80%
        }
        .old-noti,.old-noti-btn{
            cursor: pointer;
        }
        .for-old-noti{
            display: none;
        }
        @media(max-width:980px){
            .noti{
                width: 50vw;
            }
        }
        @media(max-width:420px){
            .media{
                position: relative;
                left: -40px;
            }
            .media small{
                font-size: 10px;
            }
            .markas-btn{
                font-size: 12px;
            }
            .noti-icon{
                position: fixed; 
                top: 26px;     
                left:57%;
            }
            .noti{
                left: 50%;
                transform: translateX(-50%);
                z-index: 10;
                width: 90vw;
                height: 400px;
            }
        }
        </style>
    <ul class="navigation ">
        <li>
            <a class="noti-icon" href="javascript:void(0);">
                <span class="nav__notification">
                    <span class="nav__notification__icon"></span>
                    @if($notifications->count() >= 1)
                        <span class="nav__notification__num">
                            {{$notifications->count()}}
                        </span>
                    @endif
                </span>    
            </a>
            <ul class="noti">
                <div class="pe-3">
                    <div class="card-header head-card sticky-top">
                        <span class="text-brand old-noti">Old Notification</span> 
                        <a class="text-danger me-3 float-end" wire:click.prevent="readnoti">CLEAR ALL</a>
                    </div>
                    <div class="card-body">
                        <ul class="pt-2 ">
                            {{-- Unread noti --}}
                            @foreach($notifications as $notification)
                                @if(auth()->user()->utype == 'ADM')
                                    @if($notification->data['type'] == 'register')
                                        <li class="notification-message noti{{$notification->id}}" >
                                            <div class="d-flex">
                                                <div class="media"> <span class="avatar avatar-sm">
                                                    <img class=" rounded-circle" alt="Image" src="">
                                                    </span>
                                                    <div>
                                                        <p style="font-size: 13px"><span><span class="test-muted"></span><span class="text-warning">{{$notification->data['name']}}</span> ({{$notification->data['email']}})</span> has just <span>registered.</span>
                                                            <br><span style="font-size: 13px"><span>{{$notification->created_at->diffForHumans()}}</span> 
                                                        </p>
                                                    </div>
                                                </div>
                                                <a class="markas-btn" data-id="{{$notification->id}}">Mark as Read</a>
                                            </div>
                                        </li>
                                    @elseif($notification->data['type'] == 'new_review')
                                        <li class="notification-message noti{{$notification->id}}" >
                                            <div class="d-flex">
                                                <div class="media"> <span class="avatar avatar-sm">
                                                    <img class=" rounded-circle" alt="Image" src="">
                                                    </span>
                                                    <div>
                                                        <p style="font-size: 13px"><span><span class="test-muted"></span><span class="text-warning">{{$notification->data['name']}}</span> ({{$notification->data['email']}})</span> has just give <span class="text-warning">Review.</span>
                                                            <br><span style="font-size: 13px"><span>{{$notification->created_at->diffForHumans()}}</span> 
                                                        </p>
                                                    </div>
                                                </div>
                                                <a class="markas-btn" data-id="{{$notification->id}}">Mark as Read</a>
                                            </div>
                                        </li>
                                    @endif
                                @endif

                                @if($notification->data['type'] == 'new_comment')
                                    <li class="notification-message noti{{$notification->id}}" >
                                        <div class="d-flex">
                                            <div class="media"> <span class="avatar avatar-sm">
                                                @if($notification->data['avatar'] == null)
                                                    <img class=" rounded-circle" alt="Image">
                                                @else
                                                    <img class=" rounded-circle" alt="Image" src="{{asset('assets/imgs/avatar')}}/{{$notification->data['name']}}/{{$notification->data['avatar']}}">
                                                @endif
                                                </span>
                                                <div>
                                                    <p style="font-size: 13px"><span><span class="test-muted"></span><span class="text-warning">{{$notification->data['name']}}</span> ({{$notification->data['email']}})</span> has just give<span class="text-warning">Comment.</span>
                                                        <br><span style="font-size: 13px"><span>{{$notification->created_at->diffForHumans()}}</span> 
                                                    </p>
                                                </div>
                                            </div>
                                            <a class="markas-btn" data-id="{{$notification->id}}">Mark as Read</a>
                                        </div>
                                    </li>
                                @elseif($notification->data['type'] == 'order')
                                    <li class="notification-message noti{{$notification->id}}" >
                                        <div class="d-flex">
                                            <div class="media">
                                                <p><b class="fs-5 "><small>{{$notification->data['title']}}</small></b></p>
                                                <small>Thank You for ordering our projucts</small><br>
                                                <small>Which amount of <b>{{$notification->data['total']}}</b>kyat</small>
                                                <small>You can check order details in</small>
                                                <small><a href="{{route('trackorder')}}">TrackOrder</a></small>    
                                            </div>
                                            <a class="markas-btn" data-id="{{$notification->id}}">Mark as Read</a>
                                        </div>
                                    </li>
                                @endif
                                <hr>
                            @endforeach
                            {{-- end unread noti --}}
                            {{-- old noti --}}
                            <ul class="for-old-noti">

                            </ul>
                        </ul>
                    </div>
                </div>
            </ul>
        </li>
    </ul>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
        // for noti box hover dropdown
        $(".navigation li").hover(function() {
            var isHovered = $(this).is(":hover");
            if (isHovered) {
                $(this).children("ul").stop().slideDown(300);
            } else {
                $(this).children("ul").stop().slideUp(300);
            }
        });

        // for single noti read
        $('.markas-btn').click(function(){
            var id = $('.markas-btn').attr('data-id');
            $.ajax({
                url: '{{URL::to('readnoti')}}/' +id,
                method: 'get',
                data: { $id: id },
                success: function (response) {
                    $('.noti'+id).remove();
            }})
        })
        // old noti
        $('.old-noti').click(function(){
            $.ajax({
                url: '{{URL::to('oldnoti')}}',
                method:'get',
                data: {},
                success: function(response){
                    var noti = '';
                    $.each(response.data, function(index,item){
                        if(item.data.type == 'register'){
                            noti += '@if(auth()->user()->utype == "ADM")'+
                                        '<li class="notification-message old-messg">'+
                                            '<div class="d-flex">'+
                                                '<div class="media"> <span class="avatar avatar-sm">'+
                                                    '<img class=" rounded-circle" alt="Image" src="">'+
                                                    '</span>'+
                                                    '<div class="new-register">'+                                                                                     
                                                    '<p style="font-size: 13px"><span><span class="test-muted"></span><span class="text-warning">'+item.data.name +'</span>('+ item.data.email+')</span> has just <span>registered.</span>'+
                                                    '<br><span style="font-size: 13px"><span>'+ moment(item.created_at).fromNow() +'</span></p>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div> <hr>'+
                                        '</li>'+
                                    '@endif';
                        }
                    $('.for-old-noti').html(noti);
                });
                $('.for-old-noti').fadeIn();
                $('.old-noti').hide();
                $('.head-card').append('<span class="ms-5 text-brand old-noti-btn">Hide Noti</span>')
                $('.old-noti-btn').click(function(){
                    $('.for-old-noti').fadeOut();
                    $('.old-noti-btn').hide();
                    $('.old-noti').show();
                })
                }
            });
        })
    </script>

</div>
@push('scripts')
    <script>
        $(document).ready(function(){
            $(".nav").hover(function showHide(){
                $(".noti").slideToggle("slow");
            })
        }); 
    </script>
@endpush