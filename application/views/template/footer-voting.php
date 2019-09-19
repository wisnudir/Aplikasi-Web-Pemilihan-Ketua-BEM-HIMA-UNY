<footer class="footer" style="background-color: #2f3640; height: 50px; padding-top: 1%">
  <div class="container">
    <div class="col-sm-12">
      <p class="text-muted text-center" style="color:#dcdde1"><img width="20px" alt="Brand" src="<?php echo base_url('asset/img/kpu.png') ?>"> KPU FMIPA UNY 2018</p>
    </div>
    <!--<div class="col-sm-6">
      <span class="pull-right" style="color: #e1b12c"><a href="#"  style="color: #fbc531">Bantuan</a> | <a href="#" style="color: #fbc531"">Lapor</a> | <a href="#" style="color: #fbc531">Admin</a></span>
    </div>-->
    
    
    
  </div>
</footer>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo base_url('asset/js/jquery-3.3.1.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('asset/js/bootstrap.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('asset/js/jquery.bootstrap.wizard.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('asset/js/prettify.js') ?>" type="text/javascript"></script>

<script>
	/*
$(document).ready(function() {
	$('#rootwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
		var $total = navigation.find('li').length;
		var $current = index+1;
		var $percent = ($current/$total) * 100;
		$('#rootwizard .progress-bar').css({width:$percent+'%'});
	}});
});
$(document).ready(function() {
  	$('#rootwizard').bootstrapWizard({onNext: function(tab, navigation, index) {
			
				// Make sure we entered the name
				var jab = 'BEMFAK';
				if(!$('input[name='+jab+']:checked').val()) {
					alert('You must enter your name'+jab);
					$('#name').focus();
					return false;			
				}
 
			// Set the name for the next tab
			//$('#tab3').html('Hello, ' + $('#name').val());
 
		}, onTabShow: function(tab, navigation, index) {
			var $total = navigation.find('li').length;
			var $current = index+1;
			var $percent = ($current/$total) * 100;
			$('#rootwizard .progress-bar').css({width:$percent+'%'});
		}});
});*/
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form ...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //progress bar
  var bar = (n+1/x.length)*100;
  document.getElementById("pgBar").style.width= bar+'%';
  // ... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  // ... and run a function that displays the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  //if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form... :
  if (currentTab >= x.length) {
    //...the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}
/*
function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = document.getElementsByName("BEMFAK[]")[0];
  // A loop that checks every input field in the current tab:
  //for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y.checked == false) {
      // add an "invalid" class to the field:
      y.className += " invalid";
      // and set the current valid status to false:
      valid = false;
      alert('haru diisi')
    }
  //}
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}
*/
function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class to the current step:
  x[n].className += " active";
}
</script>

      <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip(); 
      });
      </script>
</body>
</html>