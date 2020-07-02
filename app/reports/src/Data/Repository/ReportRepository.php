<?php

namespace App\Data\Repository;


use App\Data\Database\ReportDatabase;
use App\Data\Mapper\ReportMapper;
use App\Data\Model\Entity\ReportEntity;
use App\Domain\Model\Report;
use App\Domain\Repository\ReportRepositoryInterface;
use App\Domain\UseCase\Report\Add\AddRequest;
use App\Domain\UseCase\Report\Add\AddResponse;
use App\Domain\UseCase\Report\Add\Model\UCCreateModel;
use App\Domain\UseCase\Report\Delete\DeleteRequest;
use App\Domain\UseCase\Report\Delete\DeleteResponse;
use App\Domain\UseCase\Report\ListContent\ListContentRequest;
use App\Domain\UseCase\Report\ListContent\ListContentResponse;
use App\Domain\UseCase\Report\ListContent\Model\UCListModel;
use App\Domain\UseCase\Report\Update\Model\UCUpdateModel;
use App\Domain\UseCase\Report\Update\UpdateRequest;
use App\Domain\UseCase\Report\Update\UpdateResponse;
use Doctrine\ORM\EntityNotFoundException;

class ReportRepository implements ReportRepositoryInterface
{

    /** @var ReportDatabase $reportDatabase */
    private $reportDatabase;

    /**
     * ReportRepository constructor.
     * @param ReportDatabase $database
     */
    public function __construct(
        ReportDatabase $database
    ) {
        $this->reportDatabase = $database;
    }


    /**
     * @param AddRequest $addRequest
     * @return AddResponse
     * @throws \Exception
     */
    public function add(AddRequest $addRequest): AddResponse
    {
        /*
         * INFO
         * Capa Data
         * Tratamiento/lógica Data
         * Mapper: Repository -> Modelo de Dominio
         * Mapper: Modelo de dominio -> Respuesta UC
         */
        $reportEntity = new ReportEntity();
        $reportEntity->setTitle($addRequest->getTitle())
            ->setContent($addRequest->getContent())
            ->setMail($addRequest->getMail())
            ->setMetadata($addRequest->getMetadata());
        $reportEntity = $this->reportDatabase->add($reportEntity);

        return (new AddResponse())->setModel(
            (new ReportMapper())->map($reportEntity, UCCreateModel::class)
        );
    }

    /**
     * @param DeleteRequest $deleteRequest
     * @return DeleteResponse
     * @throws \Exception|EntityNotFoundException
     */
    public function delete(DeleteRequest $deleteRequest): DeleteResponse
    {

        /** @var ReportEntity $reportEntity */
        if (!$reportEntity = $this->reportDatabase->find($deleteRequest->getId())) {
            throw new EntityNotFoundException(sprintf('%d', $deleteRequest->getId()));
        }
        $this->reportDatabase->delete($reportEntity);

        return new DeleteResponse();
    }

    /**
     * @param UpdateRequest $updateRequest
     * @return UpdateResponse
     * @throws EntityNotFoundException
     * @throws \Exception
     */
    public function update(UpdateRequest $updateRequest): UpdateResponse
    {

        /** @var ReportEntity $updateEntity */
        if (!$updateEntity = $this->reportDatabase->find($updateRequest->getId())) {
            throw new EntityNotFoundException(sprintf('%d', $updateRequest->getId()));
        }
        if ($updateRequest->getTitle()) {
            $updateEntity->setTitle($updateRequest->getTitle());
        }
        if ($updateRequest->getContent()) {
            $updateEntity->setContent($updateRequest->getContent());
        }
        if ($updateRequest->getMail()) {
            $updateEntity->setMail($updateRequest->getMail());
        }
        if ($updateRequest->getMetadata()) {
            $updateEntity->setMetadata($updateRequest->getMetadata());
        }
        $updateEntity = $this->reportDatabase->update($updateEntity);

        return (new UpdateResponse())->setModel(
            (new ReportMapper())->map($updateEntity, UCUpdateModel::class)
        )->setEntireModel(
            (new ReportMapper())->map($updateEntity, Report::class)
        );
    }

    /**
     * @param ListContentRequest $listContentRequest
     * @return ListContentResponse
     */
    public function listReport(ListContentRequest $listContentRequest): ListContentResponse
    {
        $reports = $this->reportDatabase->findAll();
        /** @var array|Report $response */
        $response = [];
        foreach ($reports as $reportEntity) {
            /** @var ReportEntity $reportEntity */
            $response[] = (new UCListModel())->setModel(
                (new ReportMapper())->map($reportEntity, Report::class)
            )->getModel();
        }

        return (new ListContentResponse())->setModels($response);
    }
}