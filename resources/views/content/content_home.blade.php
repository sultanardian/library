@extends('dashboard')

@section('dashboard-active', 'active')

@section('dashboard-content')
	<div class="card-deck text-center">

        <div class="card mb-4 shadow-sm">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">TOTAL BOOKS</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">{{ $datas['totalBooks'] }}</h1>
          </div>
        </div>

        <div class="card mb-4 shadow-sm">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">TOTAL CATEGORIES</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">{{ $datas['totalCategories'] }}</h1>
          </div>
        </div>

        <div class="card mb-4 shadow-sm">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">TOTAL LOANS</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">{{ $datas['totalLoans'] }}</h1>
          </div>
        </div>        

      </div>
  <div>
    <p>hello</p>
  </div>
@endsection