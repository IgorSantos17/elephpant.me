@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-center mb-4">
                    <h1><span class="text-muted">{{ $user->name }}</span></h1>
                    <p class="lead">
                        <a href="https://twitter.com/{{ $user->twitter }}">{{ '@' . $user->twitter }}</a> -
                        {{ ($country = $countries->get($user->country_code))->get('name') }}
                        @if ($flag = $country->get('flag'))
                            <span class="ml-1">{!! $flag !!}</span>
                        @endif
                    </p>
                    <div id="stats">
                        @include('herd._stats')
                    </div>
                </div>
                <div class="card mb-3 herd-card">
                    <ul class="list-group list-group-flush">
                        @foreach($elephpants as $key => $elephpant)
                            <li data-controller="counter"
                                data-counter-id="{{ $elephpant->id }}"
                                class="list-group-item {{ $key % 2 === 0 ? 'bg-white' : 'bg-light' }} {{ isset($userElephpants[$elephpant->id]) ? 'has-elephpants' : '' }}">
                                <div class="row align-items-center no-gutters">
                                    <div class="col-xl-9 col-lg-8">
                                        <div class="float-left mr-3">
                                            <div class="media">
                                                <a href="javascript:void(0)" data-toggle="popover" data-content="<img src='{{ asset('storage/elephpants/' . $elephpant->image) }}' width='150'/>" data-placement="left" data-trigger="hover">
                                                    <img src="{{ asset('storage/elephpants/' . $elephpant->image) }}" width="50" alt="" class="img-thumbnail rounded img-fluid mr-3">
                                                </a>
                                                <div class="media-body">
                                                    <p class="mb-0"><strong>{{ $elephpant->name }}</strong> - {{ $elephpant->description }}</p>
                                                    <p class="mb-0 text-black-50">
                                                        Sponsor: {{ $elephpant->sponsor }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3">
                                        <div class="float-right h5 mb-0">
                                            <span class="badge badge-pill badge-secondary">
                                                {{ $elephpant->pivot->quantity }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
