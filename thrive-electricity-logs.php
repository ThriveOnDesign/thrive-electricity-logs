<?php
   /*
   Plugin Name: Thrive Electricity Logger
   Plugin URI: http://thriveondesign.dev
   description: Custom plugin to keep track of tenants' electricity usage,  created by ThriveOnDesign to be used on the thrive-real website 
   Version: 1.1
   Author: Wayne @ ThriveOnDesign
   Author URI: http://thriveondesign.dev
   License: GPL2
   */

   // security, exit if accessed directly
   if ( !defined( 'ABSPATH' ) ) exit; 

   // create a variable to the plugin path for less future typing
   $pluginDir = plugin_dir_path( __DIR__ ).'thrive-electricty-logs';

   function enqueue_electricity_log_style() {
      wp_enqueue_style( 'thriveElectricityLogStyles', plugin_dir_url( __FILE__ ).'/assets/css/thriveElectricityLogStyles.css', '', time());
   };

   add_action( 'wp_enqueue_scripts', 'enqueue_electricity_log_style');

   // create a function to hold the HTML so that I can convert it into a shortcode
   function thriveElectricityInput() {
      ?>

         <div class="container">
         <div class="success-msg hide">Thank You! Electricity Readings have been successfully added to the database.</div>
         <ul class='check-list'></ul>
         <div  class="send-all hide">
         <p>Please check all readings before pressing submit below.</p>
         <button id="submit-php">Submit</button>
         </div>
         <form class="rm1-47-form" name="47 Rm1" autocomplete="off" >
            <label for="rmReading">47 Rm 1</label> 
            <div class="input-container">
               <input  type="number" name="rmReading" value=12 required>
               <input type="submit" name="submit" value="Enter">
            </div>
         </form>

         <form class="rm2-47-form" name="47 Rm2" autocomplete="off" >
            <label for="rmReading">47 Rm 2</label> 
            <div class="input-container">
               <input type="number" name="rmReading" value=34  required>
               <input type="submit" name="submit" value="Enter">
            </div>
         </form> 

         <form class="rm3-47-form" name="47 Rm3" autocomplete="off" >
            <label for="rmReading">47 Rm 3</label> 
            <div class="input-container">
               <input type="number" name="rmReading" value=56  required>
               <input type="submit" name="submit" value="Enter">
            </div>
         </form> 

         <form class="rm4-47-form" name="47 Rm4" autocomplete="off" >
            <label for="rmReading">47 Rm 4</label> 
            <div class="input-container">
               <input type="number" name="rmReading" value=78  required>
               <input type="submit" name="submit" value="Enter">
            </div>
         </form>

         <form class="rm5-47-form" name="47 Rm5" autocomplete="off" >
            <label for="rmReading">47 Rm 5</label> 
            <div class="input-container">
               <input type="number" name="rmReading" value=9  required>
               <input type="submit" name="submit" value="Enter">
            </div>
         </form>

         <form class="rm6-47-form" name="47 Rm6" autocomplete="off" >
            <label for="rmReading">47 Rm 6</label> 
            <div class="input-container">
               <input type="number" name="rmReading" value=10  required>
               <input type="submit" name="submit" value="Enter">
            </div>
         </form>

         </div>  

      <?php

   }

   

   add_shortcode( 'thrive-electricity-log', 'thriveElectricityInput' );

   ?>