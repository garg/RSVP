<?php

class form_validator {
	
	protected $errors = array();
	protected $field_empty = false;
	
	protected function add_error( $error ) {
	
		$this->errors[] = $error;
	}
	
	public function output_errors( $tag, $class_name, $end ) {
	
		if( !empty $this->errors ) {
			foreach( $this->errors as $error ) {
				echo '<' . $tag . ' class="' . $class_name .'">' . $error . '</' . $tag . '>' . $end;
			}
			return true;
		} else {
			return false;
		}
	}
	
	public function string_length( $field, $string, $maxlength ) {
	
		$error = ( strlen( $string ) > $maxlength ) ? true : false;
		$plural = ( $maxlength == 1 ) ? '' : 's';
		
		if( $error == true ) {
			$this->add_error( 'The length of ' . $field . ' must be less than ' . $maxlength . ' character' . $plural . '.' );
		}
		
		return $error;
	}
	
	public function empty_field( $field ) {
		
		if ( empty( $field ) && $this->field_empty == false ) {
			
			$this->add_error( 'Please complete all the required fields.' );
			$this->field_empty = true;
			return true;
		} else {
			
			return false;
		}
	}
	
	public function check_email( $email ) {
	
		if( filter_var( $register_email, FILTER_VALIDATE_EMAIL ) === false ) {
		
			$this->add_error( 'The email address you have supplied is invalid.' );
			return false;
		} else {
		
			return true;
		}
	}
	
	public function check_date( $day, $month, $year ) {
		
		if( checkdate( $month, $day, $year ) === false ) {
		
			$this->add_error( 'Please supply a valid date' );
			return false;
		} else {
			
			return true;
		}
	}
	
	public function timestamp_in_future( $timestamp ) {
		
		if( $timestamp < time() ) {
		
			$this->add_error( 'Please supply a future date.' );
			return false;
		} else {
		
			return true;
		}
	}
	
	public function timestamp_in_past( $timestamp ) {
		
		if( $timestamp > time() ) {
		
			$this->add_error( 'Please supply a past date.' );
			return false;
		} else {
		
			return true;
		}
	}
}

?>