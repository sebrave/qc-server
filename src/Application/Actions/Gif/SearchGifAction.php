<?php
declare(strict_types=1);

namespace App\Application\Actions\Gif;

use Psr\Http\Message\ResponseInterface as Response;

class SearchGifAction extends GifAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $params = $this->request->getQueryParams();

        $dummyData = [
          ["name" => "Dance", "filename" => "http://giphygifs.s3.amazonaws.com/media/9d1Fo0XyIYXzW/giphy.gif"],
          ["name" => "Run", "filename" => "http://giphygifs.s3.amazonaws.com/media/6U4jNDUtFkVOM/giphy.gif"],
          ["name" => "Sing", "filename" => "https://media.giphy.com/media/3oKHWB1uZCZXutcFH2/giphy.gif"]
        ];

        if (isset($params['value']) && $params['value']) {
          // use a fuzzy match to select our gif
          $bestMatchId = 0;
          $bestMatchValue = 0;
          foreach ($dummyData as $key => $gif) {
            $similarity = similar_text(
              strtolower($gif['name']),
              strtolower($params['value'])
            );
            if ($similarity > $bestMatchValue) {
              $bestMatchValue = $similarity;
              $bestMatchId = $key;
            }
          }
          $id = $bestMatchId;

        } else {
          $id = array_rand($dummyData, 1);
        }

        $gif = $dummyData[$id];

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
