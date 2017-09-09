@extends('layouts.app')

@section('page_style')
<style>
.alert { margin-top:50px; }
</style>
@endsection

@section('content')
  <div class="container">
    <div class="panel panel-default">
      <div class="panel-heading">Calendar</div>
      <div class="panel-body">
        <score-calendar></score-calendar>
        <div class="alert alert-success clear" role="alert">
          <h3>Tooltips</h3>
          <p>为每一天打分, 活出不一样的明天!</p>
          <p>可以用在许多不同的场景，如健身</p>
          <p>  +1项: 骑行、跑步、爬楼梯、健身房等等</p>
          <p>  -1项: 久坐、饮料、零食等等</p>
        </div>
      </div>
    </div>
  </div>
@endsection
