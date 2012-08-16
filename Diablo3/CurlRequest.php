<?php

/**
 * Description of HttpRequest
 *
 * Created:		16-nov-2011
 *
 * @author		Nick Goris, $Author$
 * @version		SVN: $Id$
 * @package		Libary
 *
 */

/**
 *
 */
interface HttpRequest
{

    public function setOption($name, $value);

    public function execute();

    public function getInfo($name);

    public function close();
}

/**
 * CurlRequest is a class that abstracts the usage of cURL functions.
 *
 */
class CurlRequest implements HttpRequest
{

    /**
     *
     * @var resource
     */
    private $_handle = NULL;

    /**
     * Default constructor
     *
     * @param string $url
     */
    public function __construct($url)
    {
        $this->_handle = curl_init($url);
    }

    /**
     * Set a curl option
     * @param string $name
     * @param string $value
     */
    public function setOption($name, $value)
    {
        curl_setopt($this->_handle, $name, $value);
    }

    /**
     * Perform a cURL session
     * @param resource $ch
     * @return mixed Returns true on success or false on failure. However,
     * if the CURLOPT_RETURNTRANSFER option is set, it will return the
     * result on success, false on failure.
     */
    public function execute()
    {
        $result = curl_exec($this->_handle);
        return $result;
    }

    /**
     * Get information regarding a specific transfer
     * @link http://php.net/manual/en/function.curl-getinfo.php
     * @param resource $ch
     * @param int $opt [optional] <p>
     * This may be one of the following constants:
     * CURLINFO_EFFECTIVE_URL - Last effective URL
     * @return mixed If opt is given, returns its value as a string.
     * Otherwise, returns an associative array with the following elements
     * (which correspond to opt):
     * "url"
     * "content_type"
     * "http_code"
     * "header_size"
     * "request_size"
     * "filetime"
     * "ssl_verify_result"
     * "redirect_count"
     * "total_time"
     * "namelookup_time"
     * "connect_time"
     * "pretransfer_time"
     * "size_upload"
     * "size_download"
     * "speed_download"
     * "speed_upload"
     * "download_content_length"
     * "upload_content_length"
     * "starttransfer_time"
     * "redirect_time"
     */
    public function getInfo($name)
    {
        return curl_getinfo($this->_handle, $name);
    }

    /**
     * Close a cURL session
     * @param resource $ch
     * @return void
     */
    public function close()
    {
        curl_close($this->_handle);
    }

}
