@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="text-center mb-4">
                    <h1>Ranking</h1>
                    <p class="lead">Here you can find the biggest collectors in the PHP community.</p>
                </div>
                <div class="mb-3">
                    <div class="mb-3 text-center">
                        <form action="">
                            <select name="country" id="country" class="custom-select w-50 mr-1">
                                <option value="">-- Global Ranking --</option>
                                @foreach($countries as $code => $current)
                                    <option value="{{ $code }}" {{ $country === $code ? 'selected' : '' }}>{{ $current->get('name') }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary">Change</button>
                        </form>
                    </div>
                    @if($country && !$countries->has($country))
                        <div class="alert alert-danger">Ops! This country is not in our records yet.</div>
                    @endif
                </div>
                <div class="card">
                    <div class="card-header">
                        @if($country && $countries->get($country))
                            <strong>{{ $countries->get($country)->get('name') }}</strong> <a href="{{ route('rankings.index') }}" class="float-right">Back to Global Ranking</a>
                        @else
                            <strong>Global</strong>
                        @endif
                    </div>
                    <div class="card-body">
                        @if(count($users))
                            <table class="table table-striped table-bordered mb-0">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col" width="7%" class="text-center">#</th>
                                    <th scope="col" width="35%">Name</th>
                                    <th scope="col">Country</th>
                                    <th scope="col" width="12%" class="text-center">Unique</th>
                                    <th scope="col" width="12%" class="text-center">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $key => $user)
                                    <tr>
                                        <th scope="row" class="text-center">{{ $key + 1 }}</th>
                                        <td>
                                            <a href="{{ route('herds.show', $user->twitter) }}">{{ $user->name }}</a>
                                        </td>
                                        <td>
                                            <a href="?{{ http_build_query(['country' => $user->country_code]) }}">
                                                @if($flag = $countries->get($user->country_code)->get('flag'))
                                                    <span class="mr-1">{!! $flag !!}</span>
                                                @endif
                                                {{ $countries->get($user->country_code)->get('name') }}
                                            </a>
                                        </td>
                                        <td class="text-center">{{ $user->elephpants_unique }}</td>
                                        <td class="text-center">{{ $user->elephpants_total }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-info mb-0">
                                No users registered yet.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
