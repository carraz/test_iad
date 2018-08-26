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
        $this->templateData = $this->secureTemplateData($templateData);
    }

    private function secureTemplateData(array $templateData)
    {
        $data = [];
        foreach ($templateData as $key => $datum) {
            if (is_array($datum)) {
                $data[$key] = $this->secureTemplateData($datum);
                continue;
            }
            $data[$key] = htmlspecialchars($datum);
        }

        return $data;
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
