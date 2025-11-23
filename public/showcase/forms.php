<?php

declare(strict_types=1);

use Archon\UIKit\Inputs\FormGroup;
use Archon\UIKit\Inputs\Label;
use Archon\UIKit\Inputs\Textarea;
use Archon\UIKit\Inputs\TextInput;
use Archon\UIKit\Showcase\Showcase;

/**
 * Forms Showcase Page
 */

echo '<h2>Forms</h2>';
echo '<p class="lead text-muted">Examples of text inputs, textareas, and form groups.</p>';

Showcase::example(
    'Email Input with Help Text',
    'A standard email input with a placeholder and informative help text.',
    function () {
        $emailInput = (new TextInput('email', 'email'))
            ->id('userEmail')
            ->placeholder('name@example.com');
        echo (new FormGroup(new Label('Email address'), $emailInput))
            ->helpText('We\'ll never share your email with anyone else.');
    },
    '$emailInput = (new TextInput(\'email\', \'email\'))
    ->id(\'userEmail\')
    ->placeholder(\'name@example.com\');
echo (new FormGroup(new Label(\'Email address\'), $emailInput))
    ->helpText(\'We\\\'ll never share your email with anyone else.\');'
);

Showcase::example(
    'Password Input with Invalid Feedback',
    'A password input showing an invalid state with feedback text.',
    function () {
        $passwordInput = (new TextInput('password', 'password'))
            ->id('userPassword')
            ->invalid();
        echo (new FormGroup(new Label('Password'), $passwordInput))
            ->feedbackText('Password must be at least 8 characters.');
    },
    '$passwordInput = (new TextInput(\'password\', \'password\'))
    ->id(\'userPassword\')
    ->invalid();
echo (new FormGroup(new Label(\'Password\'), $passwordInput))
    ->feedbackText(\'Password must be at least 8 characters.\');'
);

Showcase::example(
    'Comments Textarea with Valid Feedback',
    'A textarea for comments, displaying a valid state with feedback.',
    function () {
        $commentTextarea = (new Textarea('comments'))
            ->id('userComments')
            ->rows(3)
            ->value('This is a valid comment.')
            ->valid();
        echo (new FormGroup(new Label('Comments'), $commentTextarea))
            ->feedbackText('Looks good!');
    },
    '$commentTextarea = (new Textarea(\'comments\'))
    ->id(\'userComments\')
    ->rows(3)
    ->value(\'This is a valid comment.\')
    ->valid();
echo (new FormGroup(new Label(\'Comments\'), $commentTextarea))
    ->feedbackText(\'Looks good!\');'
);

Showcase::example(
    'Disabled Text Input',
    'An input field that is disabled and cannot be edited.',
    function () {
        $disabledInput = (new TextInput('disabledField'))
            ->id('disabledInput')
            ->value('You can\'t touch this')
            ->disabled();
        echo (new FormGroup(new Label('Disabled Input'), $disabledInput));
    },
    '$disabledInput = (new TextInput(\'disabledField\'))
    ->id(\'disabledInput\')
    ->value(\'You can\'t touch this\')
    ->disabled();
echo (new FormGroup(new Label(\'Disabled Input\'), $disabledInput));'
);
