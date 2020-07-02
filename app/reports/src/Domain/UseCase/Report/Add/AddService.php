<?php

namespace App\Domain\UseCase\Report\Add;


use App\Domain\Repository\ReportRepositoryInterface;
use Psr\Log\LoggerInterface;

class AddService
{

    /** @var ReportRepositoryInterface */
    protected $reportRepository;

    /** @var LoggerInterface  */
    protected $logger;

    /**
     * AddService constructor.
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
     * @param AddRequest $addRequest
     * @return AddResponse
     */
    public function add(AddRequest $addRequest): AddResponse
    {
        /*
         * INFO
         * Modelo de Lógica de negocio de UC
         */
        return $this->reportRepository->add($addRequest);
    }
}
