<?php

namespace Vdhicts\KeepAChangelog\Models;

use Illuminate\Support\Collection;

class Changelog
{
    public function __construct(private Collection $releases, private array $description = [])
    {
    }

    public function getReleases(): Collection
    {
        return $this->releases;
    }

    public function hasReleases(): bool
    {
        return $this
            ->releases
            ->isNotEmpty();
    }

    public function getUnreleased(): ?Release
    {
        return $this
            ->releases
            ->filter(function (Release $release) {
                return $release->isUnreleased();
            })
            ->first();
    }

    public function getLatestRelease(): Release
    {
        return $this
            ->releases
            ->first();
    }

    public function getDescription(): array
    {
        return $this->description;
    }
}
