{{-- @extends('backpack::layout')

@section('header')
    <section class="content-header">
      <h1>
        {{ trans('backpack::base.dashboard') }}<small>{{ trans('backpack::base.first_page_you_see') }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ backpack_url() }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">{{ trans('backpack::base.dashboard') }}</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="box-title">{{ trans('backpack::base.login_status') }}</div>
                </div>

                <div class="box-body">{{ trans('backpack::base.logged_in') }}</div>
            </div>
        </div>
    </div>
@endsection --}}
{{-- <h1>Hi There</h1> --}}
@extends(backpack_view('blank'))

{{-- @php
    $widgets['before_content'][] = [
        'type'        => 'chart',
        'controller' => \App\Http\Controllers\Admin\Charts\WeeklyUsersChartController::class,
        
        'class'   => 'card mb-2',
        'wrapper' => ['class'=> 'col-md-6'] ,
        'content' => [
            'header' => 'New Users', 
            'body'   => 'This chart should make it obvious how many new users have signed up in the past 7 days.<br><br>',
          ],
    ];
@endphp --}}
{{-- // Widget::add([ 
        //     'type'       => 'chart',
        //     'controller' => \App\Http\Controllers\Admin\Charts\WeeklyUsersChartController::class,

        //     // OPTIONALS

        //     'class'   => 'card mb-2',
        //     'wrapper' => ['class'=> 'col-md-6'] ,
        //     'content' => [
        //          'header' => 'New Users', 
        //          'body'   => 'This chart should make it obvious how many new users have signed up in the past 7 days.<br><br>',
        //     ],
        // ]); --}}
@section('content')
@endsection