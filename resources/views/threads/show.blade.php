@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              <div class="card-header">
              <a href="#">{{ $thread->creator->name }} </a> posted:
                {{ $thread->title }}
              
              </div>

                  <div class="card-body">
                {{ $thread->description }}
                  </div>

               </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
          @foreach($thread->replies as $reply)
             @include('threads.reply')
          @endforeach
        </div>
    </div>


    @if(auth()->check())
      <div class="row justify-content-center mt-5">
        <div class="col-md-8 col-md-offset-2">
            <form class="form-horizontal" method="POST" action="{{ $thread->path() . '/replies' }}">
              {{ csrf_field() }}
                <div class="form-group">
                    <textarea class="form-control" name="description" id="description" class="form-controller" 
                    placeholder="have something to say?" rows="5">
                    </textarea>
              </div>
              <button style="min-width: 100px" type="submit" class="btn btn-primary float-right">Post</button>  
            </form>            
        </div>
      </div>
      @else
    <p class="text-center">Please <a href="{{ route('login')}}">sign in</a> to participate </p>
      @endif
</div>
@endsection
