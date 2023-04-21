<form method="post" action="" >
    @csrf
    <input type="hidden" name="user_id" value=" @if(isset($user)) {{ $user->id }} @elseif(isset($book)) {{ $book->user_id }} @endif ">
    <input type="hidden" name="id" value=" @if(isset($book)) {{ $book->id }} @else 0 @endif ">
    <div class="card mb-2">
        <div class="card-header">
            <input class="form-control" name="name" required type="text" placeholder="Название" @if(isset($book)) value="{{ $book->name }}" @endif>
        </div>
        <div class="card-body">
            <textarea class="form-control" rows="5" name="text" required placeholder="Текст">@if(isset($book)) {{ $book->text }} @endif</textarea>
        </div>
        <div class="card-footer text-body-secondary">
            <input type="submit" class="btn btn-dark" value="Сохранить">
        </div>
    </div>
</form>
