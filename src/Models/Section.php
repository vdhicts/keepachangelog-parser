<?php

namespace Vdhicts\KeepAChangelog\Models;

class Section
{
    public const ADDED = 'Added';
    public const CHANGED = 'Changed';
    public const FIXED = 'Fixed';
    public const DEPRECATED = 'Deprecated';
    public const REMOVED = 'Removed';
    public const SECURITY = 'Security';

    private string $type;
    private array $entries;

    public function __construct(string $type, array $entries)
    {
        $this->type = $type;
        $this->entries = $entries;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getEntries(): array
    {
        return $this->entries;
    }
}
