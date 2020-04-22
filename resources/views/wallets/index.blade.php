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
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        @foreach($wallets as $wallet)

            <tr class="{{ $wallet->status == 'error' ? 'text-danger' : '' }}">
                <td> {{$wallet->id}} </td>
                <td> <nobr>{{$wallet->name}}</nobr> </td>
                <td> <nobr>{{$wallet->public_key}}</nobr> </td>
                <td> <nobr> {{ $wallet->status == 'error' ? $wallet->msg : $wallet->finalBalance }}</nobr> </td>
                <td> 
                    @if($wallet->status == 'error')
                    <form action="{{route('wallets.destroy', ['wallet'=>$wallet->id] )}}" method="POST" >
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">DELETE</button>
                    </form>
                    @endif
                </td>
            </tr>

        @endforeach
        </tbody>

        <tfooter>
        
            <tr>
                <td>  </td>
                <td>  </td>
                <td>  </td>
                <td>
                    <nobr><strong>BTC</strong> {{ $total != 0 ? $total : "0.00000000" }}</nobr><br>
                    <nobr><strong>BRL</strong> {{ $totalBrl != 0 ? $totalBrl : "0.00000000" }}</nobr>
                    <nobr><strong>USD</strong> {{ $totalUsd != 0 ? $totalUsd : "0.00000000" }}</nobr>
                </td>
                <td>  </td>

            </tr>
        
        </tfooter>

    </table>

    <h4>BRL: {{ $brl }}</h4>
    <h4>USD: {{ $usd }}</h4>
    @else
    <p>not found wallets</p>
    @endif
    

    {!! $pagination !!}
    </div>
    </div>




   
@endsection