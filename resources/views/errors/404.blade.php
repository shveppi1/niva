@extends('errors.layout')

@php
  $error_number = 404;
@endphp

@section('title')
  Такой страницы нет
@endsection

@section('description')
  @php
    $default_error_message = "Пожалуй <a href='javascript:history.back()''>вернусь назад</a> или <a href='".url('')."'>на главную</a>.";
  @endphp
  {!! isset($exception)? ($exception->getMessage()?$exception->getMessage():$default_error_message): $default_error_message !!}
@endsection
