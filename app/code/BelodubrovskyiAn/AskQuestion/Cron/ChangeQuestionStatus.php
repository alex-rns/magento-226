<?php
namespace BelodubrovskyiAn\AskQuestion\Cron;

class ChangeQuestionStatus
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;
    /**
     * Example constructor.
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    public function execute()
    {
        $this->logger->critical('Cron job is working!');
    }
}
