<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\IotSoil;
use App\Repository\IotSoilRepository;

class IndexController extends AbstractController
{
    /**
     * @Route("/api/1.0/soil", name="api-post-soil")
     */
    public function index(Request $request)
    {
        $data = json_decode($request->getContent());

        if ($data && isset($data->chipid)) {
            $iotSoil = new IotSoil();
            $iotSoil->setChipid($data->chipid);
            $iotSoil->setFreeMemory($data->free_memory ?? null);
            $iotSoil->setSoilHumidityRaw($data->soil_humidity ?? null);
            $iotSoil->setTemperature($data->temperature ?? null);
            $iotSoil->setHumidity($data->humidity ?? null);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($iotSoil);
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
     * @Route("/api/1.0/iot-data", name="api-get-iot-data")
     */
    public function iotData(Request $request, SerializerInterface $serializer, IotSoilRepository $repository)
    {
        return JsonResponse::fromJsonString($serializer->serialize([
            'data' => $repository->findByChipId('a4cf126dc3a0'),
        ], 'json'));
    }
}
