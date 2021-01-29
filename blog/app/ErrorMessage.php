<?php


namespace blog\app;


class ErrorMessage
{
    /**
     * @var string
     */
    private string $message;

    public function __construct($ErrorMessage)
    {
        $this->setMessage($ErrorMessage);
        return $this;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

}