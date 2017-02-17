<?php $this->registerJs('view.js'); ?>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th># задачи</th>
            <th><div class="sorted" sort="username" route="<?=$sort_route?>">Имя пользователя</div></th>
            <th><div class="sorted" sort="email" route="<?=$sort_route?>">Email</div></th>
            <th><div class="sorted" sort="done" route="<?=$sort_route?>">Выполненно</div></th>
        </tr>
        </thead>
        <tbody>
        <? foreach ($table as $row) :?>
            <tr>
                <td><a href="/admin/edit/?id=<?=$row['id']?>"><?=$row['id']?></a></td>
                <td><?=$row['username']?></td>
                <td><?=$row['email']?></td>
                <td><?=($row['done'] == 0) ? 'Нет' : 'Да'?></td>
            </tr>
        <? endforeach ?>
        </tbody>
    </table>
</div>