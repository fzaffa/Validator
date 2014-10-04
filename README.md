[![Build
Status](https://travis-ci.org/fzaffa/Validator.svg?branch=master)](https://travis-ci.org/fzaffa/Validator)
#Validator
Lightweight input validation class.
##Installation
Right now the package isn't in packagist repositories, to install download it and autoload the class in your composer.json
```json
"autoload": {
        "psr-4": {
            "Fzaffa\\Validator\\": "path/to/src"
        }
}
```
##Usage
```php

$rules = [
	'username' => 'required|alphanum|min:5',
	'password' => 'required|min:8'
]
//just for showing, you don't really want to hardcode the input :P
$input = [
	'username' => 'yourusername123',
	'password' => 'correct horse battery staple'
]

$validator = new Validator($rules, $input);

if($validator->passes())
{
	//Run your code here
} else {
	//returns an array with the errors
	$errors = $validator->errors;
}
```
###Nested input validation
Also nested input validation is supported.
```php
$rules = [
	'title' => 'required',
	'sections' => [
			'name' => 'reqired|alphanum',
			'value' => 'required'
	]
]

$input = [
	'title' => 'On the origin of Species',
	'sections' => [
		[
			'name' => 'Galapagos',
			'value' => 'Short story about Galapagos'
		],
		[
			'name' => 'Geology',
			'value' => 'Short story about geology and stuff'
		]
	]
]
```
This will work and will validate each *name* and *value* fields against the rules specified in the *sections* array.
##Available rules
- Alphanum - *The :attribute field must be alphanumeric.*
- Email - *The :attribute field must be a valid email.*
- Date - *The :attribute field must be a valid date in the :param format.*
- Max - *The :attribute field must be maximum :param characters long.*
- Min - *The :attribute field must be at least :param characters long.*
- Numeric - *The :attribute field must be numeric.*
- Required - *The :attribute field is required.*


 New rules will be added.
 
 ##Contributing
 Feel free to contribute.
 
