<?php
 
namespace Drupal\video_library\Controller;
 
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Component\Serialization\Json;
use Symfony\Component\DependencyInjection\ContainerInterface;
use GuzzleHttp\ClientInterface;
use Drupal\node\Entity\Node;
use Drupal\Core\DateTime\DrupalDateTime;
use Drupal\core\Entity\EntityTypeManagerInterface;
 
 
 
class CustomAirtableController extends ControllerBase
{
 
    protected $httpClient;
    public function __construct(ClientInterface $http_client)
    {
        $this->httpClient = $http_client;
    }
 
 
    public static function create(ContainerInterface $container)
    {
 
        return new static(
            $container->get('http_client')
        );
 
    }
 
    public function fetchDataFromAirtable()
    {
 
        $api_url = 'https://api.airtable.com/v0/appYs8zO2euY9axdz/tbltm4cQAW0ZQ0jA9';
        $headers = [
        'Authorization' => 'Bearer
        patti0WJTJtiQnIWC.b8d1ee3da7ab5eda08e807c0a9dce15271bfef621d19451a3a84c1a3688ce4ce',
        ];
        $response = $this->httpClient->request(
            'GET', $api_url, [
            'headers' => $headers,
            ]
        );
        $data = json_decode($response->getBody());
 
        $nids = \Drupal::entityQuery('node')->condition('type', 'casts')->execute();
        $nodes= Node::loadMultiple($nids);
        foreach($nodes as $node){
            $first_names[] = $node->get('field_first_name')->value;
        }
        if (!empty($data->records)) {
            foreach ($data->records as $record) {
                $record_first_name = $record->fields->Casts;
                if(in_array($record_first_name, $first_names)) {
                    $id = \Drupal::entityQuery('node')->condition('type', 'casts');
                    $id = $id->condition('field_first_name', $record_first_name)->execute();
                }
           
                $node = Node::create(
                    [
                    'type' => 'videos', // Replace with your content type machine name.
                    'title' => $record->fields->Name ?? '',
                    'field_id' => $record->id ?? '',
                    'field_language' => $record->fields->Language ?? '',
                    'field_genre' => $record->fields->Genre ?? '',
                    'field_length' => $record->fields->Length ?? '',
                    'field_casts' => $id ?? '',
                    ]
                );
                $node->save();
            }
        }
        return new JsonResponse(['message' => 'Data imported from Airtable']);
    }
 
}