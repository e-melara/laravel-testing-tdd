@extends('layouts.app') @section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-8 mx-auto mb-3">
      <status-form />
    </div>
    <div class='col-8 mx-auto'>
      <statuses-list />
    </div>
  </div>
</div>
@endsection
