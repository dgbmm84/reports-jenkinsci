<?php

namespace App\Domain\Repository;


use App\Domain\UseCase\Report\Add\AddRequest;
use App\Domain\UseCase\Report\Add\AddResponse;
use App\Domain\UseCase\Report\Delete\DeleteRequest;
use App\Domain\UseCase\Report\Delete\DeleteResponse;
use App\Domain\UseCase\Report\ListContent\ListContentRequest;
use App\Domain\UseCase\Report\ListContent\ListContentResponse;
use App\Domain\UseCase\Report\Update\UpdateRequest;
use App\Domain\UseCase\Report\Update\UpdateResponse;

interface ReportRepositoryInterface
{

    /**
     * @param AddRequest $addRequest
     * @return AddResponse
     */
    public function add(AddRequest $addRequest): AddResponse;

    /**
     * @param DeleteRequest $deleteRequest
     * @return DeleteResponse
     */
    public function delete(DeleteRequest $deleteRequest): DeleteResponse;

    /**
     * @param UpdateRequest $updateRequest
     * @return UpdateResponse
     */
    public function update(UpdateRequest $updateRequest): UpdateResponse;

    /**
     * @param ListContentRequest $listContentRequest
     * @return ListContentResponse
     */
    public function listReport(ListContentRequest $listContentRequest): ListContentResponse;

}