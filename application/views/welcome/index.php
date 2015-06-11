<div class="logo"><img src="<?= base_url('assets/imgs/simer_logo.png'); ?>" alt="..."><p>YOUR SCHOOL WITHOUT WALLS</p></div>

<div class="sign bx-page" data-check="true">    
    
    <div class="signup">
      <div class="icon"><p class="glyphicon glyphicon-user"></p></div>
      <h2>Sign Up As A Scholar</h2>
      <p> Lorem  ipseum dolor sit amet Lorem ipsum dolor sit amet, consectetur adipisicing elit,
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat.
      </p>
      <a href="<?=site_url('/welcome#scholarSignUp')?>" class="btn btn-primary">Sign Up</a>

      <!-- Modal Box -->
      <div id="scholarSignUp" class="modalDialog">
        <div>
          <a href="<?=site_url('/welcome')?>" title="Close" class="close">X</a>
          <h2>Sign up as a Scholar</h2>
          <?= validation_errors(); ?>
          <?= $this->message->display();?>
          <!-- Sign up for Scholars -->
          

          <?= form_open('welcome/sign_user#scholarSignUp'); ?>
            <input type="text" name="fname" placeholder="Firstname">
            <input type="text" name="lname" placeholder="Lastname">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="pass" placeholder="Password">
            <input type="password" name="confpass" placeholder="Verify Password">
            <input type="submit" value="Sign Up">
          <?= form_close();?>
        </div>
      </div>
    </div>

    <div class="signup-school">
      <div class="icon"><p class="glyphicon glyphicon-tower"></p></div>
      <h2>Sign Up As A School</h2>
      <p> Lorem  ipseum dolor sit amet Lorem ipsum dolor sit amet, consectetur adipisicing elit,
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat.
      </p>
      <a href="<?=site_url('/welcome#schoolSignUp')?>" class="btn btn-success">Sign Up</a>
      
      <!-- Modal Box -->
      <div id="schoolSignUp" class="modalDialog">
        <div>
          <a href="<?=site_url('/welcome')?>" title="Close" class="close">X</a>
          <h2>Sign up as a School</h2>
          <!-- Sign up for Schools -->
          <?= validation_errors(); ?>
          <?= $this->message->display();?>

          <?= form_open('welcome/sign_school#schoolSignUp'); ?>
            <input type="text" name="sch_name" placeholder="School Name">
            <input type="email" name="sch_email" placeholder="Email">
            <input type="password" name="sch_pwd" placeholder="Password">
            <input type="password" name="sch_vpwd" placeholder="Verify Password">
            <input type="submit" value="Sign Up">
          <?= form_close(); ?>
        </div>
      </div>
    </div>

    <div class="clear"></div>
    <p>Already a user? <a href="<?= site_url('login'); ?>">Sign in here</a></p>
</div>

<!-- Wrapper for slides -->
<div class="carousel-inner">
  <div class="item active">
    <img src="<?= base_url('assets/imgs/students.jpg'); ?>" alt="...">
    <div class="caption">
        Learning Made <div class="bx-slider-container">
                        <ul class="bx-slider-welcome">
                          <li><p>Easy.</p></li>
                          <li><p>Fun.</p></li>
                          <li><p>Simple.</p></li>
                        </ul>
                      </div>
        <p>Try <span class="simer">Simer</span> Out Today.</p>
    </div>
    <div class="mybx" data-mybx="true"></div>
  </div>
</div>

