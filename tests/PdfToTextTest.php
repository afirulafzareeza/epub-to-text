<?php

namespace jove4015\EpubToText\Test;

use PHPUnit\Framework\TestCase;
use jove4015\EpubToText\Exceptions\CouldNotExtractText;
use jove4015\EpubToText\Exceptions\EpubNotFound;
use jove4015\EpubToText\Epub;

#TODO - add in proper test files for epub

class EpubToTextTest extends TestCase
{
    protected $dummyEpub = __DIR__.'/testfiles/dummy.Epub';
    protected $dummyEpubText = 'This is a dummy Epub';

    /** @test */
    public function it_can_extract_text_from_a_Epub()
    {
        $text = (new Epub())
            ->setEpub($this->dummyEpub)
            ->text();

        $this->assertSame($this->dummyEpubText, $text);
    }

    /** @test */
    public function it_provides_a_static_method_to_extract_text()
    {
        $this->assertSame($this->dummyEpubText, Epub::getText($this->dummyEpub));
    }

    /** @test */
    public function it_can_hande_paths_with_spaces()
    {
        $EpubPath = __DIR__.'/testfiles/dummy with spaces in its name.Epub';

        $this->assertSame($this->dummyEpubText, Epub::getText($EpubPath));
    }

    /** @test */
    public function it_can_hande_paths_with_single_quotes()
    {
        $EpubPath = __DIR__.'/testfiles/dummy\'s_file.Epub';

        $this->assertSame($this->dummyEpubText, Epub::getText($EpubPath));
    }

    /** @test */
    public function it_will_throw_an_exception_when_the_Epub_is_not_found()
    {
        $this->expectException(EpubNotFound::class);

        (new Epub())
            ->setEpub('/no/Epub/here/dummy.Epub')
            ->text();
    }

    /** @test */
    public function it_will_throw_an_exception_when_the_binary_is_not_found()
    {
        $this->expectException(CouldNotExtractText::class);

        (new Epub('/there/is/no/place/like/home/Epubtotext'))
            ->setEpub($this->dummyEpub)
            ->text();
    }
}
