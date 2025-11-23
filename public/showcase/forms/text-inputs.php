<?php

declare(strict_types=1);

use Archon\UIKit\DataDisplay\Card;
use Archon\UIKit\Inputs\FormGroup;
use Archon\UIKit\Inputs\Label;
use Archon\UIKit\Inputs\Textarea;
use Archon\UIKit\Inputs\TextInput;
use Archon\UIKit\Layout\Structure\Column;
use Archon\UIKit\Layout\Structure\Container;
use Archon\UIKit\Layout\Structure\Row;

echo '<h2>Text Inputs</h2>';
echo '<p class="lead text-muted mb-4">Examples of standard text inputs, textareas, and validation states.</p>';

$snippet = function(string $code): string {
    return '<pre class="code-snippet m-0" style="max-height: 150px;"><code style="white-space: pre-wrap;">' . htmlspecialchars($code) . '</code></pre>';
};

echo (new Container(
    new Row(
        // Standard Input
        (new Column(
            (new Card(
                (new FormGroup(new Label('Email address'), (new TextInput('email', 'email'))->id('userEmail')->placeholder('name@example.com')))
                    ->helpText('We\'ll never share your email with anyone else.')
            ))->header('Standard Input')
              ->footer($snippet("new FormGroup(new Label('Email'), new TextInput('email'))"))
        ))->md(6)->addClass('mb-4'),

        // Invalid Input
        (new Column(
            (new Card(
                (new FormGroup(new Label('Password'), (new TextInput('password', 'password'))->id('userPassword')->invalid()))
                    ->feedbackText('Password must be at least 8 characters.')
            ))->header('Invalid State')
              ->footer($snippet("new TextInput(...)->invalid()"))
        ))->md(6)->addClass('mb-4'),

        // Textarea
        (new Column(
            (new Card(
                (new FormGroup(new Label('Comments'), (new Textarea('comments'))->id('userComments')->rows(3)->value('Valid comment.')->valid()))
                    ->feedbackText('Looks good!')
            ))->header('Textarea (Valid)')
              ->footer($snippet("new Textarea('comments')->valid()"))
        ))->md(6)->addClass('mb-4'),

        // Disabled Input
        (new Column(
            (new Card(
                (new FormGroup(new Label('Disabled Input'), (new TextInput('disabledField'))->id('disabledInput')->value('You can\'t touch this')->disabled()))
            ))->header('Disabled State')
              ->footer($snippet("new TextInput(...)->disabled()"))
        ))->md(6)->addClass('mb-4')
    )
))->fluid();