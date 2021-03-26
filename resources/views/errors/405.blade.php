@extends('errors.minimal')

@section('title', __('Method not Allowed'))
@section('code', '405')
@section('message', __($exception->getMessage() ?: 'Method not Allowed'))
