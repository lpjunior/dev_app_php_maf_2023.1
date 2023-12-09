<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <h1>O livro "{{ $bookTitle }}" está disponível</h1>
            <p>Olá {{ $user->name }},</p>
            <p>O livro que você reservou está agora disponível para empréstimo.</p>
            <p><a href="{{ $loanLink }}">Clique aqui para efetuar o empréstimo</a></p>
        </div>
    </div>
</div>