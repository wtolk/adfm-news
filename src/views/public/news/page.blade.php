@extends('adfm::public.layout')
@section('meta-title', $news->title)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-3">
                @php
                    $links = \App\Adfm\Models\Menu::getData('main-menu');
                @endphp

                <div class="sidebar">
                    @foreach($links[0] as $link)
                        <div class="element"><a href="{{$link->link}}">{{$link->title}}</a></div>
                    @endforeach
                </div>

            </div>
            <div class="col col-12 col-md-8 col-md-offset-1">
                <h1>{{$news->title}}</h1>
                <div class="content">
                    {!! $news->content !!}
                </div>
            </div>
        </div>

    </div>
@endsection
