@extends('layouts.master')

@section('title')
    Page Not Found
@endsection

@section('content')
    <span class="border border-light" style="background-color:#F0F0F0">
    <div class="container">
        &nbsp;
        <h2>404: Page Not Found</h2>
        &nbsp;
    </div>
</span>
    <br>

    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-8">
                        <h3>Whoops it looks you're lost because that page does not exist!</h3>
                    </div>
                    <div class="col-sm-4">
                        <img src="/photos/lost.gif" width="300px">
                    </div>
                </div>
                <hr>
                <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Go
                    Back</a>
                <a href="/" class="btn btn-primary"><i class="fas fa-home"></i> Go Home</a>
                @if(Auth::check())
                    <a href="/dashboard" class="btn btn-info"><i class="fas fa-tachometer-alt"></i> Controller Dashboard</a>
                @endif
            </div>
        </div>
    </div>

@endsection
