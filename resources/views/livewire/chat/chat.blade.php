@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <!-- PAGE HEADER -->
    <div class="page-header d-sm-flex d-block">
        <ol class="breadcrumb mb-sm-0 mb-3">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Apps</a></li>
            <li class="breadcrumb-item active" aria-current="page">Chat</li>
        </ol>
        <div class="ms-auto">
            <div>
                <a href="javascript:void(0);" class="btn bg-secondary-transparent text-secondary btn-sm"
                    data-bs-toggle="tooltip" title="" data-bs-placement="bottom" data-bs-original-title="Rating">
                    <span><i class="fa fa-star"></i></span>
                </a>
                <a href="{{ url('lockscreen') }}" class="btn bg-primary-transparent text-primary mx-2 btn-sm"
                    data-bs-toggle="tooltip" title="" data-bs-placement="bottom" data-bs-original-title="lock">
                    <span><i class="fa fa-lock"></i></span>
                </a>
                <a href="javascript:void(0);" class="btn bg-warning-transparent text-warning btn-sm"
                    data-bs-toggle="tooltip" title="" data-bs-placement="bottom" data-bs-original-title="Add New">
                    <span><i class="fa fa-plus"></i></span>
                </a>
            </div>
        </div>
    </div>
    <!-- END PAGE HEADER -->

    <!-- ROW -->
    <div class="row">
        <div class="col-md-12 col-lg-5 col-xl-4">
            <div class="card overflow-hidden">
                <div class="main-chat-list">
                    <div class="card-header p-3 border-bottom-0">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search here...">
                            <button type="button" class="btn btn-primary">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <div class="chat">
                        <ul class="contacts mb-0">
                            @foreach ($users as $user)
                                    <li class="user-item active" data-userId="{{ $user->id }}" data-userName="{{ $user->name }}">
                                        <div class="d-flex bd-highlight">
                                            <div class="img_cont me-2">
                                                <img src="{{ asset('build/assets/images/users/male/32.jpg') }}"
                                                    class="rounded-circle avatar avatar-lg" alt="img">
                                                @if ($user->is_online == 1)
                                                    <span class="online_icon"></span>
                                                @endif
                                            </div>
                                            <div class="user_info">
                                                <h6 class="mt-2 mb-0 fw-semibold">{{ $user->name }}</h6>
                                                @if ($user->is_online == 1)
                                                    <small class="text-muted">{{ $user->name }} is online</small>
                                                @endif
                                            </div>
                                            <div class="ms-auto my-auto">
                                                <small>{{ Carbon::now() }}</small>
                                            </div>
                                        </div>
                                    </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-lg-7 col-xl-8 chat">
            <div class="card overflow-hidden">
                <!-- action-header -->
                <div class="action-header d-flex justify-content-between">
                    <div class="hidden-xs d-flex align-items-center ms-2">
                        <div class="img_cont me-3">
                            <img src="{{ asset('build/assets/images/users/female/23.jpg') }}"
                                class="rounded-circle avatar avatar-lg" alt="img">
                        </div>
                        <div class="mt-1">
                            <h4 class="text-white mb-0 fw-semibold"><span class="chart-person"><span></h4>
                            <span class="dot-label bg-success"></span><span class="me-3 text-white">Online</span>
                        </div>
                    </div>
                    <ul class="ah-actions actions">
                        <li class="call-icon">
                            <a href="javascript:void(0);" class="d-done d-md-flex">
                                <i class="fe fe-phone"></i>
                            </a>
                        </li>
                        <li class="video-icon">
                            <a href="javascript:void(0);" class="d-done d-md-flex">
                                <i class="fe fe-video"></i>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                <i class="fe fe-more-vertical"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><i class="fe fe-user text-primary"></i> View profile</li>
                                <li><i class="fe fe-users text-info"></i> Add friends</li>
                                <li><i class="fe fe-plus text-success"></i> Add to group</li>
                                <li><i class="fe fe-slash text-danger"></i> Block</li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- action-header end -->

                <!-- msg_card_body -->
                <div class="main-chat-msgs">
                    <div class="card-body" id="chat-messages">
                        <!-- Message list will be populated here -->
                        <p class="text-muted" id="no-message" style="display: none;">Data not found</p>
                    </div>
                </div>

                <!-- card-footer -->
                <div class="card-footer">
                    <div class="msb-reply d-flex">
                        <div class="input-group">
                            <input name="message" type="text" class="form-control bg-white" placeholder="Typing....">
                            <input name="sender_id" type="hidden" class="form-control bg-white" value="{{ Auth::user()->id }}">
                            <input name="reciever_id" id='reciever_id'  type="hidden" class="form-control bg-white">
                            <button type="button" class="btn btn-primary" id="messageForm">
                                <i class="fa fa-send" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div><!-- card-footer end -->
            </div>
        </div>
    </div>
    <!-- END ROW -->
@endsection

<!-- CHAT JS -->
@vite('resources/assets/js/chat.js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Initially hide the message area
        $('#chat-messages').hide();

        @if (Auth::check())
            var authId = {{ Auth::user()->id }};
        @else
            var authId = null; // User is not authenticated
        @endif

        // Event listener for clicking on a user
        $('.user-item').on('click', function() {
            // Clear previous messages
            $('#chat-messages').empty();
            $('#no-message').hide();
            $('#chat-messages').show();

            var userId = $(this).data('userid');
            var userName = $(this).data('username');
            $('#reciever_id').val(userId);
            $(".chart-person").empty();
            $(".chart-person").append(userName);

            if (!userId) {
                $('#no-message').show();
                return;
            }

            // Fetch chat messages
            $.ajax({
                url: `fetchChat/${userId}`,
                method: 'GET',
                success: function(response) {
                    if (response.length === 0) {
                        $('#no-message').show();
                    } else {
                        response.forEach(function(message) {
                            let messageHtml;
                            if (authId != message.sender_id) {
                                // If the message is from the authenticated user
                                messageHtml = `
                                    <div class="d-flex justify-content-start">
                                        <div class="img_cont_msg">
                                            <img src="{{asset("build/assets/images/users/male/28.jpg")}}"
                                                class="rounded-circle avatar avatar-md" alt="img">
                                        </div>
                                        <div class="msg_cotainer br-7"> 
                                            ${message.message}
                                            <span class="msg_time">8:40 AM, Today</span>
                                        </div>
                                    </div>`;
                            } else {
                                // If the message is from another user
                                messageHtml = `
                                    <div class="d-flex justify-content-end">
                                        <div class="msg_cotainer_send br-7"> 
                                            ${message.message}
                                            <span class="msg_time_send">8:40 AM, Today</span>
                                        </div>
                                        <div class="img_cont_msg">
                                            <img src="{{asset("build/assets/images/users/male/28.jpg")}}"
                                                class="rounded-circle avatar avatar-md" alt="img">
                                        </div>
                                    </div>`;
                            }
                            $('#chat-messages').append(messageHtml);
                        });
                    }
                },
                error: function() {
                    $('#no-message').show();
                }
            });
        });

        // Event listener for sending a message
        $('#messageForm').on('click', function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Capture the message
            var message = $('input[name="message"]').val();
            var sender_id = $('input[name="sender_id"]').val();
            var reciever_id = $('input[name="reciever_id"]').val();
            // Make sure the message is not empty
            if (message.trim() !== '') {
                $.ajax({
                    url: 'sendMessage',  // Replace with your route
                    type: 'POST',
                    data: {
                        message: message,
                        sender_id:sender_id,
                        reciever_id:reciever_id,
                        _token: '{{ csrf_token() }}' // Include CSRF token for Laravel
                    },
                    success: function(response) {
                        // Append the sent message to the chat window
                        let sentMessageHtml = `
                            <div class="d-flex justify-content-end">
                                <div class="msg_cotainer_send br-7"> 
                                    ${response.message}
                                    <span class="msg_time_send">Just now</span>
                                </div>
                                <div class="img_cont_msg">
                                    <img src="{{asset("build/assets/images/users/male/28.jpg")}}"
                                        class="rounded-circle avatar avatar-md" alt="img">
                                </div>
                            </div>`;
                        
                        $('#chat-messages').append(sentMessageHtml);

                        // Clear the input field
                        $('input[name="message"]').val('');
                    },
                    error: function(xhr, status, error) {
                        console.log('Error: ' + error);
                    }
                });
            } else {
                alert('Message cannot be empty!');
            }
        });
    });
</script>
