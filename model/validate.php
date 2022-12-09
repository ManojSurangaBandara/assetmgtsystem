<?php

class Validate {

    private $fields;

    public function __construct() {
        $this->fields = new Fields();
    }

    public function getFields() {
        return $this->fields;
    }

    // Validate a generic text field
    public function text($name, $value, $required = true, $min = 1, $max = 255) {

        // Get Field object
        $field = $this->fields->getField($name);

        // If field is not required and empty, remove error and exit
        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }

        // Check field and set or clear error message
        if ($required && empty($value)) {
            $field->setErrorMessage('Required.');
        } else if (strlen($value) < $min) {
            $field->setErrorMessage('Too short.');
        } else if (strlen($value) > $max) {
            $field->setErrorMessage('Too long.');
        } else {
            $field->clearErrorMessage();
        }
    }
    public function longText($name, $value, $required = true, $min = 1) {

        // Get Field object
        $field = $this->fields->getField($name);

        // If field is not required and empty, remove error and exit
        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }

        // Check field and set or clear error message
        if ($required && empty($value)) {
            $field->setErrorMessage('Required.');
        } else if (strlen($value) < $min) {
            $field->setErrorMessage('Too short.');
        } else {
            $field->clearErrorMessage();
        }
    }
    
    // Validate a generic number field
    public function number($name, $value, $required = true) {

        // Get Field object
        $field = $this->fields->getField($name);

        // Call the text method and exit if it yields an error
       // $this->text($name, $value, $required);
       // if ($field->hasError()) {
       //     return;
       // }

        // Check field and set or clear error message
        if (!is_numeric($value)) {
            $field->setErrorMessage('Must be a valid number.');
        } else {
            $field->clearErrorMessage();
        }
    }

// Validate a field with a generic pattern
    public function pattern($name, $value, $pattern, $message, $required = true) {

        // Get Field object
        $field = $this->fields->getField($name);

        // If field is not required and empty, remove errors and exit
        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }

        // Check field and set or clear error message
        $match = preg_match($pattern, $value);
        if ($match === false) {
            $field->setErrorMessage('Error testing field.');
        } else if ($match != 1) {
            $field->setErrorMessage($message);
        } else {
            $field->clearErrorMessage();
        }
    }

    public function ValidateDate($date, $format = 'Y-m-d H:i:s') {
        $version = explode('.', phpversion());
        if (((int) $version[0] >= 5 && (int) $version[1] >= 2 && (int) $version[2] > 17)) {
           // $d = DateTime::createFromFormat($format, $date);
		  // $d = DateTime::date_default_timezone_set($format, $date);
		   //date_default_timezone_set()
        } else {
            $d = new DateTime(date($format, strtotime($date)));
        }
        return $d && $d->format($format) == $date;
    }

    public function phone($name, $value, $required = false) {
        $field = $this->fields->getField($name);

        // Call the text method and exit if it yields an error
        $this->text($name, $value, $required);
        if ($field->hasError()) {
            return;
        }

        // Call the pattern method to validate a phone number
        $pattern = '/^[[:digit:]]{3}-[[:digit:]]{3}-[[:digit:]]{4}$/';
        $message = 'Invalid phone number.';
        $this->pattern($name, $value, $pattern, $message, $required);
    }

    public function email($name, $value, $required = true) {
        $field = $this->fields->getField($name);

        // If field is not required and empty, remove errors and exit
        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }

        // Call the text method and exit if it yields an error
        $this->text($name, $value, $required);
        if ($field->hasError()) {
            return;
        }

        // Split email address on @ sign and check parts
        $parts = explode('@', $value);
        if (count($parts) < 2) {
            $field->setErrorMessage('At sign required.');
            return;
        }
        if (count($parts) > 2) {
            $field->setErrorMessage('Only one at sign allowed.');
            return;
        }
        $local = $parts[0];
        $domain = $parts[1];

        // Check lengths of local and domain parts
        if (strlen($local) > 64) {
            $field->setErrorMessage('Username part too long.');
            return;
        }
        if (strlen($domain) > 255) {
            $field->setErrorMessage('Domain name part too long.');
            return;
        }

        // Patterns for address formatted local part
        $atom = '[[:alnum:]_!#$%&\'*+\/=?^`{|}~-]+';
        $dotatom = '(\.' . $atom . ')*';
        $address = '(^' . $atom . $dotatom . '$)';

        // Patterns for quoted text formatted local part
        $char = '([^\\\\"])';
        $esc = '(\\\\[\\\\"])';
        $text = '(' . $char . '|' . $esc . ')+';
        $quoted = '(^"' . $text . '"$)';

        // Combined pattern for testing local part
        $localPattern = '/' . $address . '|' . $quoted . '/';

        // Call the pattern method and exit if it yields an error
        $this->pattern($name, $local, $localPattern, 'Invalid username part.');
        if ($field->hasError()) {
            return;
        }

        // Patterns for domain part
        $hostname = '([[:alnum:]]([-[:alnum:]]{0,62}[[:alnum:]])?)';
        $hostnames = '(' . $hostname . '(\.' . $hostname . ')*)';
        $top = '\.[[:alnum:]]{2,6}';
        $domainPattern = '/^' . $hostnames . $top . '$/';

        // Call the pattern method
        $this->pattern($name, $domain, $domainPattern, 'Invalid domain name part.');
    }

    public function passeddate($name, $value, $required = true) {
        $field = $this->fields->getField($name);

        // Call the text method and exit if it yields an error
        $this->text($name, $value, $required);
        if ($field->hasError()) {
            return;
        }

        // Call the pattern method to validate a date
        //  $pattern = '/^(0?[1-9]|1[0-2])\/(0?[1-9]|[12][[:digit:]]|3[01])\/[[:digit:]]{4}$/';
        $pattern = '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/';
        $message = 'Invalid date format.';
        $this->pattern($name, $value, $pattern, $message, $required);

        if (!$this->ValidateDate($value, 'Y-m-d')) {
            $field->setErrorMessage('Must be a valid Date');
            return;
        }
        $birthdate = new \DateTime($value);
        $now = new \DateTime();
        if ($birthdate > $now) {
            $field->setErrorMessage('Date can\'t be in the future.');
            return;
        }
        // $field->clearErrorMessage();
    }
    public function current_year_date($name, $value, $currentYear, $required = true) {
        $field = $this->fields->getField($name);

        // Call the text method and exit if it yields an error
        $this->text($name, $value, $required);
        if ($field->hasError()) {
            return;
        }

        // Call the pattern method to validate a date
        //  $pattern = '/^(0?[1-9]|1[0-2])\/(0?[1-9]|[12][[:digit:]]|3[01])\/[[:digit:]]{4}$/';
        $pattern = '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/';
        $message = 'Invalid date format.';
        $this->pattern($name, $value, $pattern, $message, $required);

        if (!$this->ValidateDate($value, 'Y-m-d')) {
            $field->setErrorMessage('Must be a valid Date');
            return;
        }
/*         $birthdate = new \DateTime($value);
        $now = new \DateTime(); */
		
        if (substr($value,0,4) <> $currentYear) {
            $field->setErrorMessage('Select Year should be '.$currentYear);
            return;
        }
        // $field->clearErrorMessage();
    }
   public function equailsCheck($name, $value, $newPassword, $required = true) {
        $field = $this->fields->getField($name);

        // Call the text method and exit if it yields an error
        $this->text($name, $value, $required);
        if ($field->hasError()) {
            return;
        }
        if ($value != $newPassword) {
            $field->setErrorMessage('Confirm Password not same with new Password.');
            return;
        }
        // $field->clearErrorMessage();
    }
	public function checkCurrentPassword($name, $value, $required = true) {
        $field = $this->fields->getField($name);

        // Call the text method and exit if it yields an error
        $this->text($name, $value, $required);
        if ($field->hasError()) {
            return;
        }
	$qry="SELECT * FROM members WHERE login='".$_SESSION['SESS_LOGIN']."' AND passwd='".md5($_POST['currentPassword'])."'";
	$result=mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		if(mysql_num_rows($result) != 1) {
			$field->setErrorMessage('Current Password incorrect.');
		return;
		}
        // Call the pattern method to validate a date
        //  $pattern = '/^(0?[1-9]|1[0-2])\/(0?[1-9]|[12][[:digit:]]|3[01])\/[[:digit:]]{4}$/';
       // $pattern = '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/';
       // $message = 'Invalid date format.';
       // $this->pattern($name, $value, $pattern, $message, $required);

      //  if (!$this->ValidateDate($value, 'Y-m-d')) {
     //       $field->setErrorMessage('Must be a valid Date');
     //       return;
     //   }
     //   $birthdate = new \DateTime($value);
     //   $now = new \DateTime();
     //   if ($value != $newPassword) {
     //       $field->setErrorMessage('Confirm Password not same with new Password.');
     //       return;
     //   }
        // $field->clearErrorMessage();
    }
}
   public function UserLevelCheck($name, $value, $required = true) {
        $field = $this->fields->getField($name);

        // Call the text method and exit if it yields an error
        $this->number($name, $value, $required);
        if ($field->hasError()) {
            return;
        }
        if ($value < $_SESSION['SESS_LEVEL']) {
            $field->setErrorMessage('User level Authority Error.');
            return;
        }
        // $field->clearErrorMessage();
    }
    // Validate a pasword text field
    public function passwordtext($name, $value, $required = true, $min = 8, $max = 25) {

        // Get Field object
        $field = $this->fields->getField($name);

        // If field is not required and empty, remove error and exit
        if (!$required && empty($value)) {
            $field->clearErrorMessage();
            return;
        }

        // Check field and set or clear error message
        if ($required && empty($value)) {
            $field->setErrorMessage('Required.');
        } else if (strlen($value) < $min) {
            $field->setErrorMessage('කෙටි මුර පදයකි. අක්‍ෂර අටකට (8) වැඩි ප්‍රමාණයක් භාවිතා කරන්න. - Too short. - ');
        } else if (strlen($value) > $max) {
            $field->setErrorMessage('දිග මුර පදයකි. අක්‍ෂර විසිපහකට (25) අඩු විය යුතුයි. - Too long. - ');
        } else {
            $field->clearErrorMessage();
        }
    }
}

?>