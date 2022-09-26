<?php include "./includes/page-top.php";?>
<?php include "./components/navbar.php";?>

<div class="register__wrapper__container">



<!-- REGISTER BOX START -->
<div class="register__container__content">
<h1>Register<span class="red-txt">.</span></h1>
<p>Fill in your details below to register your interest:</p>

<?php include "./includes/registration/messages.php";?>

<form method="post" action="./components/registration.php">  

<!-- PERSONAL DETAILS -->
<div class="form__personal__details">
<input placeholder="First Name:" type="text" name="fname" require>
<input placeholder="Surname:" type="text" name="sname" require>
<input placeholder="Email:" type="text" name="contact-email"/>
<input placeholder="Contact Number:" type="text" name="contact-number" require/>
<input placeholder="Company Name:" type="text" name="company-name" require/>
<input class="honeypot" type="text" name="website" tabindex="-1"/>
</div>
<!--  -->


<!-- SELECT EVENT -->
<br>  
<div class="form__event__select">
<p>Please select an event:</p>

<input class="radio-btn" type="checkbox" id="event1" name="event[]" value="Jakarta(Indonesia)">
<label for="event1">JAKARTA, INDONESIA</label>


<input class="radio-btn" type="checkbox" id="event2" name="event[]" value="Dubai(UAE)">
<label for="event1">DUBAI, UAE</label>


<input class="radio-btn" type="checkbox" id="event3" name="event[]" value="Mumbai(India)">
<label for="event1">MUMBAI, INDIA</label>

</div>
<!--  -->


 <!-- SUBMIT BTN -->
  <input class="btn btn--light submit__btn" type="submit" name="submit" value="Submit">  
  <!--  -->

</form>
</div>
<!-- REGISTER BOX ENDS -->


</div>


<?php include "./components/footer.php";?>
<?php include "./includes/page-bottom.php";?>