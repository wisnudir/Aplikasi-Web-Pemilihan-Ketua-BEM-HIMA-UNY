<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url('asset/img/kpu.png') ?>">
    <title>PEMILWA FMIPA UNY</title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('asset/css/bootstrap.min.css') ?>" rel="stylesheet"> 
    <link href="<?php echo base_url('asset/css/prettify.css') ?>" rel="stylesheet"> 
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('asset/css/custom.css') ?>" rel="stylesheet">
    <style type="text/css" media="screen">
        #regForm {
          background-color: #ffffff;
        }

        /* Style the input fields */

        /* Mark input boxes that gets an error on validation: */
        input.invalid {
          background-color: #ffdddd;
        }

        /* Hide all steps by default: */
        .tab {
          display: none;
        }

        /* Make circles that indicate the steps of the form: */
        .step {
          height: 15px;
          width: 15px;
          margin: 0 2px;
          background-color: red;
          border: none; 
          border-radius: 50%;
          display: inline-block;
          opacity: 0.5;
        }

        /* Mark the active step: */
        .step.active {
          opacity: 1;
        }

        /* Mark the steps that are finished and valid: */
        .step.finish {
          background-color: red;
        }
    </style>    
  </head>
  <body>