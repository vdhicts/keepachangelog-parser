<?php

namespace Vdhicts\KeepAChangelog;

use Illuminate\Support\Carbon;
use League\CommonMark\CommonMarkConverter;
use Symfony\Component\DomCrawler\Crawler;
use Vdhicts\KeepAChangelog\Models\Changelog;
use Vdhicts\KeepAChangelog\Models\Entry;
use Vdhicts\KeepAChangelog\Models\Release;
use Vdhicts\KeepAChangelog\Models\Section;

class Parser
{
    private string $dateFormat = 'Y-m-d';

    private function getNodesText(Crawler $crawler): array
    {
        return $crawler->each(function ($node) {
            return $node->text();
        });
    }

    private function getChangelogHtml($markdown): string
    {
        return (new CommonMarkConverter())->convert($markdown);
    }

    private function parseRelease(Crawler $parsedRelease): Release
    {
        $releaseData = explode(' - ', $parsedRelease->text());

        $version = str_replace(['[', ']'], '', $releaseData[0]);
        $date = count($releaseData) >= 2
            ? Carbon::createFromFormat($this->dateFormat, $releaseData[1])
            : null;

        return new Release($version, $date);
    }

    private function parseSection(Crawler $parsedSection): Section
    {
        $lines = $parsedSection
            ->nextAll()
            ->first()
            ->children('li');

        return new Section(
            $parsedSection->text(),
            $this->parseEntries($lines)
        );
    }

    private function parseEntries(Crawler $lines)
    {
        return $lines->each(function ($node) {
            return new Entry($node->html(), $node->text());
        });
    }

    public function setDateFormat(string $dateFormat)
    {
        $this->dateFormat = $dateFormat;
    }

    public function parse(string $content): Changelog
    {
        $crawler = new Crawler($this->getChangelogHtml($content));

        $crawledReleases = $crawler->filter('h2');
        $releases = $crawledReleases->each(function (Crawler $crawledRelease) {
            $release = $this->parseRelease($crawledRelease);

            $releaseReference = $crawledRelease
                ->filter('a');
            if ($releaseReference->count()) {
                $release->setTagReference($releaseReference->attr('href'));
            }

            $crawledSections = $crawledRelease
                ->nextAll()
                ->filterXPath('h3[preceding-sibling::h2[1][.="'.$crawledRelease->text().'"]]');
            $crawledSections->each(function (Crawler $crawledSection) use ($release) {
                $release->setSection($this->parseSection($crawledSection));
            });

            return $release;
        });

        $releases = collect($releases)->sortByDesc(function (Release $release) {
            $releaseDate = $release->getReleasedAt();

            return is_null($releaseDate)
                ? -1
                : $releaseDate->getTimestamp();
        });

        return new Changelog($releases, $this->getNodesText($crawler->filter('h1 ~ p')));
    }
}
