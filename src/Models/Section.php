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

    public function __construct(private readonly string $type, private readonly array $entries) {}

    public function getType(): string
    {
        return $this->type;
    }

    public function getEntries(): array
    {
        return $this->entries;
    }
}
