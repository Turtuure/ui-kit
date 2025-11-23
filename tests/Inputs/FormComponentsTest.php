<?php

declare(strict_types=1);

namespace Archon\UIKit\Tests\Inputs;

use Archon\UIKit\Inputs\FormGroup;
use Archon\UIKit\Inputs\Label;
use Archon\UIKit\Inputs\Textarea;
use Archon\UIKit\Inputs\TextInput;
use PHPUnit\Framework\TestCase;

final class FormComponentsTest extends TestCase
{
    public function testLabelRendersCorrectly(): void
    {
        $label = new Label('Email Address');
        $this->assertStringContainsString('>Email Address</label>', $label->render());
    }

    public function testLabelLinksToInput(): void
    {
        $label = (new Label('Your Name'))->for('nameField');
        $this->assertStringContainsString('<label for="nameField">Your Name</label>', $label->render());
    }

    public function testTextInputRendersCorrectly(): void
    {
        $input = new TextInput('email', 'email');
        $html = $input->render();
        $this->assertStringContainsString('<input', $html);
        $this->assertStringContainsString('name="email"', $html);
        $this->assertStringContainsString('type="email"', $html);
        $this->assertStringContainsString('class="form-control"', $html);
    }

    public function testTextInputWithValueAndPlaceholder(): void
    {
        $input = (new TextInput('username'))
            ->value('john.doe')
            ->placeholder('Enter username');
        $html = $input->render();
        $this->assertStringContainsString('value="john.doe"', $html);
        $this->assertStringContainsString('placeholder="Enter username"', $html);
    }

    public function testTextInputDisabled(): void
    {
        $input = (new TextInput('field'))->disabled();
        $this->assertStringContainsString('disabled="disabled"', $input->render());
    }

    public function testTextInputValidState(): void
    {
        $input = (new TextInput('field'))->valid();
        $this->assertStringContainsString('class="form-control is-valid"', $input->render()); // Sorted alphabetically
    }

    public function testTextInputInvalidState(): void
    {
        $input = (new TextInput('field'))->invalid();
        $this->assertStringContainsString('class="form-control is-invalid"', $input->render());
    }

    public function testTextareaRendersCorrectly(): void
    {
        $textarea = new Textarea('message');
        $html = $textarea->render();
        $this->assertStringContainsString('<textarea', $html);
        $this->assertStringContainsString('name="message"', $html);
        $this->assertStringContainsString('rows="3"', $html);
        $this->assertStringContainsString('class="form-control"', $html);
    }

    public function testTextareaWithValueAndRows(): void
    {
        $textarea = (new Textarea('bio'))->value('My bio content')->rows(5);
        $this->assertStringContainsString('rows="5"', $textarea->render());
        $this->assertStringContainsString('>My bio content</textarea>', $textarea->render());
    }

    public function testFormGroupRendersBasicElements(): void
    {
        $label = (new Label('Your Email'))->for('testEmail');
        $input = (new TextInput('email', 'email'))->id('testEmail');
        $formGroup = new FormGroup($label, $input);

        $html = $formGroup->render();
        $this->assertStringContainsString('<div class="mb-3">', $html);
        $this->assertStringContainsString('<label for="testEmail">Your Email</label>', $html);
        $this->assertStringContainsString('<input', $html);
        $this->assertStringContainsString('id="testEmail"', $html);
    }

    public function testFormGroupWithHelpText(): void
    {
        $label = (new Label('Password'))->for('passwordField');
        $input = (new TextInput('password', 'password'))->id('passwordField');
        $formGroup = (new FormGroup($label, $input))->helpText('Must be 8-20 characters long.');

        $html = $formGroup->render();
        $this->assertStringContainsString('<div id="passwordFieldHelp" class="form-text">Must be 8-20 characters long.</div>', $html);
    }

    public function testFormGroupWithInvalidFeedback(): void
    {
        $label = (new Label('Username'))->for('usernameField');
        $input = (new TextInput('username'))->id('usernameField')->invalid();
        $formGroup = (new FormGroup($label, $input))->feedbackText('Username already taken.');

        $html = $formGroup->render();
        $this->assertStringContainsString('<div class="invalid-feedback">Username already taken.</div>', $html);
        $this->assertStringContainsString('is-invalid', $html);
    }

    public function testFormGroupWithValidFeedback(): void
    {
        $label = (new Label('Username'))->for('usernameField');
        $input = (new TextInput('username'))->id('usernameField')->valid();
        $formGroup = (new FormGroup($label, $input))->feedbackText('Looks good!');

        $html = $formGroup->render();
        $this->assertStringContainsString('<div class="valid-feedback">Looks good!</div>', $html);
        $this->assertStringContainsString('is-valid', $html);
    }

    public function testFormGroupTextareaIntegration(): void
    {
        $label = (new Label('Comments'))->for('commentsArea');
        $textarea = (new Textarea('comments'))->id('commentsArea');
        $formGroup = new FormGroup($label, $textarea);

        $html = $formGroup->render();
        $this->assertStringContainsString('<label for="commentsArea">Comments</label>', $html);
        $this->assertStringContainsString('<textarea', $html);
        $this->assertStringContainsString('id="commentsArea"', $html);
    }
}