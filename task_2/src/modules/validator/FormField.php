<?php


class FormField {
    private $value;
    private $error;

    public function __construct($value = null, $error = null){
        $this->value = $value;
        $this->error = $error;
    }

    /**
     * @return null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param null $value
     */
    public function setValue($value)
    {
        if (is_array($value)) {
            $this->value = $value;
        } elseif (preg_match('/^\d\d\/\d\d\/\d\d\d\d$/', $value)) {
            $this->value = $this->datepicker('Y-m-d', $value);
        }
        else {
            $this->value = strip_tags(trim($value));
        }
    }

    /**
     * @return null
     */
    public function getError()
    {
        return Utils::trans($this->error);
    }

    /**
     * @param null $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }

    public function datepicker($format, $date) {
    if(trim($date))
        return date("$format",strtotime(str_replace('/','-',$date)));

    return false;
}

}