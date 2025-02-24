<?php

namespace Unit;

use PHPUnit\Framework\TestCase;
use Vdhicts\KeepAChangelog\Models\Changelog;
use Vdhicts\KeepAChangelog\Parser;

class ParserTestDateTimeFormatTest extends TestCase
{
    private Changelog $changelog;

    protected function setUp(): void
    {
        $changelogContent = file_get_contents(__DIR__.'/../resources/ExampleChangelogDateTimeFormat.md');

        $parser = new Parser();
        $parser->setDateFormat('Y-m-d H:i');
        $this->changelog = $parser->parse($changelogContent);
    }

    public function test_release()
    {
        $release = $this
            ->changelog
            ->getLatestRelease();

        $this->assertSame('1.0.0', $release->getVersion());
        $this->assertSame('2017-06-20 01:22', $release->getReleasedAt()->format('Y-m-d H:i'));
    }
}
