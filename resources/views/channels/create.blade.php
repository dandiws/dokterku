@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a New Channel</div>

                <div class="card-body">
                  <form method="POST" action="/channels">
                    {{ csrf_field() }}

                    <div class="form-group">
                      <label for="name">Channel Name: </label>
                    <input type="text" class="form-control" id="name" name="name" 
                    value="{{ old('name')}}">
                    </div>
                    
                    <div class="form-group">
                      <label for="slug">Slug name: </label>
                    <input type="text" class="form-control" id="slug" name="slug" 
                    value="{{ old('slug')}}">
                    </div>

                        <div class="form-group">
                          <button type="submit" class="btn btn-primary">Create</button>
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
