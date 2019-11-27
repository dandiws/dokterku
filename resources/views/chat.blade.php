<!-- resources/views/chat.blade.php -->

@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-4">            
            <ul class="chat-users">
                @isset($active_friend)
                    @if ($friends->search($active_friend)!==false)
                    @foreach ($friends as $friend)
                    <li class=" {{ isset($active_friend)?$active_friend->id==$friend->id?'active':'':'' }} ">
                    <a href={{route('chat.friend',['friend'=>$friend->id])}}>
                        @php
                            $detail = $friend->doctorDetails();
                        @endphp
                        {{ $detail?$detail->title_start:null }} {{$friend->name}} {{ $detail?$detail->title_end:null }}
                    </a>
                    </li>
                    @endforeach
                    @else
                        <li class="active">
                        <a href={{route('chat.friend',['friend'=>$active_friend->id])}}>
                            @php
                                $detail = $active_friend->doctorDetails();
                            @endphp
                            {{ $detail?$detail->title_start:null }} {{$active_friend->name}} {{ $detail?$detail->title_end:null }}
                        </a>
                        </li>

                        @foreach ($friends as $friend)
                        <li>
                        <a href={{route('chat.friend',['friend'=>$friend->id])}}>
                            @php
                                $detail = $friend->doctorDetails();
                            @endphp
                            {{ $detail?$detail->title_start:null }} {{$friend->name}} {{ $detail?$detail->title_end:null }}
                        </a>
                        </li>
                        @endforeach
                    @endif
                @else
                <p class="text-muted">
                        @forelse ($friends as $friend)
                        <li>
                        <a href={{route('chat.friend',['friend'=>$friend->id])}}>
                            @php
                                $detail = $friend->doctorDetails();
                            @endphp
                            {{ $detail?$detail->title_start:null }} {{$friend->name}} {{ $detail?$detail->title_end:null }}
                        </a>
                        </li>
                        @empty
                        Anda belum berkirim pesan dengan siapapun. <a href="{{ url('/') }}"> Temukan Dokter</a>
                        @endforelse
                </p>
                @endisset      
            </ul>
        </div>
        <div class="col-8">
            <div class="panel panel-default">
                <div class="panel-heading">Chats</div>
                <div class="panel-body" id="messages-container">
                    @isset($active_friend)
                    <chat-messages
                        :user=" {{ Auth::user() }}"
                        :messages="messages"
                        v-on:messages_fetched="addMessages"
                        :active_friend="{{ $active_friend }}"
                    ></chat-messages>                        
                    @endisset
                </div>
                <div class="panel-footer">
                    @isset($active_friend)
                    <chat-form
                        :active_friend=" {{ $active_friend }} "
                        v-on:messagesent="addMessage"
                        :user="{{ Auth::user() }}"
                    ></chat-form>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
@endsection