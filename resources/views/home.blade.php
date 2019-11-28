@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="">
                <div class="h4 mb-5">Temukan dokter</div>
                @php
                    $specs = DB::table('specializations')->get();
                @endphp
                <form action="{{route('doctor.search')}}" class="mb-3" method="GET">
                    <div class="row">
                        <div class="col-6">
                            <input class="form-control" type="text" name="doctor_name" placeholder="Cari dokter ">
                               
                        </div>
                        <div class="col-3">
                            <select class="form-control" name="specialization_id" id="">
                                <option value="">All</option>
                                @foreach ($specs as $sp)
                                <option value="{{ $sp->id }}">{{ $sp->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <button type="submit" class="btn btn-primary w-100">Cari</button>
                        </div>
                    </div>
                </form>
                <div class="">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @forelse ($doctors as $doctor)
                        <div class="doctor-item">
                            <div class="details">
                                <div class="mb-2">
                                    @php
                                        $detail = $doctor->doctorDetails();
                                    @endphp
                                    <strong>{{ $detail?$detail->title_start:null }} {{$doctor->name}} {{ $detail?$detail->title_end:null }}</strong>
                                </div>
                                <div class="text-muted">
                                        <i class="fa fa-user-md mr-2"></i> {{$detail->name ?? null }}</div>
                                <p class="text-muted">
                                    <i class="fa fa-map-marker mr-2"></i> {{ $detail->address ?? null }}
                                </p>
                            </div>
                            <span class="send">
                                <a href={{route('chat.friend',['friend'=>$doctor->id])}}>Kirim pesan</a>
                            </span>
                        </div>
                    @empty
                        <div class="text-muted"><em>Dokter tidak di temukan</em></div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection