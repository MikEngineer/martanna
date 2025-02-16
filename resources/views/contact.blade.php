@extends('layouts.app')

@section('title', 'Contattaci')

@section('content')
    <h2>Contattaci</h2>
    @if(session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    <form action="{{ route('contact.send') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="subject" class="form-label">Oggetto</label>
            <input type="text" name="subject" class="form-control">
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Messaggio</label>
            <textarea name="message" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Invia</button>
    </form>
@endsection