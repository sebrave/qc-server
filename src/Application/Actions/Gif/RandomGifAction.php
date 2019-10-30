<?php
declare(strict_types=1);

namespace App\Application\Actions\Gif;

use Psr\Http\Message\ResponseInterface as Response;

class RandomGifAction extends GifAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
      $dummyData = [
        ["name" => "Dance", "filename" => "http://giphygifs.s3.amazonaws.com/media/9d1Fo0XyIYXzW/giphy.gif"],
        ["name" => "Run", "filename" => "http://giphygifs.s3.amazonaws.com/media/6U4jNDUtFkVOM/giphy.gif"],
        ["name" => "Sing", "filename" => "https://media.giphy.com/media/3oKHWB1uZCZXutcFH2/giphy.gif"]
      ];

      $gif = $dummyData[array_rand($dummyData, 1)];

      $data = [
        "data" => [
          "gif" => [
            "title" => $gif['name'],
            "url" => $gif['filename']
          ]
        ]
      ];

        $result = json_encode($data);

        return $this->respondWithData($result);
    }
}
