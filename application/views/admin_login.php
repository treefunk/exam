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
                     Admin Login
				 <?php if($this->session->flashdata('message')): ?>
					<?=$this->session->flashdata('message')?>
                 <?php endif; ?>
                 
					<div id="loginbox" class="loginbox">
						<form action='<?=base_url("main/authenticate/10")?>' method="post" name="login" id="login-form">
						  <fieldset class="input">
						    <p id="login-form-username">
						      <label for="modlgn_username">Username</label>
						      <input id="modlgn_username" type="text" name="username" class="inputbox" size="18" autocomplete="off">
						    </p>
						    <p id="login-form-password">
						      <label for="modlgn_passwd">Password</label>
						      <input id="modlgn_passwd" type="password" name="password" class="inputbox" size="18" autocomplete="off">
						    </p>
						    <div class="remember">
							    <p id="login-form-remember">
							   </p>
							    <input type="submit" name="Submit" class="button" value="Login"><div class="clear"></div>
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
