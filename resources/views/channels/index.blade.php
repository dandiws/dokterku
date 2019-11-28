@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Channel Dokterku</div>

                <div class="card-body">
                  @foreach($channels as $channel)
                    <article>
                      <h4>
                        {{ $channel->name }}
                      </h4>
              
                    </article> 

                  <hr> 
                  @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
