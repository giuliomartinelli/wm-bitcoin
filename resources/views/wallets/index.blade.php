@extends('layouts.app')

@section('content')
    <div class="row">
    <div class="col-6">
    <p><a  href="{{route('wallets.create')}}" class="btn btn-primary">Add new Wallet</a></p>
    @if($wallets)
    <table class="table table-borderless">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Public Key</th>
                <th scope="col">$$</th>
            </tr>
        </thead>
        <tbody>
        @foreach($wallets as $wallet)

            <tr class="{{ $wallet->total == 'INVALID ADDRESS' ? 'text-danger' : '' }}">
                <td> {{$wallet->id}} </td>
                <td> {{$wallet->name}} </td>
                <td> {{$wallet->public_key}} </td>
                <td> {{$wallet->total}} </td>
            </tr>

        @endforeach
        </tbody>

        <tfooter>
        
            <tr>
                <td>  </td>
                <td>  </td>
                <td> <h4>TOTAL<br>{{ $total != 0 ? $total : "0.00000000" }}</h4> </td>
            </tr>
        
        </tfooter>

    </table>
    @else
    <p>not found wallets</p>
    @endif
    

    {!! $pagination !!}
    </div>
    </div>
@endsection