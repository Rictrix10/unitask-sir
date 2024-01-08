
@extends('layouts.app')

@section('head')
    <style>
        form {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-top: 20px;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            margin-top: 20px;
            background-color: green;
            color: white;
        }
    </style>
@endsection
@section('content')
    <form action="{{ URL('/create-schedule') }}" method="POST">
        @csrf
        <label for='name'>{{ __('Name') }}</label>
        <input type='text' class='form-control' id='name' name='name'>

        <label for="initial_date">Start</label>
        <input type='date' class='form-control' id='initial_date' name='initial_date' required value='{{ now()->toDateString() }}'>

        <label for="finish_date">End</label>
        <input type='date' class='form-control' id='finish_date' name='finish_date' required value='{{ now()->toDateString() }}'>


        <label for="description">Description</label>
        <textarea id="description" name="description"></textarea>

        <label for="color">Color</label>
        <input type="color" id="color" name="color" />

        <input type="submit" value="Save" class="btn btn-success" />
    </form>
@endsection
