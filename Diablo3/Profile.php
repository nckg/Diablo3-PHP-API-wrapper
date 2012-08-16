<?php

/**
 * Description of Profile
 *
 * Created:		16-aug-2012
 *
 * @author		Nick Goris, $Author$
 * @version		SVN: $Id$
 * @package		Expression package is undefined on line 10, column 27 in Templates/Scripting/PHPClass.php.
 * @subpackage  Expression subpackage is undefined on line 11, column 19 in Templates/Scripting/PHPClass.php.
 *
 */
class Profile extends Diablo3
{

    /**
     * Returns a List of heroes
     *
     * @return string
     */
    public function getHeroes()
    {
        $url = "{$this->protocol}{$this->server}.{$this->host}/api/d3/profile/{$this->battlenetTag}/";
        $data = $this->getData($url);

        if ($data) {
            $heroes = array();
            $json = json_decode($data);

            foreach ($json->heroes as $hero) {
                $heroes[] = new Hero($this->battlenetTag, $hero->id, $hero);
            }

            return $heroes;
        }

        return FALSE;
    }

}

?>