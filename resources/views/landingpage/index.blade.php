@extends('landingpage.master')


@section('content')
    <a href="{{ route('login')  }}">Login</a> |
    <a href="{{ route('register')  }}">Register</a> |

@endsection
