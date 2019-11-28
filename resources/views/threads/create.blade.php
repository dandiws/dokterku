@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a New Thread</div>

                <div class="card-body">
                  <form method="Post" action="/threads">
                    {{ csrf_field() }}


                    <div class="form-group">
                        <label for="channel_id">Choose a Channel: </label>
                        <select name="channel_id" id="channel_id" class="form-control">
                          @foreach(App\Channel::all() as $channel)
                          <option value="{{ $channel->id}}"> {{ $channel->name}}</option>
                          @endforeach
                        </select>
                      </div>

                    <div class="form-group">
                      <label for="title">Title: </label>
                    <input type="text" class="form-control" id="title" name="title" 
                    value="{{ old('title')}}">
                    </div>
                    
                      <div class="form-group">
                        <label for="description">Description: </label>
                        <textarea name="description" id="description" 
                        class="form-control" rows="8">
                      </textarea>
                      </div>

                        <div class="form-grou">
                          <button type="submit" class="btn btn-primary">Publish</button>
                        </div>

                    @if (count($errors))
                    <ul class="alert alert-danger">
                      @foreach ($errors->all() as $error)
                         <li> {{ $error }} </li>
                      @endforeach
                    </ul>
                     @endif

                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
