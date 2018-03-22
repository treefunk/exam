Student:
<form action="<?=base_url('main/authenticate/1');?>" method="post">

<input type="text" name="username" id="username">
<input type="text" name="password" id="password">

<button type="submit">Login</button>

</form>

Teacher:
<form action="<?=base_url('main/authenticate/2');?>" method="post">

<input type="text" name="username" id="username">
<input type="text" name="password" id="password">

<button type="submit">Login</button>

</form>

Admin:
<form action="<?=base_url('main/authenticate/10');?>" method="post">

<input type="text" name="username" id="username">
<input type="text" name="password" id="password">

<button type="submit">Login</button>

</form>