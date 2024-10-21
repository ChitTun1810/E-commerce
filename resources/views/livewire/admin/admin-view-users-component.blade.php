<div>
    <style>
                .later-table {
            border: 1px solid #ccc;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
            width: 100%;
            table-layout: fixed;
            display: none;
            }
            .early-table{
                display: none;
            }


            .later-table caption {
            font-size: 1.5em;
            margin: .5em 0 .75em;
            }

            .later-table tr {
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            padding: .35em;
            }

            .later-table th,
            .later-table td {
            padding: .625em;
            text-align: center;
            }

            .later-table th {
            font-size: .85em;
            letter-spacing: .1em;
            text-transform: uppercase;
            }

            @media screen and (max-width: 600px) {
                .g-map{
                width: 150px;
                height: 85px;
                }

            .later-table {
                border: 0;
            }

            .later-table caption {
                font-size: 1.3em;
            }
            
            .later-table thead {
                border: none;
                clip: rect(0 0 0 0);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
            }
            
            .later-table tr {
                border-bottom: 3px solid #ddd;
                display: block;
                margin-bottom: .625em;
            }
            
            .later-table td {
                border-bottom: 1px solid #ddd;
                display: block;
                font-size: .8em;
                text-align: right;
            }
            
            .later-table td::before {
                /*
                * aria-label has no advantage, it won't be read inside a table
                content: attr(aria-label);
                */
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }
            
            .later-table td:last-child {
                border-bottom: 0;
            }
            }
            /* general styling */
            body {
            font-family: "Open Sans", sans-serif;
            line-height: 1.25;
            }

    </style>

        <table class="early-table table table-striped text-center">
            <tr>
                <th>Avatar</th>
                <th>Location</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>User Role</th>
                <th>Action</th>
            </tr>
            @foreach($users as $user)
                <tr>
                    <td>
                        @if($user->avatar == null)
                            <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius ava-img" alt="User-Profile-Image">
                        @else
                            <img class="ava-img" src="{{asset('assets/imgs/avatar')}}/{{$user->name}}/{{$user->avatar}}" width="150">
                        @endif
                    </td>
                    <td>
                        <iframe class="g-map"
                        width="300" 
                        height="170" 
                        frameborder="0" 
                        scrolling="no" 
                        marginheight="0" 
                        marginwidth="0" 
                        src="https://maps.google.com/maps?q={{$user->lat}},{{$user->lang}}&hl=es&z=14&amp;output=embed"
                        >
                        </iframe>
                    </td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->ph_num}}</td>
                    <td>
                        @if($user->status == 'Active')
                            <span class="text-success">{{$user->status}}</span>
                        @endif
                        @if($user->status == 'Ban')
                            <span class="text-danger">{{$user->status}}</span>
                        @endif
                    </td>
                    <td>{{$user->utype}}</td>
                    <td class="text-center">  
                        <div class="input-group">
                            <div class="mx-auto">
                                <div class="dropdown">
                                    <button class="btn btn-sm dropdown-toggle" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                                        Change Role
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#" wire:click.prevent="changeadm({{$user->id}})">ADM</a></li>
                                        <li><a class="dropdown-item" href="#" wire:click.prevent="changeusr({{$user->id}})">USR</a></li>
                                    </ul>
                                </div>
                            </div>                                            
                            <div class="mx-auto">
                                <div class="dropdown">
                                    <button class="btn btn-sm dropdown-toggle" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                                        Change Role
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#" wire:click.prevent="changeact({{$user->id}})">Active</a></li>
                                        <li><a class="dropdown-item" href="#" wire:click.prevent="changeban({{$user->id}})">Tmp-Ban</a></li>
                                    </ul>
                                </div>
                            </div>                                            
                            
                        </div>    
                    </td>
                </tr>
            @endforeach
        </table>
        <table class="later-table">
            <thead >
              <tr>
                <th scope="col">Avatar</th>
                <th scope="col">Location</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Status</th>
                <th scope="col">User Role</th>
                <th scope="col">Action</th>
          </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td data-label="Avatar">
                            @if($user->avatar == null)
                                <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius ava-img" alt="User-Profile-Image">
                            @else
                                <img class="ava-img" src="{{asset('assets/imgs/avatar')}}/{{$user->name}}/{{$user->avatar}}" width="150">
                            @endif
                        </td>
                        <td data-label="Location">
                            <iframe class="g-map"
                            width="300" 
                            height="170" 
                            frameborder="0" 
                            scrolling="no" 
                            marginheight="0" 
                            marginwidth="0" 
                            src="https://maps.google.com/maps?q={{$user->lat}},{{$user->lang}}&hl=es&z=14&amp;output=embed"
                            >
                            </iframe>    
                        </td>
                        <td data-label="Name">{{$user->name}} </td>
                        <td data-label="Email">{{$user->email}} </td>
                        <td data-label="Phone">{{$user->ph_num}} $</td>
                        <td data-label="Status">
                            @if($user->status == 'Active')
                                <span class="text-success">{{$user->status}}</span>
                            @endif
                            @if($user->status == 'Ban')
                                <span class="text-danger">{{$user->status}}</span>
                            @endif
                        </td>
                        <td data-label="User Role">{{$user->utype}}</td>
                        <td data-label="Action">
                            <div class="input-group">
                                <div class="mx-auto">
                                    <div class="dropdown">
                                        <button class="btn btn-sm dropdown-toggle" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                                            Change Role
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#" wire:click.prevent="changeadm({{$user->id}})">ADM</a></li>
                                            <li><a class="dropdown-item" href="#" wire:click.prevent="changeusr({{$user->id}})">USR</a></li>
                                        </ul>
                                    </div>
                                </div>                                            
                                <div class="mx-auto">
                                    <div class="dropdown">
                                        <button class="btn btn-sm dropdown-toggle" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                                            Change Role
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#" wire:click.prevent="changeact({{$user->id}})">Active</a></li>
                                            <li><a class="dropdown-item" href="#" wire:click.prevent="changeban({{$user->id}})">Tmp-Ban</a></li>
                                        </ul>
                                    </div>
                                </div>                                                                         
                            </div>    
    
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @livewire('footer-component')
</div>
@push('scripts')
    <script>
        $(document).ready(function(){
            function handleScreenSize() {
                var width = $(window).width();

                if (width >= 580) {
                $('.early-table').show();
                $('.later-table').hide();
                } else {
                $('.early-table').hide();
                $('.later-table').show();
                }
            }
                // Initial setup
            handleScreenSize();

            // Bind the function to the window resize event
            $(window).resize(function() {
            handleScreenSize();
            });
        });
        
    </script>
@endpush
