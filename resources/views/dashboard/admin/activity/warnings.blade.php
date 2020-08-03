@extends('layouts.dashboard')

@section('title')
    Activity Warnings
@endsection

@section('content')
<div class="container-fluid" style="background-color:#F0F0F0;">
    &nbsp;
    <h2>Activity Warnings</h2>
    &nbsp;
</div>
<br />
<div class="container">
    <div class="row">
        <div class="col-sm">
            <a class="btn btn-danger" href="/dashboard/admin/currency">Back</a>
        </div>
        <div class="col-sm">
            <a class="btn btn-warning" href="/dashboard/admin/currency/send-warnings">Send Warning Emails</a>
        </div>
    </div>
</div>
<br />

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">CID</th>
            <th scope="col">Name</th>
            <th scope="col">Visitor</th>
            <th scope="col">Remove</th>
        </tr>
    </thead>
    <tbody>
        @if (date('z') != 28 || date('z') != 29 || date('z') != 30 || date('z') != 31)
            <tr>
                <td colspan="4"><b>It is not the end of a month so data may not be accurate.</b></td>
            </tr>
        @endif
        @if (count($warnings) > 0)
            @foreach($warnings as $warning)
                <tr>
                    <td> {{$controller->id}} </td>
                    <td> {{$controller->full_name}} </td>
                    <td> {{$warning->visitor}} </td>
                    <td>
                        <a href="/dashboard/admin/activity/remove-warning/{{ $warning->id }}"
                            class="btn btn-danger simple-tooltip" data-toggle="tooltip" title="Delete"><i
                                    class="fas fa-times"></i></a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4">No controllers to display</td>
            </tr>
        @endif
    </tbody>
</table>
@endsection