<?php

declare(strict_types=1);

namespace App\Infrastructure\External\Google\Vision;

use GoogleCloudVision\GoogleCloudVision;
use GoogleCloudVision\Request\AnnotateImageRequest;

class Client
{
    /**
     * @param string $imageString
     * @param string $type
     * @return array
     */
    public function getImageContent(
        string $imageString,
        string $type = 'url'
    ): array {
        $image = "";

        if ($type === 'url') {
            $image = base64_encode(file_get_contents($imageString));
        }

        if ($type === 'content') {
            $image = base64_encode($imageString);
        }

        if ($image !== "") {
            $request = new AnnotateImageRequest();
            $request->setImage($image);
            $request->setFeature("TEXT_DETECTION");

            $gcvRequest = new GoogleCloudVision(
                [$request],
                env('GOOGLE_CLOUD_API_KEY')
            );

            $response = $gcvRequest->annotate();

            return data_get($response, 'responses.0.textAnnotations', []);
        }

        return [];
    }
}
