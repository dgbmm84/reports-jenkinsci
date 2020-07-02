<?php

namespace App\Framework\Controller;

use App\Data\Model\Entity\ReportEntity;
use App\Domain\UseCase\Report\Add\AddRequest;
use App\Domain\UseCase\Report\Add\AddService;
use App\Domain\UseCase\Report\Delete\DeleteRequest;
use App\Domain\UseCase\Report\Delete\DeleteService;
use App\Domain\UseCase\Report\ListContent\ListContentRequest;
use App\Domain\UseCase\Report\ListContent\ListContentService;
use App\Domain\UseCase\Report\Update\UpdateRequest;
use App\Domain\UseCase\Report\Update\UpdateService;
use App\Framework\Mapper\Report\AddRequestMapper;
use App\Framework\Mapper\Report\UpdateRequestMapper;
use App\Framework\Mapper\RequestMapper;
use App\Framework\Model\Report\AddReportRequest;
use App\Framework\Model\Report\UpdateReportRequest;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Domain\Exception\ValidationException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ReportController extends AbstractController
{

    /** @var SerializerInterface $serializer */
    private $serializer;

    /**
     * ReportController constructor.
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     */
    public function __construct(SerializerInterface $serializer, ValidatorInterface $validator)
    {
        /*
         * INFO
         * Servicio genérico para el controlador Report
         */
        $this->serializer = $serializer;
        $this->validatorInterface = $validator;
    }

    /**
     * @Route("/reports", name="addReport", methods={"POST"})
     * @param Request $request
     * @param AddService $addService
     * @return JsonResponse
     * @throws \UnexpectedValueException
     * @throws \LogicException
     * @throws ValidationException
     */
    public function addAction(
        Request $request,
        AddService $addService
    ): JsonResponse {

        /*
         * INFO
         * Mapper: Request se mapea a modelo de Framework
         * Validate: Valida modelo de Framework (Asserts)
         * Mapper: Modelo de Framework se mapea a modelo de UC de Entrada correspondiente
         * Service: Llamada a servicio de UC
         * Response: Respuesta de UC serializada a JSON
         */
        $addRequest = (new RequestMapper())->map(new AddReportRequest(), $request);

        $this->validateRequest($addRequest);

        $reportRequestCU = (new AddRequestMapper())->map(
            $addRequest,
            AddRequest::class
        );

        $response = $addService->add($reportRequestCU);

        return JsonResponse::fromJsonString($this->serializer->serialize($response->getModel(), 'json'));
    }

    /**
     * @Route("/reports/{id}", name="updateReport", methods={"PUT"}, requirements={"id" = "\d+"})
     * @param ReportEntity $report
     * @param Request $request
     * @param UpdateService $updateService
     * @return JsonResponse
     * @throws \UnexpectedValueException
     * @throws \LogicException
     * @throws ValidationException
     */
    public function updateAction(
        ReportEntity $report,
        Request $request,
        UpdateService $updateService
    ): JsonResponse {

        $updateRequest = (new RequestMapper())->map(new UpdateReportRequest(), $request);

        $this->validateRequest($updateRequest);

        $reportRequestCU = (new UpdateRequestMapper())->map(
            $updateRequest,
            UpdateRequest::class
        )->setId($report->getId());

        $response = $updateService->update($reportRequestCU);

        return JsonResponse::fromJsonString($this->serializer->serialize($response->getModel(), 'json'));
    }

    /**
     * @Route("/reports/{id}", name="deleteReport", methods={"DELETE"}, requirements={"id" = "\d+"})
     * @param ReportEntity $reportEntity
     * @param DeleteService $deleteService
     * @return JsonResponse
     */
    public function deleteAction(
        ReportEntity $reportEntity,
        DeleteService $deleteService
    ): JsonResponse {

        $reportRequestCU = (new DeleteRequest())->setId($reportEntity->getId());

        $deleteService->delete($reportRequestCU);

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/reports", methods={"GET"}, name="listReport")
     * @param ListContentService $listContentService
     * @param LoggerInterface $logger
     * @return JsonResponse
     */
    public function listContentAction(
        ListContentService $listContentService,
        LoggerInterface $logger
    ): JsonResponse {

        $response = $listContentService->listReport(new ListContentRequest());
        $logger->info('< listContentAction > Getting Reports');
        return JsonResponse::fromJsonString($this->serializer->serialize($response->getModels(), 'json'));
    }
}