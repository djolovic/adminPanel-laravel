
    <script src="{{asset('js/socket.io.js')}}"></script>

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://use.typekit.net/hoy3lrg.js"></script>
    <script>try {
            Typekit.load({ async: true });
        } catch (e) {
        }</script>

@include('chat.style')


@extends('layout')

@section('content')

<body>
<div id="frame">
    <div id="sidepanel">
        <div id="profile">
            <div class="wrap">
                <img
                        id="profile-img"
                        src="http://emilcarlsson.se/assets/mikeross.png"
                        class="online"
                        alt=""
                />
                <p>Mike Ross</p>
                <div id="status-options">
                    <ul>
                        <li id="status-online" class="active"><span class="status-circle"></span><p>
                                Online</p></li>
                        <li id="status-away"><span class="status-circle"></span> <p>Away</p></li>
                        <li id="status-busy"><span class="status-circle"></span> <p>Busy</p></li>
                        <li id="status-offline"><span class="status-circle"></span> <p>Offline</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="search">
            <label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
            <input type="text" placeholder="Search contacts..." />
        </div>
        <div id="contacts">
            <ul>
                @foreach($conversations as $index=>$conversation)
                    <li
                            class="contact {{($index === 0 ? "active" : null)}}"
                            data-value="{{$conversation->conversation_id}}"
                    >
                        <div class="wrap">
                            <span class="contact-status busy"></span>
                            <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
                            <div class="meta">
                                <p class="name">Harvey Specter</p>
                                <p class="preview">@if($conversation->chatMessageLast->count() !== 0) {{$conversation->chatMessageLast[0]->message}} @else
                                        No messages @endif</p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div id="bottom-bar">
            <button id="addcontact"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> <span>Add contact</span>
            </button>
            <button id="settings"><i class="fa fa-cog fa-fw" aria-hidden="true"></i>
                <span>Settings</span></button>
        </div>
    </div>
    <div class="content">
        <div class="contact-profile">
            <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
            <p>Harvey Specter</p>
            <div class="social-media">
                <i class="fa fa-facebook" aria-hidden="true"></i>
                <i class="fa fa-twitter" aria-hidden="true"></i>
                <i class="fa fa-instagram" aria-hidden="true"></i>
            </div>
        </div>
        <div class="messages">
            <ul>
                @foreach($firstChatMessages as $chatMessage)
                    @if(is_null($chatMessage->user_support_id))
                        <li class="sent">
                            <img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />
                            <p>{{$chatMessage->message}}</p>
                        </li>
                    @else
                        <li class="replies">
                            <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
                            <p>{{$chatMessage->message}}</p>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="message-input">
            <div class="wrap">
                <input type="text" placeholder="Write your message..." />
                <i class="fa fa-paperclip attachment" aria-hidden="true"></i>
                <button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
            </div>
        </div>
    </div>
</div>
<!--<script src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script>-->
<script>
    function newConversation(data) {
        var classNameForActive = null;
        if ($('.contact').length === 0) {
            classNameForActive = "active";
        }
        $('<li class="contact '+classNameForActive+'" data-value="' + data.conversationId + '"> <div class="wrap"> <span class="contact-status busy"></span> ' +
            '<img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" /> ' +
            '<div class="meta"> <p class="name">Harvey Specter</p>' + data.message + '<p class="preview"></p> </div> </div></li>')
            .appendTo($('#contacts ul'));

        $('.messages ul').empty();

        newMessageSocket(data.message)
    }
    var allSupportConversations = '{!! $conversations->pluck('conversation_id')->toJson()!!}';
    var socket = io('http://localhost:3000', { query: 'support=true&conversations='+allSupportConversations });

    socket.on('client-message', function (data) {
        newMessageSocket(data.message)
    });

    socket.on('new-conversation', newConversation);

    $('.contact').on('click', function () {
        if ($(this).hasClass('active')) return;

        var mainThis = $(this);
        $.get("{{route('fetchMessagesForConversationId')}}", {conversationId:$(this).data('value')})
            .done(function (data) {
                $('.messages ul').empty();
                for (var i=0;i<data.messages.length;i++) {
                    if(data.messages[i].user_support_id === null) {
                   $('<li class="sent"> ' +
                       '<img src="http://emilcarlsson.se/assets/mikeross.png" alt="" /> ' +
                       '<p>'+data.messages[i].message+'</p> </li>')
                       .appendTo( $('.messages ul'))
                    } else {
                        $('<li class="replies"> ' +
                            '<img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" /> ' +
                            '<p>'+data.messages[i].message+'</p> ' +
                            '</li>')
                            .appendTo( $('.messages ul'))
                    }
                }
                $('.contact.active').removeClass('active');
                mainThis.toggleClass('active');
            });
    });

    $('.messages').animate({ scrollTop: $(document).height() }, 'fast');

    $('#profile-img').click(function () {
        $('#status-options').toggleClass('active');
    });

    $('#status-options ul li').click(function () {
        $('#profile-img').removeClass();
        $('#status-online').removeClass('active');
        $('#status-away').removeClass('active');
        $('#status-busy').removeClass('active');
        $('#status-offline').removeClass('active');
        $(this).addClass('active');

        if ($('#status-online').hasClass('active')) {
            $('#profile-img').addClass('online');
        } else if ($('#status-away').hasClass('active')) {
            $('#profile-img').addClass('away');
        } else if ($('#status-busy').hasClass('active')) {
            $('#profile-img').addClass('busy');
        } else if ($('#status-offline').hasClass('active')) {
            $('#profile-img').addClass('offline');
        } else {
            $('#profile-img').removeClass();
        }
        ;

        $('#status-options').removeClass('active');
    });

    var timeOut = null;

    $('.message-input input').keyup(function() {
        socket.emit('user-is-typing',
            {
                'conversationId': $('.contact.active').data('value'),
                'supportId': 1,
                'isTyping': true
            });

        if (timeOut === null) {
            timeOut = setTimeout(emitStopTyping, 2000);
        }
    });

    function emitStopTyping()
    {
        socket.emit('user-is-typing',
            {
                'conversationId': $('.contact.active').data('value'),
                'supportId': 1,
                'isTyping': false
            });

        clearTimeout(timeOut);

        timeOut = null;
    }


    function newMessage() {
        message = $('.message-input input').val();
        if ($.trim(message) == '') {
            return false;
        }
        $('<li class="replies"><img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" /><p>' + message + '</p></li>').appendTo(
            $('.messages ul'));
        $('.message-input input').val(null);
        $('.contact.active .preview').html('<span>You: </span>' + message);
        $('.messages').animate({ scrollTop: $(document).height() }, 'fast');
        socket.emit('support-message-backend',
            {
                'message': message,
                'conversationId': $('.contact.active').data('value'),
                'supportId': 1,
            })
    };


    function newMessageSocket(message) {
        $('<li class="sent"><img src="http://emilcarlsson.se/assets/mikeross.png" alt="" /><p>' + message + '</p></li>').appendTo(
            $('.messages ul'));
        $('.messages').animate({ scrollTop: $(document).height() }, 'fast');
    }

    $('.submit').click(function () {
        newMessage();
    });

    $(window).on('keydown', function (e) {
        if (e.which == 13) {
            newMessage();
            return false;
        }
    });

</script>
@endsection

