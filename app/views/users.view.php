<?php require 'partial/head.php' ?>
<h1>All users</h1>

<?php foreach ($users as $user):?>
<li> <?= $user->name; ?> </li>
<?php endforeach; ?>

<h1>Submit Your Name</h1>
<form method="post" action="/users">
    <input name="name">
    <button type="submit">Submit</button>
</form>
<?php require 'partial/footer.php' ?>




