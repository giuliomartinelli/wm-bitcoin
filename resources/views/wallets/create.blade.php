@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-sm-6">
  <form action="{{route('wallets.store')}}" method="POST" >
  @csrf
  <div class="form-group">
    <label for="public_key">Your public key</label>
    <input type="text" class="form-control" name="public_key" id="public_key" aria-describedby="public_key_help" minlength="34" maxlength="34" required>
    <small id="public_key_help" class="form-text text-muted">Exemple: 1AtobE3XqCPS3Qk8vA8nY6xBzhR8TkTXSX</small>
  </div>

  <div class="form-group">
    <label for="private_key">Your private key</label>
    <input type="text" class="form-control" name="private_key" id="private_key" aria-describedby="private_key_help" minlength="52" maxlength="52" required>
    <small id="private_key_help" class="form-text text-muted">Exemple: 5sJitLKVo3FUc8CLvH4dKTg62cLQC7N86av8AzmP7sEMi1KqYqYu</small>
  </div>
   
  <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  </div>
</div>
@endsection