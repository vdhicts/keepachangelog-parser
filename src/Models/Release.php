<?php

namespace Vdhicts\KeepAChangelog\Models;

use DateTimeInterface;
use Illuminate\Support\Collection;

class Release
{
    public const UNRELEASED = 'Unreleased';

    private Collection $sections;

    public function __construct(
        private string $version,
        private ?DateTimeInterface $releasedAt = null,
        private ?string $tagReference = null
    ) {
        $this->sections = collect();
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function getReleasedAt(): ?DateTimeInterface
    {
        return $this->releasedAt;
    }

    public function getTagReference(): ?string
    {
        return $this->tagReference;
    }

    public function setTagReference(?string $tagReference): void
    {
        $this->tagReference = $tagReference;
    }

    public function getSections(): Collection
    {
        return $this->sections;
    }

    public function getSection(string $type): ?Section
    {
        return $this
            ->sections
            ->get($type);
    }

    public function setSection(Section $section): self
    {
        $this
            ->sections
            ->put($section->getType(), $section);
        return $this;
    }

    public function isUnreleased(): bool
    {
        return $this->version === self::UNRELEASED;
    }
}
