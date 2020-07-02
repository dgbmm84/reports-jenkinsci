<?php

namespace App\Domain\UseCase\Report\Update;


use App\Domain\Model\Mail;
use App\Domain\Repository\ReportRepositoryInterface;
use App\Domain\Services\Mailer;
use Psr\Log\LoggerInterface;

class UpdateService
{

    protected $reportRepository;
    protected $logger;
    /** @var Mailer $mailer */
    protected $mailer;

    public function __construct(
        ReportRepositoryInterface $reportRepository,
        LoggerInterface $logger,
        Mailer $mailer
    ) {
        $this->reportRepository = $reportRepository;
        $this->logger = $logger;
        $this->mailer = $mailer;
    }

    /**
     * @param UpdateRequest $updateRequest
     * @return UpdateResponse
     */
    public function update(UpdateRequest $updateRequest): UpdateResponse
    {
        $response = $this->reportRepository->update($updateRequest);
        $this->mailer->sendMail(
            (new Mail())
                ->setSubject('Notification to send')
                ->setReceiver('t_report_1001@yopmail.com')
                ->setParameters(['report'=>$response->getEntireModel()])
                ->setTemplate('notification.html.twig')
        );
        return $response;

    }
}
