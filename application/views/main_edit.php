<?php $this->registerJs('edit.js'); ?>
<script type="text/javascript"> var edit_id = <?=$table[0]['id']?>; </script>

<form>
    <div class="form-group">
        <input type="checkbox" id="done" <?=($table[0]['done'] == 1) ? "checked" : '' ?>>
        <label>Выполненно</label>
    </div>
    <div class="form-group">
        <label>Имя пользователя</label>
        <input type="text" class="form-control" id="username" placeholder="Имя пользователя" readonly value="<?=$table[0]['username']?>">
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" id="email" placeholder="Email" readonly value="<?=$table[0]['email']?>">
    </div>
    <div class="form-group">
        <label>Текст задачи</label>
        <textarea class="form-control" id="message" rows="3"><?=$table[0]['message']?></textarea>
    </div>
    <div class="form-group">
        <div class="img_preview">
            <? foreach($files as $file) : ?>
                <div class="img_wrapper"><img src="/web/img/upload/<?=$file['name']?>"></div>
            <? endforeach ?>
        </div>
        <div style="clear:both"></div>
    </div>

    <?php if(Authorize::is_logged()) : ?>
        <button type="button" id="edit" class="btn btn-primary">Сохранить задачу</button>
    <?php endif ?>
</form>