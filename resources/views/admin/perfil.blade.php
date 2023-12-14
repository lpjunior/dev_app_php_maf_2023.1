@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Perfil</h1>    
    <form id="form1" action="{{ route('admin.perfil.edit', $user) }}" method="post">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="inputName" class="form-label">Nome</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputName" name="name" value="{{ old('name', $user->name) }}" aria-describedby="nameHelp">
            <div id="nameHelp" class="form-text">O nome do usuário deve ter entre 3 e 255 caracteres.</div>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="inputEmail" class="form-label">E-mail</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" name="email" value="{{ old('email', $user->email) }}" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">O email do usuário deve ser validado via email de validação.</div>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button form="form1" type="submit" class="btn btn-dark">Cadastrar</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-link">Cancelar</a>
    </form>

    {{-- Botão para abrir o modal de atualização de senha --}}
    <div class="d-flex justify-content-between mb-3">
        <div></div>
        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#updatePasswordModal">Atualizar Senha</button>
    </div>

    {{-- Modal para atualização da senha --}}
    <div class="modal fade" id="updatePasswordModal" tabindex="-1" role="dialog" aria-labelledby="updatePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updatePasswordModalLabel">Atualizar Senha</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-header">
                </div>
                <div class="modal-body">
                <form id="form2" action="{{ route('admin.perfil.edit.password', $user) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="inputPassword" class="form-label">Nova Senha</label>
                        <input type="text" class="form-control @error('password') is-invalid @enderror" id="inputPassword" name="password" value="{{ old('password') }}" aria-describedby="passwordHelp">
                        <div id="passwordHelp" class="form-text">A senha deve ter um mínimo de 8 caracteres.</div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="inputPasswordConfirmation" class="form-label">Confirme a Nova Senha</label>
                        <input type="text" class="form-control @error('password_confirmation') is-invalid @enderror" id="inputPasswordConfirmation" name="password_confirmation" value="{{ old('password_confirmation') }}" aria-describedby="passwordConfirmationHelp">
                        <div id="passwordConfirmationHelp" class="form-text">A confirmação deve ser identifca a senha informada.</div>
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button form="form2" type="submit" class="btn btn-dark">Atualizar senha</button>
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection