<?php $this->registerJs('add.js'); ?>

<form id="fadd">
    <div class="form-group">
        <label>Имя пользователя</label>
        <input type="text" class="form-control" name="username" placeholder="Имя пользователя">
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" name="email" placeholder="Email">
    </div>
    <div class="form-group">
        <label>Текст задачи</label>
        <textarea class="form-control" name="message" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label>File input</label>
        <input type="file" class="form-control-file" id="inputId" accept="image/jpeg,image/png,image/gif">
        <div class="img_preview"></div>
        <div style="clear:both"></div>
    </div>
    <button type="button" id="add" class="btn btn-primary">Добавить задачу</button>
</form>