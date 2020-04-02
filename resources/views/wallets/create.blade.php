@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-sm-6">
  <form action="{{route('wallets.store')}}" method="POST" >
  @csrf
  <div class="form-group">
    <label for="name">Name Wallet</label>
    <input type="text" class="form-control" name="name" id="name" aria-describedby="name_help" minlength="1" maxlength="32" required>
    <small id="name_help" class="form-text text-muted">Exemple: Name Wallet</small>
  </div>
  <div class="form-group">
    <label for="public_key">Your public key</label>
    <input type="text" class="form-control" name="public_key" id="public_key" aria-describedby="public_key_help" minlength="34" maxlength="34" required>
    <small id="public_key_help" class="form-text text-muted">Exemple: 1AtobE3XqCPS3Qk8vA8nY6xBzhR8TkTXSX</small>
  </div>
   
  <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  </div>
</div>
@endsection