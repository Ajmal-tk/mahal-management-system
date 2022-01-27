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


 wp_enqueue_scripts('jquery');

 
 function myplugin_ajaxurl(){
	 
	 echo '<script type="text/javascript">
			var ajaxurl = "'.admin_url('admin-ajax.php').'";
			</script>';
 }
  
  add_action('wp_head','myplugin_ajaxurl');
  
  function add_this_script_footer(){?>
  <script>
	jQuery(document).ready(function($){
				
		$('#fluentform_3').submit(function(){
			
		var hn = $("#ff_3_names_first_name_").val();
		var wn = $("#ff_3_names_last_name_").val();
		//window.alert(hn);
		$.ajax({ 
		url: ajaxurl,
		data: {action: 'marriage_form_data', husn:hn, wfn:wn},
		type: 'post',
		success: function(response) {
			window.alert(response);
			 console.log( response );
		}
		});

		});
		
		
		$('#fluentform_4').submit(function(){
			
		var memnm = $("#ff_4_memname_first_name_").val();
		var spsnm = $("#ff_4_spousename_first_name_").val();
		var fthrnm = $("#ff_4_fathername_first_name_").val();
		var mthrnm = $("#ff_4_mothername_first_name_").val();
		var chldnm = $("#ff_4_childnames").val();
		var hsnm = $("#ff_4_housename_first_name_").val();
		var mblnm = $("#ff_4_mobilenumber_first_name_").val();
		var emilnm = $("#ff_4_emailid").val();
		var rmrksnm = $("#ff_4_description_1").val();
		//husn:hn

		//window.alert(hn);
		$.ajax({ 
		url: ajaxurl,
		data: {action: 'membershipformdata', 
		memres: memnm,  
		spsres: spsnm,
		fthrres: fthrnm,
		mthrres: mthrnm,
		chldres: chldnm,
		hsnres: hsnm,
		mblres: mblnm,
		emlres: emilnm,
		remrkres: rmrksnm},
		type: 'post',
		success: function(response) {
			window.alert(response);
			 console.log( response );
		}
		});

		});
	
	
		$("#menu-item-168").on("click", function(e){
		window.alert("hai worked !");
		});
	
	
		
	});
	</script>
  
  <?php 
  }
  
   add_action('wp_footer','add_this_script_footer');
   
   function membershipformdata(){
		global $wpdb;
		
	if(isset($_POST['memres'])&&isset($_POST['spsres'])&&isset($_POST['fthrres'])&&isset($_POST['mthrres'])&&isset($_POST['chldres'])&&isset($_POST['hsnres'])&&isset($_POST['mblres'])&&isset($_POST['emlres'])&&isset($_POST['remrkres'])){
		$memnam = $_POST['memres'];
		$spsnam = $_POST['spsres'];
		$fthrnam = $_POST['fthrres'];
		$mthrnam = $_POST['mthrres'];
		$chldnam = $_POST['chldres'];
		$housnam = $_POST['hsnres'];
		$mobnam = $_POST['mblres'];
		$emilnam = $_POST['emlres'];
		$remrkdt = $_POST['remrkres'];
			
		}
	    $mmbrshpdb_insert_check= $wpdb->insert('mahal_membership', array('Mid'=>'','member_name' => $memnam,
										'spouse_name' => $spsnam,
										'father_name' => $fthrnam,
										'mother_name' => $mthrnam,
										'child_names' => $chldnam,
										'house_name' => $housnam,
										'mobile_no' => $mobnam,
										'email' => $emilnam,
										'remarks' => $remrkdt));
			
				if($mmbrshpdb_insert_check){
				echo 'Successfully inserted to database !';
				
			}
			else{
				echo $error= $wpdb->print_error;
				echo 'Insertion to database failed';
			}
		   //  echo ' ok';
		 die();
	}
   
   
	function marriage_form_data(){
		global $wpdb;
		if(isset($_POST['husn'])){
			$hsbndname = $_POST['husn'];
		}
		if(isset($_POST['wfn'])){
			$wifename = $_POST['wfn'];
		}
		//echo 'testing echo problem';
		 /*  $db_insert_check= $wpdb->insert('marriage_details', array('husband_name' => $hsbndname,'wife_name' => $wifename));
			
				if($db_insert_check){
				echo 'Successfully inserted to database !';
				
			}else{
				echo $wpdb->last_error;
				echo 'Insertion to database failed';
			}  */ 
		   //echo 'Husband Name is '.$hsbndname.' and Wifes name is '.$wifename;
		   echo 'ok';
		 //die();
	}
	
	do_action('ff_fluentform_form_application_view_' . $route, $form_id);
	
	add_action('ff_fluentform_form_application_view_entries', function ( $form_id )
		{
		   // Do your stuffs here
		   print_r($form_id);
		}, 10, 1);
	
	
      
	add_action( 'wp_ajax_marriage_form_data', 'marriage_form_data' );
	add_action( 'wp_ajax_nopriv_marriage_form_data', 'marriage_form_data' ); 
	add_action( 'wp_ajax_membershipformdata', 'membershipformdata' );
	add_action( 'wp_ajax_nopriv_membershipformdata', 'membershipformdata' );

		add_action('fluentform_submission_inserted', 'fluentformsubmisionthroughphp',20 , 3);
        //add_filter('fluentform_filter_insert_data' ,'fluentformsubmisionthroughphp',10 ,1);
		function fluentformsubmisionthroughphp($entryId, $formData, $form)
		{
		  if($form->id != 3) {
			  
			  return;
		   }
		   else{
			   
			   /* No usage not working   wp insert not working in action hooks as select also 
			   echo 'entering in function';
			  
			   //echo 'Entry Id is'.$entryId.'FormData is '.$formData.' and form is '.$form;
			   //print_r($formData);
			   $formresponses = $formData['names'];
			    $husres=$formresponses['first_name'];
			    $wifres=$formresponses['last_name'];
				
				//echo 'husband_name is'.$husres.' and wife name is '.$wifres;
			   $db_insert_check=$wpdb->insert('marriage_details', array('husband_name' => $husres,'wife_name' => $wifres));
			   //$post_id = $wpdb->get_results("SELECT * from marriage_details WHERE id = 1");  print_r($post_id);
			   //echo $wpdb->last_error;
			   if($db_insert_check){
				echo 'Successfully inserted to database !';
				}
				else{
				//echo $wpdb->last_error;
				echo 'Insertion to database failed';
			} 
			*/
		   }
		   // DO your stuffs here
		}
	
	add_action('fluentform_submission_inserted', 'membershipformsbmsn',10 , 3);	


	function membershipformsbmsn($entryId, $formData, $form)
		{
		  if($form->id != 4) {
			  
			  return;
		   }
		 /*  else{
			   
			  echo 'entering in function';
			   //print_r($formData);
			   $post_id = $wpdb->get_results("SELECT * from marriage_details WHERE id = 1"); 
			   print_r($post_id);
			   // today work parse array and get field values
			   
			  /* 
			   $memnm = $formData['memname'];
			    $husres=$formresponses['first_name'];
			    $wifres=$formresponses['last_name'];
			  
			  No usage not working   wp insert not working in action hooks as select also 
			  
			   [memname] => Array ( [first_name] => nasih ) [input_radio] => Yes [spousename] => Array ( [first_name] => amina ) [fathername] => Array ( [first_name] => kader ) [mothername] => Array ( [first_name] => kadeeja ) [input_radio_1] => yes [numeric-field] => 2 [childnames] => abu,hisham [housename] => Array ( [first_name] => kunjoth ) [mobilenumber] => Array ( [first_name] => 6583265974 ) [emailid] => sdf@d.fhd [description_1] => dsgsdrgr
			  
			  
			   //echo 'Entry Id is'.$entryId.'FormData is '.$formData.' and form is '.$form;
			  
			   $formresponses = $formData['names'];
			    $husres=$formresponses['first_name'];
			    $wifres=$formresponses['last_name'];
				
				//echo 'husband_name is'.$husres.' and wife name is '.$wifres;
			   $db_insert_check=$wpdb->insert('marriage_details', array('husband_name' => $husres,'wife_name' => $wifres));
			   //$post_id = $wpdb->get_results("SELECT * from marriage_details WHERE id = 1");  print_r($post_id);
			   //echo $wpdb->last_error;
			   if($db_insert_check){
				echo 'Successfully inserted to database !';
				}
				else{
				//echo $wpdb->last_error;
				echo 'Insertion to database failed';
			} 
			
		   }   */
		   // DO your stuffs here
		}
		



  //  --------------------------------------
  
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
		  $ind_entries = $wpdb->get_var("SELECT COUNT(DISTINCT entry_id) FROM `wp_smuzform_entry_data` ");
		   // $ind_entries;  entry count    //print_r($ind_entries);
		 $eid=1;
		 echo "<div class='wp-block-table is-style-stripes'><table border='1'>";
		    for($idt=1;$idt<=$ind_entries;$idt++){
				echo "<tr><td>".$idt."</td>";
				$indvdata = $wpdb->get_results("SELECT value,entry_id FROM wp_smuzform_entry_data where entry_id=".$idt."");
				//echo $idt." ";
				foreach($indvdata as $key)
				{
					echo "<td>".$key->value."</td>";  //echo $key->value." ";
				}
				echo "</tr>";
			}
			echo "</table> </div>";
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




