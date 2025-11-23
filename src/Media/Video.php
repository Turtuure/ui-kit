<?php

declare(strict_types=1);

namespace Archon\UIKit\Media;

use Archon\UIKit\Component;

/**
 * Represents an HTML5 Video player.
 */
class Video extends Component
{
    private array $sources = []; // Array of ['src' => string, 'type' => string]
    private string $fallbackText = 'Your browser does not support the video tag.';

    public function __construct()
    {
        $this->addClass('ratio ratio-16x9'); // Bootstrap responsive ratio helper by default, though might need to be optional
        // Actually, Bootstrap ratio class should go on a wrapper div if used. 
        // Let's stick to standard video attributes first and allow class customization.
        // I'll remove the default ratio class from the video tag itself, as it usually goes on a parent.
        $this->removeClass('ratio'); 
        $this->removeClass('ratio-16x9');
        
        $this->controls(); // Default to showing controls
    }

    /**
     * Add a video source.
     */
    public function addSource(string $src, string $type): static
    {
        $this->sources[] = compact('src', 'type');
        return $this;
    }

    /**
     * Show video controls.
     */
    public function controls(bool $controls = true): static
    {
        if ($controls) {
            $this->setAttribute('controls', 'controls');
        } else {
            unset($this->attributes['controls']);
        }
        return $this;
    }

    /**
     * Autoplay the video.
     */
    public function autoplay(bool $autoplay = true): static
    {
        if ($autoplay) {
            $this->setAttribute('autoplay', 'autoplay');
        } else {
            unset($this->attributes['autoplay']);
        }
        return $this;
    }

    /**
     * Loop the video.
     */
    public function loop(bool $loop = true): static
    {
        if ($loop) {
            $this->setAttribute('loop', 'loop');
        } else {
            unset($this->attributes['loop']);
        }
        return $this;
    }

    /**
     * Mute the video.
     */
    public function muted(bool $muted = true): static
    {
        if ($muted) {
            $this->setAttribute('muted', 'muted');
        } else {
            unset($this->attributes['muted']);
        }
        return $this;
    }

    /**
     * Set poster image.
     */
    public function poster(string $src): static
    {
        $this->setAttribute('poster', $src);
        return $this;
    }

    /**
     * Set width and height.
     */
    public function dimensions(string|int $width, string|int $height): static
    {
        $this->setAttribute('width', (string)$width);
        $this->setAttribute('height', (string)$height);
        return $this;
    }

    public function render(): string
    {
        $attributes = $this->buildAttributes();
        $sourcesHtml = '';

        foreach ($this->sources as $source) {
            $sourcesHtml .= sprintf(
                '<source src="%s" type="%s">',
                htmlspecialchars($source['src'], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($source['type'], ENT_QUOTES, 'UTF-8')
            );
        }

        return sprintf('<video%s>%s%s</video>', $attributes, $sourcesHtml, $this->fallbackText);
    }
}
