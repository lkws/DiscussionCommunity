<?php
/**
 * Created by PhpStorm.
 * User: 大太阳
 * Date: 2019/2/23
 * Time: 15:00
 */

namespace App\Markdown;


class Markdown
{
    protected $parser;

    /**
     * Markdown constructor.
     * @param $parser
     */
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    public function markdown($text){
        $html = $this->parser->makeHtml($text);
        return $html;
    }


}