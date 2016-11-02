<?php
	// ============================================= 
	/**
	* class   : 
	* menthod : formValidate 
	* @param  : 
	* @output : 
	* @Description : method use for validation of form
	**/
	// ==============================================    
	function formValidate($input=array())
	{
		$error = '';
		$name = trim($input['name']);
        $contact_person = $input['contact_person'];
        $item_name = trim($input['item_name']);
        $amounts = $input['amounts'];
        $email = $input['email'];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
	        //VALIDATION FOR EMAIL
	        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) { 
				$error .= '<p class="error">Enter a valid email address.</p>';
			}

			//VALIDATION FOR NAME
	        if (empty($name)) { 
				$error .= '<p class="error">Please enter name.</p>';
			}

			//VALIDATION FOR CONTACT PERSION
	        if (empty($contact_person)) { 
				$error .= '<p class="error">Please select contact person.</p>';
			}

			//VALIDATION FOR PROJECT NAME
	        if (empty($item_name)) { 
				$error .= '<p class="error">Please enter project name.</p>';
			}

			//VALIDATION FOR AMOUNT
	        if (empty($amounts)) { 
				$error .= '<p class="error">Please enter amount.</p>';
			}

			//VALIDATION FOR CONTACT PERSION
	        if (!empty($amounts) && !is_numeric($amounts)) { 
				$error .= '<p class="error">Please enter amount in number.</p>';
			}
		}
		return $error;
	}
?>
