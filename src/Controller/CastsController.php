<?php

namespace Drupal\video_library\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Component\Serialization\Json;
use Drupal\node\Entity\Node;
// use Drupal\node\NodeInterface;

class CastsController extends ControllerBase {
    public function getDatas() {
        $client =\Drupal::httpClient();
        $headers = ['Authorization' => 'Bearer patEop5Jbx2u8t6vb.0f55cfd2cbafc09b90dc73ce78b38aded9603dd00ae068beee620a6577bb7989'];
        //$headers = ['Content-Type' => 'application/json'];
        $request = $client->get(
           "https://api.airtable.com/v0/appYs8zO2euY9axdz/tblcTxbKQwaLBLjUU",['headers'=> $headers]
        );
        $response = json_decode($request->getBody());

        if (!empty($response->records)) {
            foreach ($response->records as $record) {
                $node = Node::create([
                    'type' => 'casts', // Replace with your content type machine name.

                    'title' => $record->fields->First_Name ?? '',
                    'field_id1' => $record->fields->id ?? '',
                    // 'field_last' => $record->fields->LastName ?? '',
                    'field_description' => $record->fields->description ?? '',

                ]);
                $node->save();
            }

        }
        return new JsonResponse(['message' => 'Data imported from Airtable']);
        // return new JsonResponse($response);
//         $result=[];

//         $query = \Drupal::entityQuery('node')
//   ->condition('type', 'page')
//   ->condition('field_cast1', 'olaf', '=')
//   ->accessCheck(TRUE);
// $results = $query->execute();
//         // $query = \Drupal::entityQuery('node')
//         //               ->condition('type', 'videos');
//         //             $nodes_ids = $query->execute();
//         //             if ($nodes_ids) {
//         //                 foreach ($nodes_ids as $node_id) {
//         //                     $node = \Drupal\node\Entity\Node::load($node_id);
//         //                     $values = $node->get('field_casts1')->value;
//         //                     kint($values);
//         //                 }
//         //             }
//                     return $results;
    }
}