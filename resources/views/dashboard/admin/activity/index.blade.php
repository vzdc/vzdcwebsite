@extends('layouts.dashboard')

@section('title')
    Activity Center
@endsection

@section('content')
    <div class="container-fluid" style="background-color:#F0F0F0;">
        &nbsp;
        <h2>Activity Center</h2>
        &nbsp;
    </div>
    <br />
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <a class="btn btn-warning" href="/dashboard/admin/currency/warnings">Show Warnings</a>
            </div>
            <div class="col-sm">
                <a class="btn btn-warning" href="/dashboard/admin/currency/removals">Show Removals</a>
            </div>
        </div>
    </div>
    <br />

    <div class="container">
        <ul class="nav nav-tabs nav-justified" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="#homewarnings" role="tab" data-toggle="tab" style="color:black">Home Controllers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#visitorwarnings" role="tab" data-toggle="tab" style="color:black">Visitor Controllers</a>
            </li>
        </ul>

        <div class="tab-content text-center">
            <div role="tabpanel" class="tab-pane active" id="homewarnings">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">CID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Hours</th>
                            <th scope="col">Actvity Warning</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (date('z') != 28 || date('z') != 29 || date('z') != 30 || date('z') != 31)
                            <tr>
                                <td colspan="4"><b>It is not the end of a month so data may not be accurate.</b></td>
                            </tr>
                        @endif
                        @if (count($homeWarnings) > 0)
                            {!! Form::open(['action' => 'AdminDash@QueueWarnings']) !!}
                            @csrf
                            @foreach($homeWarnings as $controller)
                                <tr>
                                    <td> {{$controller->id}} </td>
                                    <td> {{$controller->full_name}} </td>
                                    <td> {{$stats[$controller->id]->total_hrs}} </td>
                                    <td>
                                        {{ Form::checkbox( 'warnings[]', $controller->id) }}
                                    </td>
                                </tr>
                            @endforeach
                            <br />
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm">
                                        <button class="btn btn-success" type="submit">Add Warnings</button>
                                    </div>
                                    <div class="col-sm">
                                        <a class="btn btn-danger" href="/dashboard/admin/currency">Cancel</a>
                                    </div>
                                </div>
                            </div>
                            <br />
                            {!! Form::close() !!}
                        @else
                            <tr>
                                <td colspan="4">No controllers to display</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div role="tabpanel" class="tab-pane" id="visitorwarnings">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">CID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Hours</th>
                            <th scope="col">Actvity Warning</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (date('z') != 28 || date('z') != 29 || date('z') != 30 || date('z') != 31)
                            <tr>
                                <td colspan="4"><b>It is not the end of a month so data may not be accurate.</b></td>
                            </tr>
                        @endif
                        @if (count($visitorWarnings) > 0)
                            {!! Form::open(['action' => 'AdminDash@QueueWarnings']) !!}
                            @csrf
                            @foreach($visitorWarnings as $controller)
                                <tr>
                                    <td> {{$controller->id}} </td>
                                    <td> {{$controller->full_name}} </td>
                                    <td> {{$stats[$controller->id]->total_hrs}} </td>
                                    <td>
                                        {!! Form::checkbox( 'warnings[]', $controller->id) !!}
                                    </td>
                                </tr>
                            @endforeach
                            <br />
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm">
                                        <button class="btn btn-success" type="submit">Add Warnings</button>
                                    </div>
                                    <div class="col-sm">
                                        <a class="btn btn-danger" href="/dashboard/admin/currency">Cancel</a>
                                    </div>
                                </div>
                            </div>
                            <br />
                            {!! Form::close() !!}
                        @else
                            <tr>
                                <td colspan="4">No controllers to display</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection