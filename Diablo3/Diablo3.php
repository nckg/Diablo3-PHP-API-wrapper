<?php

/**
 * Diablo3 class to
 *
 * Created:		14-aug-2012
 *
 * @author		Nick Goris, $Author$
 * @version		SVN: $Id$
 * @package		Expression package is undefined on line 10, column 27 in Templates/Scripting/PHPClass.php.
 * @subpackage  Expression subpackage is undefined on line 11, column 19 in Templates/Scripting/PHPClass.php.
 *
 */
abstract class Diablo3
{

    /**
     *
     * @var string
     */
    protected $battlenetTag;

    /**
     *
     * @var string
     */
    protected $protocol = 'http://';

    /**
     *
     * @var string
     */
    protected $server = 'eu';

    /**
     *
     * @var string
     */
    protected $host = 'battle.net';

    /**
     *
     * @var string
     */
    protected $followerTypes = array('enchantress', 'templar', 'scoundrel');

    /**
     *
     * @var string
     */
    protected $artisanTypes = array('blacksmith', 'jeweler');

    protected $request;

    /**
     * Default constructor
     * @param string $battlenetTag
     * @throws Exception
     */
    public function __construct($battlenetTag)
    {
        if ($battlenetTag !== '') {
            $this->battlenetTag = (string) str_replace('#', '-', $battlenetTag);
        } else {
            throw new InvalidArgumentException('Battle.net tag is required');
        }
    }

    /**
     * Fetches data from the Blizzard Diablo 3 API
     *
     * @param string $url
     * @return mixed
     */
    protected function getData($url)
    {
        // set curl options
        $this->request = new CurlRequest($url);
        $this->request->setOption(CURLOPT_URL, $url);
        $this->request->setOption(CURLOPT_RETURNTRANSFER, true);
        $this->request->setOption(CURLOPT_CONNECTTIMEOUT, 5);
        $this->request->setOption(CURLOPT_TIMEOUT, 30);
        $this->request->setOption(CURLOPT_MAXREDIRS, 7);
        $this->request->setOption(CURLOPT_HEADER, false);

        return $this->request->execute();
    }


}
