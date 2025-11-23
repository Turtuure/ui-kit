<?php

declare(strict_types=1);

namespace Archon\UIKit\Media;

use Archon\UIKit\Component;

/**
 * Represents an HTML5 Audio player.
 */
class Audio extends Component
{
    private array $sources = []; // Array of ['src' => string, 'type' => string]
    private string $fallbackText = 'Your browser does not support the audio element.';

    public function __construct()
    {
        $this->controls(); // Default to showing controls
    }

    /**
     * Add an audio source.
     */
    public function addSource(string $src, string $type): static
    {
        $this->sources[] = compact('src', 'type');
        return $this;
    }

    /**
     * Show audio controls.
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
     * Autoplay the audio.
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
     * Loop the audio.
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
     * Mute the audio.
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

        return sprintf('<audio%s>%s%s</audio>', $attributes, $sourcesHtml, $this->fallbackText);
    }
}
