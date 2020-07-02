<?php

namespace App\Domain\UseCase\Report\ListContent;


use App\Domain\Repository\ReportRepositoryInterface;
use Psr\Log\LoggerInterface;

class ListContentService
{

    /** @var ReportRepositoryInterface  */
    protected $reportRepository;

    /** @var LoggerInterface  */
    protected $logger;

    /**
     * ListContentService constructor.
     * @param ReportRepositoryInterface $reportRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        ReportRepositoryInterface $reportRepository,
        LoggerInterface $logger
    ) {
        $this->reportRepository = $reportRepository;
        $this->logger = $logger;
    }

    /**
     * @param ListContentRequest $listContentRequest
     * @return ListContentResponse
     */
    public function listReport(ListContentRequest $listContentRequest): ListContentResponse
    {
        return $this->reportRepository->listReport($listContentRequest);
    }
}
