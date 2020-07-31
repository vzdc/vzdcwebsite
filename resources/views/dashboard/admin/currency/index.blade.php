@extends('layouts.dashboard')

@section('title')
    Currency Center
@endsection

@section('content')
    <div class="container-fluid" style="background-color:#F0F0F0;">
        &nbsp;
        <h2>Currency Manager</h2>
        &nbsp;
    </div>
    <br>

    <div class="container">
        <ul class="nav nav-tabs nav-justified" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="#homewarnings" role="tab" data-toggle="tab" style="color:black">Home Controller Warnings</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#visitorwarnings" role="tab" data-toggle="tab" style="color:black">Visitor Controller Warnings</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#homeremovals" role="tab" data-toggle="tab" style="color:black">Home Controller Removals</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#visitorremovals" role="tab" data-toggle="tab" style="color:black">Visitor Controller Removals</a>
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
                            <th scope="col">Send Warnings</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (date('z') + 1 != 1 || date('z') + 1 != 0)
                            <tr>
                                <td colspan="4"><b>It is not the beginning/end of a month so data may not be accurate.</b></td>
                            </tr>
                        @endif
                        @if (count($homeWarnings) > 0)
                            {!! Form::open(['action' => 'AdminDash@WarningConfirmation']) !!}
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
                            <button class="btn btn-success" type="submit">Send Warnings</button>
                            <br />
                            <a class="btn btn-danger" href="/dashboard/admin/currency">Cancel</a>
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
                            <th scope="col">Send Warnings</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (date('z') + 1 != 1 || date('z') + 1 != 0)
                            <tr>
                                <td colspan="4"><b>It is not the beginning/end of a month so data may not be accurate.</b></td>
                            </tr>
                        @endif
                        @if (count($visitorWarnings) > 0)
                            {!! Form::open(['action' => 'AdminDash@WarningConfirmation']) !!}
                            @csrf
                            @foreach($visitorWarnings as $controller)
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
                            <button class="btn btn-success" type="submit">Send Warnings</button>
                            <br />
                            <a class="btn btn-danger" href="/dashboard/admin/currency">Cancel</a>
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

            <div role="tabpanel" class="tab-pane" id="homeremovals">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">CID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Hours</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($homeRemovals) > 0)
                            @foreach($homeRemovals as $controller)
                                <tr>
                                    <td> {{$controller->controller_id}} </td>
                                    <td> {{$controller->controller_name}} </td>
                                    <td> {{$stats[$controller->controller_id]->total_hrs}} </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3">No controllers to display</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div role="tabpanel" class="tab-pane" id="visitorremovals">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">CID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Hours</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($visitorRemovals) > 0)
                            @foreach($visitorRemovals as $controller)
                                <tr>
                                    <td> {{$controller->controller_id}} </td>
                                    <td> {{$controller->controller_name}} </td>
                                    <td> {{$stats[$controller->controller_id]->total_hrs}} </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3">No controllers to display</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection