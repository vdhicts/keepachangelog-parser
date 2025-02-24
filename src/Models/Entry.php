<?php

namespace Vdhicts\KeepAChangelog\Models;

class Entry
{
    public function __construct(
        private readonly string $html,
        private readonly string $plain,
    ) {}

    public function toString(): string
    {
        return $this->plain;
    }

    public function toHtml(): string
    {
        return $this->html;
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
