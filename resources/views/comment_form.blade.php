@csrf
<input type="hidden" name="profile_id" value="{{ \App\Http\Controllers\PageController::getProfileId() }}">
<div class="card mb-2">
    <div class="card-header">
        <input class="form-control" name="header" type="text" placeholder="Заголовок">
    </div>
    <div class="card-body">
        <textarea class="form-control" name="text" placeholder="Текст комментария"></textarea>
    </div>
    <div class="card-footer text-body-secondary">
        <input type="submit" class="btn btn-dark" value="Отправить">
    </div>

</div>

