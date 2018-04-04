<style>

.div-footer{

	position: static;
	margin: 0px 0px 0px 0px;
	width: 1800px;
	
}
</style>

     <div class="div-footer">
      <div class="shop_top">
		<div class="container">
			
				<div class="col-md-6">
				 <div class="login-title">
					<div id="loginbox" class="loginbox">
						<form action='<?=base_url("main/signup/{$id}")?>' method="post" name="login" id="login-form">
						  <fieldset class="input">
						    <p id="login-form-username">
						      <label for="modlgn_username">Username</label>
						      <input id="modlgn_username" type="text" name="username" class="inputbox" size="18" autocomplete="off">
						      <?=form_error('username')?>
						    </p>
						    <p id="login-form-password">
						      <label for="modlgn_passwd">Password</label>
						      <input id="modlgn_passwd" type="password" name="password" class="inputbox" size="18" autocomplete="off">
						      <?=form_error('password')?>

						    </p>
                            <p id="login-form-password2">
                
						      <label for="modlgn_passwd2">Confirm Password</label>
						      <input id="modlgn_passwd2" type="password" name="confirm_password" class="inputbox" size="18" autocomplete="off">
						      <?=form_error('confirm_password')?>
                            </p>
						    <div class="remember">
							    <input type="submit" name="Submit" class="button" value="Register"><div class="clear"></div>
							 </div>
						  </fieldset>
						 </form>
					</div>
			      </div>
				 <div class="clear"></div>
			  </div>
			</div>
		  </div>
	  </div>

