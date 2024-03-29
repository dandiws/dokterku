@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Forum Dokterku</div>

                <div class="card-body">
                  @foreach($threads as $thread)
                    <article>
                      <h4>
                        <a href="{{ $thread->path() }}">
                        {{ $thread->title }}
                        </a> 
                      </h4>
                    <div class="text-muted mb-3">{{ $thread->creator->name }} &bull; {{ $thread->created_at->diffForHumans() }} &bull; <a href="{{route("thread.channel",['channel'=>$thread->channel->slug])}}">{{$thread->channel->name}}</a></div>
                      <div class="body">{{ $thread->description }}</div>
                    </article> 

                  <hr> 
                  @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
