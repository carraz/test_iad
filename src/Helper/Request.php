<?php
namespace Helper;

/**
 * Class Request
 *
 * @package Helper
 */
class Request
{
    const POST = "post";
    const GET  = "get";

    /**
     * @var array
     */
    private $get;
    /**
     * @var array
     */
    private $post;

    /**
     * Request constructor.
     *
     * @param array $get
     * @param array $post
     */
    public function __construct(array $get = [], array $post = [])
    {
        $this->get  = $this->secureRequestData($get);
        $this->post = $this->secureRequestData($post);
    }

    /**
     * Secures the get and post data to avoid injection
     * @param array $data
     *
     * @return array
     */
    private function secureRequestData(array $data)
    {
        $securedData = [];

        foreach ($data as $key => $datum) {
            $securedData[$key] = addslashes($datum);
        }
        return $securedData;
    }

    /**
     * @param string $key
     * @param string $dataAsked
     *
     * @return null
     */
    private function get($key, $dataAsked)
    {
        $requestData = $this->$dataAsked;
        return isset($requestData[$key]) ? $requestData[$key] : null;
    }

    /**
     * Returns a $_GET value
     * @param string $key
     *
     * @return string
     */
    public function getQuery($key)
    {
        return $this->get($key, self::GET);
    }

    /**
     * Returns a $_POST value
     * @param string $key
     *
     * @return string
     */
    public function getPost($key)
    {
        return $this->get($key, self::POST);
    }

    /**
     * Returns all post values
     * @return array
     */
    public function getAllPostData()
    {
        return $this->post;
    }

    /**
     * Returns all get values
     * @return array
     */
    public function getAllGetData()
    {
        return $this->get;
    }
}
