<?php

declare(strict_types=1);

namespace Archon\UIKit\Tests\Media;

use Archon\UIKit\Media\Audio;
use Archon\UIKit\Media\Video;
use PHPUnit\Framework\TestCase;

final class MediaTest extends TestCase
{
    public function testVideoRendersCorrectly(): void
    {
        $video = (new Video())
            ->addSource('movie.mp4', 'video/mp4')
            ->dimensions(320, 240);
        
        $html = $video->render();
        $this->assertStringContainsString('<video', $html);
        $this->assertStringContainsString('width="320"', $html);
        $this->assertStringContainsString('height="240"', $html);
        $this->assertStringContainsString('<source src="movie.mp4" type="video/mp4">', $html);
        $this->assertStringContainsString('controls="controls"', $html); // Default
    }

    public function testVideoAttributes(): void
    {
        $video = (new Video())
            ->autoplay()
            ->loop()
            ->muted()
            ->poster('poster.jpg')
            ->controls(false);
        
        $html = $video->render();
        $this->assertStringContainsString('autoplay="autoplay"', $html);
        $this->assertStringContainsString('loop="loop"', $html);
        $this->assertStringContainsString('muted="muted"', $html);
        $this->assertStringContainsString('poster="poster.jpg"', $html);
        $this->assertStringNotContainsString('controls', $html);
    }

    public function testAudioRendersCorrectly(): void
    {
        $audio = (new Audio())
            ->addSource('sound.mp3', 'audio/mpeg');
        
        $html = $audio->render();
        $this->assertStringContainsString('<audio', $html);
        $this->assertStringContainsString('<source src="sound.mp3" type="audio/mpeg">', $html);
        $this->assertStringContainsString('controls="controls"', $html); // Default
    }

    public function testAudioAttributes(): void
    {
        $audio = (new Audio())
            ->autoplay()
            ->loop()
            ->muted();
        
        $html = $audio->render();
        $this->assertStringContainsString('autoplay="autoplay"', $html);
        $this->assertStringContainsString('loop="loop"', $html);
        $this->assertStringContainsString('muted="muted"', $html);
    }
}
