<?php

namespace Drupal\video_library\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Component\Serialization\Json;
use Symfony\Component\DependencyInjection\ContainerInterface;
use GuzzleHttp\ClientInterface;
use Drupal\node\Entity\Node;
use Drupal\Core\DateTime\DrupalDateTime;

 

class CustomAirtableController extends ControllerBase {

    protected $httpClient;
    public function __construct(ClientInterface $http_client) {
        $this->httpClient = $http_client;
    }
 

  public static function create(ContainerInterface $container) {

    return new static(

      $container->get('http_client')

    );

  }

  public function fetchDataFromAirtable() {

    $api_url = 'https://api.airtable.com/v0/appYs8zO2euY9axdz/tbltm4cQAW0ZQ0jA9';
    $headers = [

      'Authorization' => 'Bearer patti0WJTJtiQnIWC.b8d1ee3da7ab5eda08e807c0a9dce15271bfef621d19451a3a84c1a3688ce4ce',

    ];
    $response = $this->httpClient->request('GET', $api_url, [

      'headers' => $headers,

    ]);
    $data = json_decode($response->getBody());

 

    if (!empty($data->records)) {
        // kint($data->records); exit;

      foreach ($data->records as $record) {
        $input_date = $record->createdTime;
        $time = strtotime($input_date);
        $test_time = strtotime('03/10/2022 - 12:18');
        // $date = new DrupalDateTime($input_date);
        // kint($date);
        // $test = $date->createFromFormat($date);
        // kint($test);

        // $new_date = date_format($input_date,'long');
        // kint($new_date);

        $formatted_date = \Drupal::service('date.formatter')->format($time,'short');

        // kint($formatted_date);
       
       // var_dump($record); exit;
       /* if (!isset($record)) {
            echo "data is blank";
            exit;
            return;
        }*/
        // Map the API fields to your content type fields.

        $node = Node::create([

          'type' => 'videos', // Replace with your content type machine name.

          'title' => $record->fields->Name ?? '',
          'field_id' => $record->id ?? '',
          'field_language' => $record->fields->Language ?? '',
          'field_genre' => $record->fields->Genre ?? '',
          'field_casts' => $record->fields->Casts ?? '',
          'field_length' => $record->fields->Length ?? '',
          'field_createdtime' =>$test_time,

        

          // Add more field mappings here.

        ]);
        $node->save();

      }

    }
    return new JsonResponse(['message' => 'Data imported from Airtable']);

  }

 

}

