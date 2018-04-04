        <div class="header">
        <div class="container">
            <div class="row">
              <div class="col-md-12">
                 <div class="header-left">
                     <!--<div class="logo">
                        <a href="index.html"><img src="images/logo.png" alt=""/></a>
                     </div>-->
                     <div class="menu">
                          <a class="toggleMenu" href="#"><img src="images/nav.png" alt="" /></a>
                            <ul class="nav" id="nav">
                            </ul>
                            <script type="text/javascript" src="js_snow/responsive-nav.js"></script>
                    </div>                          
                    <div class="clear"></div>
                </div>
                <div class="header_right">
                  <!-- start search-->
                      <div class="search-box">
                            <div id="sb-search" class="sb-search">
                                <form>
                                    <input class="sb-search-input" placeholder="Enter your search term..." type="search" name="search" id="search">
                                    <input class="sb-search-submit" type="submit" value="">
                                    <span class="sb-icon-search"> </span>
                                </form>
                            </div>
                        </div>
                        <!----search-scripts---->
                        <script src="js_snow/classie.js"></script>
                        <script src="js_snow/uisearch.js"></script>
                        <script>
                            new UISearch( document.getElementById( 'sb-search' ) );
                        </script>
                        <!----//search-scripts---->
                    <ul class="icon1 sub-icon1 profile_img">
                     <li><a class="active-icon c1" href="#"> </a>
                        <ul class="sub-icon1 list">
                          <div class="login_buttons">
                             <div class="check_button"><a href="<?=base_url('main/reg')?>">Register</a></div>
                             <div class="login_button"><a href="<?=base_url('main/login')?>">Login</a></div>
                             <div class="clear"></div>
                          </div>
                          <div class="clear"></div>
                        </ul>
                     </li>
                   </ul>
                   <div class="clear"></div>
           </div>
          </div>
         </div>
        </div>
    </div>