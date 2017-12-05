<?php

namespace AppBundle\Twig;

class substrwsExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('substrws', array($this, 'substrws'))
        );
    }


    /**
     * Abstract of an HTML text: according to the NUMBER of CHARACTERES
     *
     * http://www.developpez.net/forums/d757484-8/php/langage/contribuez/discussion-reparer-code-html/
     *
     * @param $str
     * @param $len
     * @param string $separator
     * @return bool|string
     */
    function substrws($str, $len, $separator = '...')
    {
        if (is_numeric($len)) {
            $LongueurAvantSansHtml = strlen(trim(strip_tags($str)));
            $MasqueHtmlSplit = '#</?([a-zA-Z1-6]+)(?: +[a-zA-Z]+="[^"]*")*( ?/)?>#';
            $MasqueHtmlMatch = '#<(?:/([a-zA-Z1-6]+)|([a-zA-Z1-6]+)(?: +[a-zA-Z]+="[^"]*")*( ?/)?)>#';
            $str .= ' ';
            $BoutsTexte = preg_split($MasqueHtmlSplit, $str, -1, PREG_SPLIT_OFFSET_CAPTURE | PREG_SPLIT_NO_EMPTY);
            $NombreBouts = count($BoutsTexte);
            if ($NombreBouts == 1) {
                $str .= ' ';
                $LongueurAvant = strlen($str);
                $str = substr($str, 0, strpos($str, ' ', $LongueurAvant > $len ? $len : $LongueurAvant));
                if ($separator != '' && $LongueurAvant > $len) {
                    $str .= $separator;
                }
            } else {
                $longueur = 0;
                $indexDernierBout = $NombreBouts - 1;
                $position = $BoutsTexte[$indexDernierBout][1] + strlen($BoutsTexte[$indexDernierBout][0]) - 1;
                $indexBout = $indexDernierBout;
                $rechercheEspace = true;
                foreach ($BoutsTexte as $index => $bout) {
                    $longueur += strlen($bout[0]);
                    if ($longueur >= $len) {
                        $position_fin_bout = $bout[1] + strlen($bout[0]) - 1;
                        $position = $position_fin_bout - ($longueur - $len);
                        if (($positionEspace = strpos($bout[0], ' ', $position - $bout[1])) !== false) {
                            $position = $bout[1] + $positionEspace;
                            $rechercheEspace = false;
                        }
                        if ($index != $indexDernierBout)
                            $indexBout = $index + 1;
                        break;
                    }
                }
                if ($rechercheEspace === true) {
                    for ($i = $indexBout; $i <= $indexDernierBout; $i++) {
                        $position = $BoutsTexte[$i][1];
                        if (($positionEspace = strpos($BoutsTexte[$i][0], ' ')) !== false) {
                            $position += $positionEspace;
                            break;
                        }
                    }
                }
                $str = substr($str, 0, $position);
                preg_match_all($MasqueHtmlMatch, $str, $retour, PREG_OFFSET_CAPTURE);
                $BoutsTag = array();
                foreach ($retour[0] as $index => $tag) {
                    if (isset($retour[3][$index][0])) {
                        continue;
                    }
                    if ($retour[0][$index][0][1] != '/') {
                        array_unshift($BoutsTag, $retour[2][$index][0]);
                    } else {
                        array_shift($BoutsTag);
                    }
                }
                if (!empty($BoutsTag)) {
                    foreach ($BoutsTag as $tag) {
                        $str .= '</' . $tag . '>';
                    }
                }
                if ($separator != '' && $LongueurAvantSansHtml > $len) {
                    $str .= 'ReplacePointSuspension';
                    $pattern = '#((</[^>]*>[\n\t\r ]*)?(</[^>]*>[\n\t\r ]*)?((</[^>]*>)[\n\t\r ]*)?(</[^>]*>)[\n\t\r ]*ReplacePointSuspension)#i';
                    $str = preg_replace($pattern, $separator . '${2}${3}${5}', $str);
                }
            }
        }
        return $str;
    }
}