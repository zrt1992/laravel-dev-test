@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Access Cancellation</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">1</th>
                                <td>{{$user->name}}</td>
                                @if($user->is_admin_approve)
                                    <td>
                                        <a class="btn btn-danger" href="{{route('deny-access-control',$user->id)}}" role="button">Cancel Access</a>
                                    </td>
                                @else
                                    <td>
                                        <a class="btn btn-success" href="{{route('deny-access-control',$user->id)}}" role="button">Grant Access</a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
