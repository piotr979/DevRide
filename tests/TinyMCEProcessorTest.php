<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Services\TinyMCEProcessor;

class TinyMCEProcessorTest extends TestCase
{
    private string $text = 
        '<chapter>First chapter</chapter>
    <p> Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem
    aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
    Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni
    dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor
    <chapter>This is another chapter</chapter>';
    public function testTinyMCEProcessor(): void
    {
        $processor = new TinyMCEProcessor();
        printf($processor->convertToChapter($this->text));
    }

}
