<?php

declare(strict_types=1);

use Archon\UIKit\DataDisplay\Card;
use Archon\UIKit\Layout\Structure\Column;
use Archon\UIKit\Layout\Structure\Container;
use Archon\UIKit\Layout\Structure\Row;
use Archon\UIKit\Media\Audio;
use Archon\UIKit\Media\Video;

echo '<h2>Media Players</h2>';
echo '<p class="lead text-muted mb-4">HTML5 Video and Audio wrappers.</p>';

$snippet = function(string $code): string {
    return '<pre class="code-snippet m-0" style="max-height: 150px;"><code>' . htmlspecialchars($code) . '</code></pre>';
};

echo (new Container(
    new Row(
        // Video
        (new Column(
            (new Card(
                (new Video())
                    ->addSource('http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4', 'video/mp4')
                    ->dimensions('100%', 'auto') // Responsive width
                    ->poster('http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/images/BigBuckBunny.jpg')
            ))->header('Video Player')
              ->footer($snippet("new Video()->addSource(...)"))
        ))->md(6)->addClass('mb-4'),

        // Audio
        (new Column(
            (new Card(
                (new Audio())
                    ->addSource('http://codeskulptor-demos.commondatastorage.googleapis.com/GalaxyInvaders/theme_01.mp3', 'audio/mpeg')
            ))->header('Audio Player')
              ->footer($snippet("new Audio()->addSource(...)"))
        ))->md(6)->addClass('mb-4')
    )
))->fluid();