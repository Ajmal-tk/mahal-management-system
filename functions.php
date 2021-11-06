<?php
/*This file is part of DigitalMahal, cbusiness-investment child theme.

All functions of this file will be loaded before of parent theme functions.
Learn more at https://codex.wordpress.org/Child_Themes.

Note: this function loads the parent stylesheet before, then child theme stylesheet
(leave it in place unless you know what you are doing.)
*/


if ( ! function_exists( 'suffice_child_enqueue_child_styles' ) ) {
	function DigitalMahal_enqueue_child_styles() {
	    // loading parent style
	    wp_register_style(
	      'parente2-style',
	      get_template_directory_uri() . '/style.css'
	    );

	    wp_enqueue_style( 'parente2-style' );
	    // loading child style
	    wp_register_style(
	      'childe2-style',
	      get_stylesheet_directory_uri() . '/style.css'
	    );
	    wp_enqueue_style( 'childe2-style');
		
	 }
}
add_action( 'wp_enqueue_scripts', 'DigitalMahal_enqueue_child_styles' );

/*Write here your own functions */
  
function simple_function_1() {
    return "Ajmal function learning";
}
function retreive_memdata(){
	global $wpdb;
	$results = $wpdb->get_results("SELECT * FROM wp_smuzform_entry_data"); 
	if(!empty($results))                       
      {  
         //echo 'data found'; //print_r($results);
		 //foreach($results as $memres) where 
		  $ind_entries = $wpdb->get_results("SELECT DISTINCT entry_id FROM wp_smuzform_entry_data");
		  
		 $eid=1;
		  $indvdata = $wpdb->get_results("SELECT value,entry_id FROM wp_smuzform_entry_data");
		    //echo  $eid." ";
			print_r($indvdata);
			/*   echo "<table width='100%' border='1'>"; 
				echo "<tbody>";      
			    echo "<tr>";
				
		 foreach($indvdata as $rowres){
			  echo "<td>" . $eid . "</td>";
			  if($rowres->entry_id==$eid){
				 // echo 'OK';
				 echo "<td>" . $eid . "</td>" . "<td>" . $rowres->value . "</td>";    //echo $rowres->value." ";
				
			  }
			 
			  else{
				   echo "</tr>";
				    $eid++;
				  //echo 'no incrementing'; echo '<br/>';  "<td>" . $eid . "</td>".
				  echo  "<td>" . $rowres->value . "</td>";//echo  $eid." ";  echo $rowres->value." ";
			  }
          //print_r( $rowres);
		  
      
				//echo "<th>Time</th>" . "<td>" . $row->time . "</td>"; echo "</tr>";
		  }  
		   echo "</tr>";
		   echo "<td colspan='2'><hr size='1'></td>";
		   echo "</tbody>";
           echo "</table>";   */
    }
	  else
		  echo 'No data';
}
  
add_shortcode( 'dbdata', 'retreive_memdata' );

add_shortcode( 'ajuatk', 'simple_function_1' );


