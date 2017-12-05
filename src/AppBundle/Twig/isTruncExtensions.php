<?php


namespace AppBundle\Twig;


class isTruncExtensions extends \Twig_Extension
{
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('istrunc', array($this, 'isTrunc'))
        );
    }

    public function isTrunc($str, $len)
    {
        $str = strip_tags($str);
        return strlen($str) > $len;
    }
}