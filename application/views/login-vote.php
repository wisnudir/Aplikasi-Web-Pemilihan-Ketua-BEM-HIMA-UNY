<div class="container text-center">
  <div>
    <h1>Login.</h1>
  </div>
    <?php
    $attributes = array('class'=>'form-inline center-block');
      echo form_open('vote/login', $attributes); ?>
      <?php echo form_input($nim); ?>
      <?php echo form_submit($submit); ?>     
      <?php echo form_close(); ?>
  <?php 
  if ($error or $error_validation) {
    echo '<p class="lead">Login gagal, silakan coba lagi.</p> <div class="alert alert-warning" role="alert"><b>', $error, $error_validation,'</b></div>
    <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="400px" height="167px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 379 158" xmlns:xlink="http://www.w3.org/1999/xlink">
 <defs>
  <style type="text/css">
   <![CDATA[
    .fil1 {fill:#ED3237}
    .fil2 {fill:black}
    .fil0 {fill:black;fill-rule:nonzero}
   ]]>
  </style>
 </defs>
 <g id="Layer_x0020_1">
  <metadata id="CorelCorpID_0Corel-Layer"/>
  <path class="fil0" d="M193 34l0 99c0,0 1,1 1,2 0,1 1,2 2,3 1,1 2,2 3,2 1,0 2,1 3,1l149 0c2,0 4,-1 6,-3 2,-1 3,-3 3,-5l0 -99c0,-2 -1,-4 -3,-6 -2,-1 -4,-2 -6,-2l-149 0c-2,0 -4,1 -6,2 -2,2 -3,4 -3,6zm25 46c-2,1 -2,1 -2,3 0,2 1,3 2,3 0,2 1,2 1,4 1,1 1,0 1,2 0,1 0,2 0,3l-11 5c-6,2 -5,6 -5,13l43 0c0,-12 1,-11 -12,-16 -4,-2 -5,-3 -3,-8 1,-1 1,-1 1,-2 1,-3 2,-1 2,-4 0,-2 0,-3 -1,-3 1,-4 1,-6 -2,-9 -4,-4 -11,-3 -14,1 -1,2 -2,6 0,8zm56 13l71 0 0 -15 -71 0 0 15zm0 25l71 0 0 -14c0,-1 -1,-1 -1,-1l-70 0 0 15zm0 -50l70 0c0,0 1,-1 1,-2l0 -14 -71 0 0 16zm-89 65l0 -99c0,-4 2,-9 5,-12 3,-3 7,-5 12,-5l149 0c4,0 9,2 12,5 3,3 5,8 5,12l0 99c0,4 -2,8 -5,11 -3,3 -8,5 -12,5l-149 0c-2,0 -5,0 -7,-1 -2,-1 -4,-3 -5,-4 -1,-1 -3,-3 -4,-5 -1,-2 -1,-4 -1,-6z"/>
  <polygon class="fil1" points="97,121 140,121 140,110 97,110 "/>
  <polygon class="fil1" points="97,105 100,105 138,105 140,105 140,94 97,94 "/>
  <path class="fil1" d="M97 59l0 8 43 0 0 -11 -13 0c-2,0 -1,1 -3,3 -4,6 -13,7 -19,3 -3,-3 -1,-3 -8,-3z"/>
  <polygon class="fil1" points="97,89 100,89 138,89 140,89 140,83 138,83 114,83 97,83 "/>
  <polygon class="fil1" points="97,132 100,132 138,132 140,132 140,127 97,126 "/>
  <polygon class="fil1" points="97,78 140,78 140,73 97,72 "/>
  <path class="fil1" d="M97 40c14,1 9,-2 16,-3 7,0 1,3 18,3l9 0 0 -5c-5,-1 -36,0 -43,0l0 5z"/>
  <polygon class="fil1" points="127,51 140,51 140,46 126,46 "/>
  <path class="fil1" d="M98 18c-1,1 -1,-1 -1,5 0,3 0,4 0,6l43 0c1,-2 1,-3 1,-5 0,-1 0,-2 0,-3 -1,-4 0,-2 -1,-2l-42 -1z"/>
  <path class="fil1" d="M140 148c1,-1 0,1 1,-2l-1 -9 -43 0c0,2 -1,9 1,11l42 0z"/>
  <path class="fil2" d="M13 67c1,4 -5,33 -6,40 -1,7 -2,14 4,17 3,2 16,5 20,3 6,-2 7,-7 8,-14 1,-7 2,-14 4,-21 1,-5 2,-16 3,-20 3,-8 13,-3 18,-6 2,-3 2,-9 3,-12l38 0c8,10 16,3 16,-3 0,-7 -9,-13 -15,-3l-38 0c0,-3 4,-11 1,-13 -2,-1 -44,0 -49,0 -9,0 -18,2 -20,13 -1,5 1,10 3,13 3,4 6,4 10,6z"/>
  <rect class="fil1" transform="matrix(4.64241 -0 -1.02442 1 348.355 0)" width="6.66891" height="157.924"/>
 </g>
</svg><br><a href="'.base_url('vote').'" class="btn btn-info btn-lg"> Coba Lagi</a>';
  } else {
    echo '<p class="lead">Silakan letakkan KTM pada scanner yang telah disediakan.</p> <svg class="img-responsive center-block" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="400px" height="198px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 368 183" xmlns:xlink="http://www.w3.org/1999/xlink">
           <defs>
            <style type="text/css">
             <![CDATA[
              .fil1 {fill:black}
              .fil0 {fill:black;fill-rule:nonzero}
             ]]>
            </style>
           </defs>
           <g id="Layer_x0020_1">
            <metadata id="CorelCorpID_0Corel-Layer"/>
            <path class="fil0" d="M193 17l0 98c0,1 1,2 1,2 0,2 1,3 2,3 1,1 2,2 3,2 1,1 2,1 3,1l148 0c2,0 5,-1 6,-3 2,-1 3,-3 3,-5l0 -98c0,-2 -1,-4 -3,-6 -1,-1 -3,-2 -6,-2l-148 0c-2,0 -4,1 -6,2 -2,2 -3,4 -3,6zm24 46c-1,0 -1,0 -1,3 0,1 1,2 2,2 0,2 1,3 1,4 1,2 1,1 1,3 0,1 0,2 0,3l-11 4c-6,2 -5,6 -5,13l43 0c0,-12 1,-11 -12,-16 -4,-2 -5,-3 -3,-7 1,-1 0,-1 1,-3 1,-2 2,-1 2,-4 0,-1 0,-2 -1,-2 1,-4 0,-7 -2,-10 -4,-3 -11,-2 -14,2 -1,1 -2,5 -1,8zm57 12l70 0 0 -15 -70 0 0 15zm0 25l70 0 0 -14c0,-1 0,-1 -1,-1l-69 0 0 15zm0 -50l69 0c1,0 1,0 1,-1l0 -14 -70 0 0 15zm-89 65l0 -98c0,-5 2,-9 5,-12 3,-3 7,-5 12,-5l148 0c5,0 9,2 12,5 3,3 6,7 6,12l0 98c0,4 -3,8 -6,11 -3,4 -7,6 -12,6l-148 0c-2,0 -5,-1 -6,-2 -3,-1 -5,-2 -6,-4 -1,-1 -3,-3 -4,-5 -1,-2 -1,-4 -1,-6z"/>
            <path class="fil1" d="M14 50c1,4 -5,33 -6,39 -1,8 -2,14 4,18 2,2 16,4 20,3 6,-2 7,-8 8,-15 1,-7 2,-13 3,-20 1,-5 3,-16 4,-20 3,-9 13,-3 18,-6 2,-4 1,-9 3,-13l38 0c7,11 16,4 16,-2 0,-7 -10,-13 -16,-3l-37 0c0,-3 3,-11 1,-13 -2,-1 -45,-1 -49,-1 -10,0 -18,3 -20,14 -1,5 1,9 3,13 3,3 6,3 10,6zm126 80c1,-1 0,1 1,-2l0 -9 -43 0c-1,3 -1,10 0,11l42 0zm-42 -129c-1,1 -1,-1 0,5 0,2 -1,4 0,6l43 0c0,-2 0,-3 0,-5 0,-1 0,-3 0,-3 0,-4 0,-2 -1,-3l-42 0zm29 33l14 0 0 -6 -15 0 1 6zm-29 -11c13,0 8,-3 15,-3 8,0 1,3 18,3l10 0 0 -5c-5,-1 -37,-1 -43,-1l0 6zm0 37l43 0 0 -5 -43 0 0 5zm0 54l2 0 38 0 3 0 0 -5 -43 0 0 5zm0 -43l2 0 38 0 3 0 0 -5 -3 0 -24 0 -16 0 0 5zm0 -29l0 8 42 0 1 -11 -14 0c-2,0 -1,0 -2,2 -4,7 -14,8 -19,3 -4,-3 -2,-3 -8,-2zm0 45l2 0 38 0 3 0 0 -10 -43 0 0 10zm0 16l43 0 0 -10 -43 0 0 10z"/>
            <path class="fil0" d="M0 176l4 -1c0,1 1,2 2,3 0,1 1,1 3,1 1,0 2,0 3,-1 0,0 1,-1 1,-2 0,0 -1,-1 -1,-1 0,0 -1,-1 -1,-1 -1,0 -2,0 -4,-1 -2,0 -3,-1 -4,-2 -2,-1 -2,-2 -2,-4 0,-1 0,-2 1,-3 0,-1 1,-2 2,-2 1,0 3,-1 4,-1 3,0 5,1 6,2 1,1 2,3 2,5l-4 0c0,-1 -1,-2 -1,-3 -1,0 -2,0 -3,0 -1,0 -2,0 -3,0 0,1 0,1 0,2 0,0 0,1 0,1 1,0 2,1 4,1 2,1 4,1 5,2 1,0 1,1 2,2 0,1 1,2 1,3 0,1 -1,3 -1,4 -1,1 -2,1 -3,2 -1,0 -3,1 -5,1 -2,0 -4,-1 -6,-2 -1,-1 -2,-3 -2,-5z"/>
            <path id="1" class="fil0" d="M33 175l4 1c0,2 -1,4 -3,5 -1,1 -3,2 -5,2 -3,0 -5,-1 -7,-3 -2,-2 -3,-5 -3,-8 0,-3 1,-6 3,-8 2,-2 4,-3 7,-3 3,0 5,1 6,3 1,0 2,2 2,3l-4 1c0,-1 -1,-2 -1,-2 -1,-1 -2,-1 -3,-1 -2,0 -3,0 -4,1 -1,2 -1,3 -1,6 0,2 0,4 1,5 1,1 2,2 4,2 1,0 2,0 3,-1 0,-1 1,-2 1,-3z"/>
            <path id="2" class="fil0" d="M59 182l-4 0 -2 -4 -8 0 -2 4 -4 0 8 -20 4 0 8 20zm-7 -8l-3 -8 -3 8 6 0z"/>
            <polygon id="3" class="fil0" points="62,182 62,162 66,162 74,175 74,162 78,162 78,182 74,182 66,169 66,182 "/>
            <polygon id="4" class="fil0" points="82,182 82,162 86,162 95,175 95,162 99,162 99,182 95,182 86,169 86,182 "/>
            <polygon id="5" class="fil0" points="103,182 103,162 107,162 107,182 "/>
            <polygon id="6" class="fil0" points="111,182 111,162 115,162 124,175 124,162 127,162 127,182 123,182 115,169 115,182 "/>
            <path id="7" class="fil0" d="M141 175l0 -4 9 0 0 8c-1,1 -2,2 -4,3 -1,0 -3,1 -5,1 -2,0 -4,-1 -5,-2 -2,-1 -3,-2 -4,-4 -1,-1 -1,-3 -1,-5 0,-2 1,-4 1,-6 1,-2 3,-3 4,-4 2,0 3,-1 5,-1 3,0 5,1 6,2 2,1 3,2 3,4l-4 1c0,-1 -1,-2 -2,-2 -1,-1 -2,-1 -3,-1 -2,0 -3,0 -4,2 -1,1 -2,2 -2,5 0,2 1,4 2,5 1,1 2,2 4,2 1,0 2,0 3,0 1,-1 1,-1 2,-2l0 -2 -5 0z"/>
            <polygon id="8" class="fil0" points="167,182 167,174 159,162 164,162 169,170 174,162 179,162 171,174 171,182 "/>
            <path id="9" class="fil0" d="M180 172c0,-2 0,-4 1,-5 0,-1 1,-2 2,-3 1,-1 1,-1 2,-2 2,0 3,-1 5,-1 3,0 5,1 7,3 2,2 3,5 3,8 0,3 -1,6 -3,8 -2,2 -4,3 -7,3 -3,0 -6,-1 -7,-3 -2,-2 -3,-5 -3,-8zm4 0c0,2 1,4 2,5 1,1 2,2 4,2 1,0 3,-1 4,-2 1,-1 2,-3 2,-5 0,-2 -1,-4 -2,-5 -1,-2 -2,-2 -4,-2 -2,0 -3,0 -4,2 -1,1 -2,3 -2,5z"/>
            <path id="10" class="fil0" d="M203 162l4 0 0 11c0,2 0,3 0,3 1,1 1,2 2,2 0,1 1,1 2,1 1,0 2,0 3,-1 1,0 1,-1 1,-1 0,-1 0,-2 0,-4l0 -11 4 0 0 10c0,3 0,5 0,6 0,1 -1,2 -1,2 -1,1 -2,2 -3,2 -1,0 -2,1 -4,1 -2,0 -3,-1 -4,-1 -1,-1 -2,-1 -2,-2 -1,-1 -1,-1 -2,-2 0,-1 0,-3 0,-5l0 -11z"/>
            <path id="11" class="fil0" d="M224 182l0 -20 8 0c3,0 4,0 5,0 1,1 2,1 3,2 0,1 1,2 1,3 0,2 -1,3 -2,4 -1,1 -2,2 -4,2 1,1 2,1 2,2 1,0 2,2 3,3l2 4 -5 0 -3 -4c-1,-2 -2,-3 -2,-3 0,-1 -1,-1 -1,-1 -1,0 -1,0 -2,0l-1 0 0 8 -4 0zm4 -12l3 0c2,0 3,0 4,0 0,0 1,0 1,-1 0,0 0,-1 0,-1 0,-1 0,-2 0,-2 -1,0 -1,-1 -2,-1 0,0 -1,0 -3,0l-3 0 0 5z"/>
            <polygon id="12" class="fil0" points="252,182 252,162 256,162 256,182 "/>
            <path id="13" class="fil0" d="M260 162l8 0c2,0 3,0 4,0 1,0 2,1 3,2 1,1 1,2 2,3 0,2 1,3 1,5 0,2 -1,3 -1,4 -1,2 -1,3 -2,4 -1,1 -2,1 -3,2 -1,0 -2,0 -4,0l-8 0 0 -20zm5 3l0 14 3 0c1,0 2,0 2,0 1,-1 1,-1 2,-1 0,-1 1,-1 1,-2 0,-1 0,-2 0,-4 0,-2 0,-3 0,-4 0,-1 -1,-1 -1,-2 -1,0 -1,-1 -2,-1 -1,0 -2,0 -4,0l-1 0z"/>
            <path id="14" class="fil0" d="M302 175l4 1c0,2 -1,4 -3,5 -1,1 -3,2 -5,2 -3,0 -5,-1 -7,-3 -2,-2 -3,-5 -3,-8 0,-3 1,-6 3,-8 2,-2 4,-3 7,-3 2,0 5,1 6,3 1,0 2,2 2,3l-4 1c0,-1 -1,-2 -1,-2 -1,-1 -2,-1 -3,-1 -2,0 -3,0 -4,1 -1,2 -1,3 -1,6 0,2 0,4 1,5 1,1 2,2 4,2 1,0 2,0 3,-1 0,-1 1,-2 1,-3z"/>
            <path id="15" class="fil0" d="M328 182l-4 0 -2 -4 -8 0 -2 4 -4 0 8 -20 4 0 8 20zm-7 -8l-3 -8 -3 8 6 0z"/>
            <path id="16" class="fil0" d="M331 182l0 -20 8 0c2,0 4,0 5,0 1,1 2,1 2,2 1,1 1,2 1,3 0,2 0,3 -1,4 -1,1 -2,2 -4,2 1,1 2,1 2,2 1,0 2,2 2,3l3 4 -5 0 -3 -4c-1,-2 -2,-3 -2,-3 -1,-1 -1,-1 -1,-1 -1,0 -2,0 -2,0l-1 0 0 8 -4 0zm4 -12l3 0c2,0 3,0 3,0 1,0 1,0 2,-1 0,0 0,-1 0,-1 0,-1 0,-2 0,-2 -1,0 -1,-1 -2,-1 0,0 -1,0 -3,0l-3 0 0 5z"/>
            <path id="17" class="fil0" d="M351 162l8 0c2,0 3,0 4,0 1,0 2,1 3,2 1,1 1,2 2,3 0,2 0,3 0,5 0,2 0,3 0,4 -1,2 -1,3 -2,4 -1,1 -2,1 -3,2 -1,0 -2,0 -4,0l-8 0 0 -20zm4 3l0 14 3 0c2,0 2,0 3,0 1,-1 1,-1 2,-1 0,-1 0,-1 1,-2 0,-1 0,-2 0,-4 0,-2 0,-3 0,-4 -1,-1 -1,-1 -1,-2 -1,0 -2,-1 -2,-1 -1,0 -2,0 -4,0l-2 0z"/>
           </g>
        </svg>
    <br>
    <img src="'.base_url("asset/img/Stampede.gif").'" alt="loading">';
    }
  
  ?>
  <br><br>
   <!-- <p><code>Perhatian!</code> Jika anda mengalami masalah dengan scanner, silakan hubungi panitia.</p>  -->
  <div class="text-center">
  <button onclick="tampil()" id="tblTog" class="btn btn-default"> Skip Scanner</button><br>
  <small><code>Note: </code>Tombol <b>skip scanner</b> hanya tersedia saat pengujian sistem saja.</small>    
  </div>
  <script type="text/javascript">
    function tampil() {
      if (document.getElementById("formNim").className == 'form-control') {
        document.getElementById("formNim").className = 'ui-hidden-accessible';
        document.getElementById("tblNim").className = 'ui-hidden-accessible';
        location.reload();
      } else {
        document.getElementById("formNim").className = 'form-control';
        document.getElementById("tblNim").className = 'btn btn-default';
      }
    }

    formNim.onblur = function(){
      formNim.focus();
    }
  </script>
  </div>