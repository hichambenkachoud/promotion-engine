<?php

namespace App\Controller;

use App\DTO\LowestPriceDto;
use App\Service\Serializer\DtoSerializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private DtoSerializer $serializer;

    public function __construct(DtoSerializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @Route(path="/products/{id}/lowest-price", name="lawest_price", methods={"POST"})
     */
    public function lowestPrice(Request $request, int $id): Response
    {

        /** @var LowestPriceDto $lowestPriceDto */
        $lowestPriceDto = $this->serializer->deserialize(
            $request->getContent(),
            LowestPriceDto::class
        );

        $lowestPriceDto->setPrice(100);
        $lowestPriceDto->setDiscountPrice(50);
        $lowestPriceDto->setPromotionId(1);
        $lowestPriceDto->setPromotionName('Black friday half price sale');

        $responseContent = $this->serializer->serialize($lowestPriceDto);

        return new Response(
            $responseContent,
            200,
            ['Content-type' => 'application/json']
        );
    }


    /**
     * @Route(path="/products/{id}/promotions", name="promotions", methods={"GET"})
     */
    public function promotions(int $id): Response
    {
        return new JsonResponse('ok');
    }
}