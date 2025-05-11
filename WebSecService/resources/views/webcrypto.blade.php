@extends('layouts.master')
@section('title', 'Prime Numbers')
@section('content')
 <script type="text/javascript"> ... </script>
 <div class="card m-4">
 <div class="card-body">
 <div class="row mb-2">
 <div class="col">
 <label for="name" class="form-label">Plain Text</label>
 <textarea id="plain" type="text" class="form-control" placeholder="Data" name="data" required>
Welcome to WebCrypto</textarea>
 </div>
 </div>
 <div class="row mb-2">
 <div class="col">
 <button type="button" class="btn btn-primary" onclick="encryptCBC()">Encrypt</button>
 <button type="button" class="btn btn-primary" onclick="decryptCBC()">Decrypt</button>
 </div>
 </div>
 <div class="row mb-2">
 <div class="col">
 <label for="cipher" class="form-label">Cipher</label>
 <textarea id="cipher" type="text" class="form-control" placeholder="Data" name="data" required></textarea>
 </div>
 </div>
 </div>
 </div>
@endsection