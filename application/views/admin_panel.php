<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" type="text/javascript"></script>
  <script src="/template/js/admin_panel.js"></script>
</head>
<style>
  td:focus {
    background: #FA6;
    outline: none;  /* убрать рамку */
  }
</style>
<body>
<table id="users">
    <thead>
    <tr>
        <td># ID</td>
        <td>Email</td>
        <td>Активирован</td>
        <td>Дата</td>
    </tr>
    </thead>
    <tbody>
    <?php
    /**
     * @var array $allUsers
     * @var DBUsers $user
     */
    if ($allUsers):
        foreach ($allUsers as $user): ?>
            <tr>
                <td><?php echo $user->getId(); ?></td>
                <td class="edit email <?php echo $user->getId()?>"><?php echo $user->getEmail(); ?></td>
                <td><?php if ($user->getAccess() == 1): ?>Да<?php else:?>Нет
                    <?php endif; ?>
                    </td>
                <td><?php echo date(' H:i:s d/m/Y', $user->getRegistrationDate()); ?></td>
                </tr>
            <?php
        endforeach;
    endif; ?>
    </tbody>
</table>
<p><a href="/users/logout/">Выйти</a> из системы</p>
</body>
</html>