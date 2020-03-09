@extends('layouts.app')

@section('content')
    <div class="row">
    <div class="col-12">
    <p><a  href="{{route('wallets.create')}}" class="btn btn-primary">Add new Wallet</a></p>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Public Key</th>
                <th scope="col">$$</th>
            </tr>
        </thead>
        <tbody>
        @foreach($wallets as $wallet)
            <tr>
                <td> {{$wallet->id}} </td>
                <td> {{$wallet->public_key}} </td>
                <td> -- </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$wallets->links()}}
    </div>
    </div>
@endsection