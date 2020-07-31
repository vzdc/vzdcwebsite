@extends('layouts.dashboard')

@section('title')
    Currency Center
@endsection

@section('content')
    <div class="container-fluid" style="background-color:#F0F0F0;">
        &nbsp;
        <h2>Confirm Warnings</h2>
        &nbsp;
    </div>
    <br>


    <div class="container text-center">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">CID</th>
                    <th scope="col">Name</th>
                </tr>
            </thead>
            <tbody>
                @if (count($users) > 0)
                    {!! Form::open(['action' => 'AdminDash@SubmitWarnings']) !!}
                    @csrf
                    @foreach($users as $user)
                        <tr>
                            <td> {{ Form::text('users[]', $user->id, ['class' => 'form-control', 'readonly' => 'true']) }} </td>
                            <td> {{ Form::text('names[]', $user->full_name, ['class' => 'form-control', 'readonly' => 'true']) }} </td>
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
                        <td colspan="4">No users to display</td>
                    </tr>
                @endif
            </tbody>
        </table>

    </div>
@endsection