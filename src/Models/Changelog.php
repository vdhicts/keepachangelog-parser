<?php

namespace Vdhicts\KeepAChangelog\Models;

use Illuminate\Support\Collection;

class Changelog
{
    private Collection $releases;
    private array $description;

    public function __construct(Collection $releases, array $description = [])
    {
        $this->releases = $releases;
        $this->description = $description;
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
            ->last();
    }

    public function getDescription(): array
    {
        return $this->description;
    }
}
