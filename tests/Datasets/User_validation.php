<?php

dataset('user_validation', [
    'A name is required' => ['form.name', null, 'required'],
    'A name is Min 5 ' => ['form.name', str_repeat('*', 3), 'min'],
    'A name has max chars 30' => ['form.name', str_repeat('*', 31), 'max'],

    'An email is required' => ['form.email', null, 'required'],
    'An email is a valid email ' => ['form.email', 'abcdefg', 'email'],

    'An password is required' => ['form.password', null, 'required'],
    'An password is min 8' => ['form.password', 'abscewa', 'min'],
    // 'An password is mixedCase' => ['form.password', 'abscewa', 'mixed'],

]);
