#Validator
This is an extremely lightweight validator class. It has no dependencies and is extremely simple to use.
```php

$rules = [
	'username' => 'required|alphanum|min:5'
]
$validator = new Validator($rules, $input);

if($validator->passes())
{
	//Code here
} else {
	$errors = $validator->errors;
}
```