<?php

namespace Helper;

/**
 * Class Template
 *
 * @package Helper
 */
class Template
{
    /**
     * @var string
     */
    private $templatePath;

    /**
     * @var array
     */
    private $templateData;

    /**
     * Template constructor.
     *
     * @param string $templatePath
     * @param array  $templateData
     *
     * @throws \Exception
     */
    public function __construct($templatePath, array $templateData = [])
    {
        if (!is_file($templatePath)) {
            throw new \Exception('template ' . addslashes($templatePath) . ' not found');
        }

        $this->templatePath = $templatePath;
        $this->templateData = [];

        foreach ($templateData as $key => $datum) {
            $this->templateData[$key] = htmlspecialchars($datum);
        }
    }

    /**
     * Return the html generated
     * @return string
     */
    public function display()
    {
        $vars = $this->templateData;
        ob_start();
        /** @noinspection PhpIncludeInspection */
        include_once $this->templatePath;
        $templateContent = ob_get_clean();

        return $templateContent;
    }
}
