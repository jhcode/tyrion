<div id="lightbox_bg"></div>
<div id="light_box">
    <div class="wrapper">
        <h1>Try out Simer today</h1>
        <h3>Testrun simer using one of the roles listed below to get a feel of how Simer works. Clicking on any of the roles takes you directly to the interface. Click around and see how everything happens.</h3>
        <p class="video_link">
            <a href="#">Simer Instructional Videos</a>
        </p>
        <ul class="login_roles">
            <li><a href="<?= site_url("/auth/demo_login/admin")?>">As School Administrator</a></li>
            <li><a href="<?= site_url("/auth/demo_login/staff")?>">As Staff</a></li>
            <li><a href="<?= site_url("/auth/demo_login/student")?>">As Student</a></li>
            <li><a href="<?= site_url("/auth/demo_login/parent")?>">As Parent</a></li>
            <!-- <li style="margin-top:10px;margin-left:200px"><a href="<?= site_url("/auth/demo_login/bursar")?>">As Bursar</a></li> -->
        </ul>
    </div>
    <div class="video_container">
        <div id="divider"></div>
        <div id="video_section">
            <div class="wrapper">
                <div class="col1"><?= img(base_url("assets/imgs/vid_icon.png")); ?></div>
                <div class="col2">
                    <h2><a href="#">Screencast: Up and running with simer</a></h2>
                    <h3>Watch how easy it can be setting up simer and using it to manage a large database of users.</h3>
                    <h4>Join the <a href="#">#SimerMedia</a> Youtube Channel</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="container">
    <div id="main_form">
        <div id="header_graphic">
            <a href="<?= site_url(); ?>"><div id="logo"></div></a>
        </div>
        <div id="form_content">
            <div id="shadow_graphic"><?= img(base_url("assets/imgs/shadow_graphic.png")); ?></div>
            <div id="generic_form">
                <?= form_open("login"); ?>
                    
                        <? if(simer_reveal_msg() !== ""): ?>
                            <div class="notification-error quick-show-error">
                                <?= simer_reveal_msg();?>
                            </div>
                        <? endif; ?>                        
                    </div>

                    <div class="form_row">
                        <label for="email">E-mail Address : </label><input type="email" name="email" placeholder="Your e-mail address" class="textbox" id="email_field"/>
                        <div class="descriptor_container">
                            <div class="descriptor_text"></div>
                        </div>
                    </div>
                    <div class="form_row">
                        <label for="pass">Password : </label><input type="password" name="pass" placeholder="Your password" class="textbox" id="password_field" />
                        <div class="descriptor_container">
                            <div class="descriptor_text"></div>
                        </div>
                    </div>
                    <div class="form_row">
                        <input type="submit" name="submit_button" value="Login" class="buttons" id="login-button"/>
                        <label for="remember_me" class="fancy-box"></label><input type="checkbox" name="remember_me" class="fancy-box" /> Remember me on this computer
                    </div>
                <?= form_close(); ?>
            </div>
        </div>
        <div id="form_footer">
            <p class="links">
                <?= anchor('auth/forgot_password','Forgot your Password?'); ?> | <a href="/resources/experience_simer.pdf">View User Guide</a> | <a href="#" id="try_simer">Try Simer Demo!</a></p>
            <p class="footer_info">Go for Simer! Call +234 (0) 802 871 9312.</p>

           <!--  <div  style="margin:auto 0">
                <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.simerapp.com" data-text="Check out this new web solution for schools, you can demo it out!!!" data-via="simerapp" data-count="none" data-hashtags="ProudlyNigerian">Tweet @simerapp</a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
            </div> -->
        </div>
    </div>
</div>