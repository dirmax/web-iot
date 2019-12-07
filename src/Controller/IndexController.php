<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\IotSoil;

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
}
