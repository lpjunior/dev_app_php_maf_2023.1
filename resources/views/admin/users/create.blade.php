@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>
    <h1>Criar um novo usuário</h1>
    <form method="post" action="{{ route('admin.users.create') }}">
        @csrf

        <div class="mb-3">
            <label for="inputName" class="form-label">Nome</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputName" name="name" value="{{ old('name') }}" aria-describedby="nameHelp">
            <div id="nameHelp" class="form-text">O nome do usuário deve ter entre 3 e 255 caracteres.</div>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="inputEmail" class="form-label">E-mail</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" name="email" value="{{ old('email') }}" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">O email do usuário deve ser validado via email de validação.</div>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="inputPassword" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword" name="password" value="{{ old('password') }}" aria-describedby="passwordHelp">
            <div id="passwordHelp" class="form-text">A senha deve ter um mínimo de 8 caracteres.</div>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Perfil</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="type" id="inputType1" value="client" {{ old('type') == 'client' ? 'checked' : '' }} />
                <label class="form-check-label" for="inputType1">
                    Cliente
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="type" id="inputType2" value="admin" {{ old('type') == 'admin' ? 'checked' : '' }} />
                <label class="form-check-label" for="inputType2">
                    Administrador
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-dark">Cadastrar</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-link">Cancelar</a>
    </form>
</div>
@endsection
