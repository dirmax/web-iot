<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\IotData;
use App\Repository\IotDataRepository;

class IndexController extends AbstractController
{
    /**
     * @Route("/api/1.0/iot-list-type", name="api-iot-list-type", methods={"GET"})
     */
     public function iotChipDataTypes(Request $request, SerializerInterface $serializer, IotDataRepository $repository)
     {
         $chipId = $request->get('chipid');

         return JsonResponse::fromJsonString($serializer->serialize([
             'data' => $repository->chipDataTypes($chipId),
         ], 'json'));
     }

    /**
     * @Route("/api/1.0/iot-data", name="api-post-iot-data", methods={"POST"})
     */
    public function iotDataSave(Request $request)
    {
        $json = json_decode($request->getContent());

        if (isset($json->data) && isset($json->chipid)) {

            foreach ($json->data as $item) {
                $iotData = new IotData();
                $iotData->setChipid($json->chipid);
                $iotData->setFreeMemory($json->free_memory ?? null);
                $iotData->setValue($item->value);
                $iotData->setValueType($item->type);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($iotData);
            }

            $entityManager->flush();

            return $this->json([
                'result' => '1',
                'result_message' => 'ok',
            ]);
        } else {
            return $this->json([
                'error' => '1',
                'error_message' => 'Invalid JSON format',
            ]);
        }
    }

    /**
     * @Route("/api/1.0/iot-data", name="api-get-iot-data", methods={"GET"})
     */
    public function iotDataRead(Request $request, SerializerInterface $serializer, IotDataRepository $repository)
    {
        $chipId = $request->get('chipid');
        $type = $request->get('type');
        $limit = max($request->get('limit', 100), 10000);

        return JsonResponse::fromJsonString($serializer->serialize([
            'data' => $repository->findByChipId($chipId, $type, $limit),
        ], 'json'));
    }
}
