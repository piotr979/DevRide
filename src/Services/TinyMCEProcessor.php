<?php
namespace App\Services;

use Symfony\Component\Uid\Uuid;

/**
 * This class converts text created with TinyMCEProcessor
 */


class TinyMCEProcessor
{
    
    public static function convertToChapter($articleText)
    {
       
       $text = str_replace('&lt;chp&gt;', '<h3 id="' . Uuid::v4() . '" class="navigator-chapter">', $articleText);
       return str_replace('&lt;/chp&gt;', '</h3>', $text);
    }
}