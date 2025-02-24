<?php

namespace Vdhicts\KeepAChangelog\Tests\Unit;

use DateTimeInterface;
use PHPUnit\Framework\TestCase;
use Vdhicts\KeepAChangelog\Models\Changelog;
use Vdhicts\KeepAChangelog\Models\Entry;
use Vdhicts\KeepAChangelog\Models\Release;
use Vdhicts\KeepAChangelog\Models\Section;
use Vdhicts\KeepAChangelog\Parser;

class ParserTest extends TestCase
{
    private Changelog $changelog;

    protected function setUp(): void
    {
        $changelogContent = file_get_contents(__DIR__.'/../resources/ExampleChangelog.md');

        $parser = new Parser();
        $this->changelog = $parser->parse($changelogContent);
    }

    public function test_changelog()
    {
        $this->assertTrue($this->changelog->hasReleases());
        $this->assertIsArray($this->changelog->getDescription());
        $this->assertCount(2, $this->changelog->getDescription());
        $this->assertCount(13, $this->changelog->getReleases());
        $this->assertInstanceOf(Release::class, $this->changelog->getLatestRelease());
        $this->assertInstanceOf(Release::class, $this->changelog->getUnreleased());
        $this->assertNotNull($this->changelog->getLatestRelease()->getTagReference());
    }

    public function test_unreleased()
    {
        $unreleased = $this
            ->changelog
            ->getUnreleased();

        $this->assertSame(Release::UNRELEASED, $unreleased->getVersion());
        $this->assertNull($unreleased->getReleasedAt());
        $this->assertCount(0, $unreleased->getSections());
        $this->assertNull($unreleased->getSection(Section::ADDED));
        $this->assertNotNull($this->changelog->getLatestRelease()->getTagReference());
    }

    public function test_release()
    {
        $release = $this
            ->changelog
            ->getLatestRelease();

        $this->assertSame('1.0.0', $release->getVersion());
        $this->assertFalse($release->isUnreleased());
        $this->assertInstanceOf(DateTimeInterface::class, $release->getReleasedAt());
        $this->assertSame('2017-06-20', $release->getReleasedAt()->format('Y-m-d'));
        $this->assertCount(3, $release->getSections());
        $this->assertInstanceOf(Section::class, $release->getSection(Section::ADDED));
        $this->assertNull($release->getSection(Section::DEPRECATED));
        $this->assertNotNull($release->getTagReference());
    }

    public function test_section()
    {
        $section = $this
            ->changelog
            ->getLatestRelease()
            ->getSection(Section::ADDED);

        $this->assertSame(Section::ADDED, $section->getType());
        $this->assertIsArray($section->getEntries());
        $this->assertCount(23, $section->getEntries());
    }

    public function test_entry()
    {
        $entries = $this
            ->changelog
            ->getLatestRelease()
            ->getSection(Section::ADDED)
            ->getEntries();

        $entry = $entries[0];

        $this->assertInstanceOf(Entry::class, $entry);
        $this->assertSame('New visual identity by <a href="https://github.com/tylerfortune8">@tylerfortune8</a>.', $entry->toHtml());
        $this->assertSame('New visual identity by @tylerfortune8.', $entry->toString());
        $this->assertSame('New visual identity by @tylerfortune8.', (string) $entry);
    }
}
