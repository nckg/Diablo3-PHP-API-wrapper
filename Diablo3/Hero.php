<?php

/**
 * Description of Hero
 *
 * Created:		16-aug-2012
 *
 * @author		Nick Goris, $Author$
 * @version		SVN: $Id$
 * @package		Expression package is undefined on line 10, column 27 in Templates/Scripting/PHPClass.php.
 * @subpackage  Expression subpackage is undefined on line 11, column 19 in Templates/Scripting/PHPClass.php.
 *
 */
class Hero extends Diablo3
{

    private $id;

    /**
     * Constructor for a Hero
     *
     * @param   string                      $battlenetTag
     * @param   integer                     $id
     * @param   array                       $info
     * @throws  InvalidArgumentException
     * @return  void
     */
    public function __construct($battlenetTag, $id, $info = array())
    {
        parent::__construct($battlenetTag);

        if ($id == '') {
            throw new InvalidArgumentException('Id cannot be empty');
        } else {
            $this->id = $id;

            if (!empty($info)) {
                foreach ($info as $key => $value) {
                    $this->$key = $value;
                }
            }
        }
    }

    /**
     * Returns information about the Hero
     * 
     * @return array
     * @throws Exception
     */
    public function getInfo()
    {
        // get data from api
        $url = "{$this->protocol}{$this->server}.{$this->host}/api/d3/profile/{$this->battlenetTag}/hero/{$this->id}";
        $data = $this->getData($url);

        if ($this->request->getInfo(CURLINFO_HTTP_CODE) === 200) {
            $json = json_decode($data);

            foreach ($json as $key => $value) {
                $this->$key = $value;
            }

            return $json;
        } else {
            throw new Exception("Server answered with code: {$this->request->getInfo(CURLINFO_HTTP_CODE)}");
        }
    }

}
