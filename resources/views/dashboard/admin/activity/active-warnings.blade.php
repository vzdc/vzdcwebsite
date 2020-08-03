@extends('layouts.dashboard')

@section('title')
    Active Warnings
@endsection

@section('content')
<div class="container-fluid" style="background-color:#F0F0F0;">
    &nbsp;
    <h2>Active Warnings</h2>
    &nbsp;
</div>
<br />
<div class="container">
    <div class="row">
        <div class="col-sm">
            <a class="btn btn-danger" href="/dashboard/admin/activity">Back</a>
        </div>
    </div>
</div>
<br />

<div class="container">
    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th scope="col">CID</th>
                <th scope="col">Name</th>
                <th scope="col">Visitor</th>
                <th scope="col">Remove</th>
            </tr>
        </thead>
        <tbody>
            @if (count($warnings) > 0)
                @foreach($warnings as $warning)
                    <tr>
                        <td> {{$warning->controller_id}} </td>
                        <td> {{$warning->controller_name}} </td>
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
</div>
@endsection