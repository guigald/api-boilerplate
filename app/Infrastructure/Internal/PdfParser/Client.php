<?php

declare(strict_types=1);

namespace App\Infrastructure\Internal\PdfParser;

use App\Base\Helpers\FileHelper;
use App\Infrastructure\External\Google\Vision\Client as Vision;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Smalot\PdfParser\Parser;

class Client
{
    public function __construct(private Vision $vision)
    {
    }

    /**
     * @param $path
     * @return array
     * @throws Exception
     */
    public function getFileContent($path): array
    {
        $filePath = Storage::disk(env('TEMPORARY_DRIVER'))->path($path);
        $pathParts = pathinfo($filePath);
        $fileInfo = getimagesize($filePath);

        if ($filePath) {
            $file = new UploadedFile(
                $filePath,
                $pathParts['basename'],
                data_get(
                    $fileInfo,
                    'mime',
                    FileHelper::getFileExtension($filePath)
                ),
                filesize($filePath),
                true
            );

            $pdfParser = new Parser();
            $pdf = $pdfParser->parseFile($file->path());
            $content = $pdf->getText();

            if (!empty($content)) {
                $content = $this->breakLines($content);
                $content = $this->breakIndexesBy($content, "\t");

                return $this->breakIndexesBy($content, " ");
            }

            $content = [];
            $images = $pdf->getObjectsByType('XObject', 'Image');

            foreach ($images as $image) {
                $result = $this->vision->getImageContent(
                    $image->getContent(),
                    'content'
                );

                $content = array_merge($content, $result);
            }

            return $content;
        }

        return [];
    }

    /**
     * @param string $content
     * @return array
     */
    private function breakLines(string $content): array
    {
        return explode("\n", $content);
    }

    /**
     * @param array $content
     * @param string $separator
     * @return array
     */
    private function breakIndexesBy(array $content, string $separator): array
    {
        $result = [];

        foreach ($content as $item) {
            $arrayContent = explode($separator, $item);
            foreach ($arrayContent as $contentItem) {
                $result[] = $contentItem;
            }
        }

        return $result;
    }
}
