<?php
namespace Drupal\video_library\Controller;
 
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Component\Serialization\Json;
use Drupal\node\Entity\Node;
 
class CastsController extends ControllerBase
{
    public function getDatas()
    {
        $client =\Drupal::httpClient();
        $headers = ['Authorization' => 'Bearer patEop5Jbx2u8t6vb.0f55cfd2cbafc09b90dc73ce78b38aded9603dd00ae068beee620a6577bb7989'];
        //$headers = ['Content-Type' => 'application/json'];
        $request = $client->get(
            "https://api.airtable.com/v0/appYs8zO2euY9axdz/tblcTxbKQwaLBLjUU", ['headers'=> $headers]
        );
        $response = json_decode($request->getBody());
 
        if (!empty($response->records)) {
            foreach ($response->records as $record) {
                $firstName = $record->fields->First_Name;
                $lastName = $record->fields->Last_Name;
                $node = Node::create(
                    [
                    'type' => 'casts',
                    'title' => $firstName . ''. $lastName,
                    'field_id1' => $record->fields->id ?? '',
                    'field_first_name' => $firstName,
                    'field_last_name' => $lastName,
                    'field_description' => $record->fields->description ?? '',
                    ]
                );
                $node->save();
            }
 
        }
        return new JsonResponse(['message' => 'Data imported from Airtable']);
    }    

 
}