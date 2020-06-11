<?php


namespace JM\ASCII;

class Settings
{
    /**
     * @var array
     */
    private $fields = [];

    /**
     * CertInfo constructor.
     *
     * @param array $fields
     */
    public function __construct($fields = [])
    {
        $this->fields = [
          'target_width' => '',
          'target_height' => '',
          'source_file' => '',
        ];

        if (is_array($fields) == true) {
            $this->fields = array_merge($this->fields, $fields);
        }
    }

    /**
     * Return a setting value.
     *
     * @param string $name The name of the key to return.
     *
     * @return mixed
     */
    public function __get($name)
    {
        if (isset($this->fields[$name]) == true) {
            return $this->fields[$name];
        }

        return null;
    }

    /**
     * Set a setting value.
     *
     * @param string $name  The name of the key to set.
     * @param mixed  $value The value to set it to.
     *
     * @return mixed
     */
    public function __set($name, $value)
    {
        $this->fields[$name] = $value;
    }

    /**
     * Return the instance as an array.
     *
     * @return array
     */
    public function __debugInfo()
    {
        return $this->fields;
    }
}