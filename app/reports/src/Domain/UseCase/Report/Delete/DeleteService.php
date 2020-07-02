<?php

namespace App\Domain\UseCase\Report\Delete;


use App\Domain\Repository\ReportRepositoryInterface;
use Psr\Log\LoggerInterface;

class DeleteService
{

    protected $reportRepository;
    protected $logger;

    public function __construct(
        ReportRepositoryInterface $reportRepository,
        LoggerInterface $logger
    ) {
        $this->reportRepository = $reportRepository;
        $this->logger = $logger;
    }

    /**
     * @param DeleteRequest $deleteRequest
     * @return DeleteResponse
     */
    public function delete(DeleteRequest $deleteRequest): DeleteResponse
    {
        return $this->reportRepository->delete($deleteRequest);
    }
}
