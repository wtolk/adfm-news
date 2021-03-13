@extends('adfm::public.layout')
@section('meta-title', 'Новости')
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
                <h1>Новости</h1>
                <div class="content">
                    @foreach($news as $item)
                        <div class="row">
                            <div class="title col col-12"><a href="{{$item->url}}">{{$item->title}}</a></div>
                            <div class="date col col-12">{{$item->published_at}}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
@endsection
