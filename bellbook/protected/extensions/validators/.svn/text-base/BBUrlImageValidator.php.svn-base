<?php

/**
 * BBUrlImageValidator validates attributes to ensure they are valid urls to valid images.
 * 
 * @extends CValidator
 */
class BBUrlImageValidator extends CValidator {

	/**
	 * content to validate against
	 */
	public $content = '';
	
	/**
	 * validateAttribute validates the attribute. If error, then error is added to object.
	 *
	 * makes sure given attribute is valid URL to a valid Image
	 * 
	 * @access protected
	 * @param mixed $object object being validated
	 * @param mixed $attribute attribute being validated
	 * @return void
	 */
	protected function validateAttribute($object, $attribute) {
		$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $object->$attribute);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        if(trim($output)!=$content)
        	$this->addError($object, $attribute,'Image File is Invalid.');
	}
}