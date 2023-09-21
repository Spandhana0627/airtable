<?php

namespace Drupal\video_library\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Component\Serialization\Json;
use Drupal\node\Entity\Node;
use Drupal\node\Entity\NodeType;

class APIController extends ControllerBase {
    // public function getData() {
    //     $client =\Drupal::httpClient();
    //     $headers = ['Authorization' => 'Bearer patti0WJTJtiQnIWC.b8d1ee3da7ab5eda08e807c0a9dce15271bfef621d19451a3a84c1a3688ce4ce'];
    //     // $headers = ['Content-Type' => 'application/json'];
    //     $request = $client->get(
    //         "https://api.airtable.com/v0/appYs8zO2euY9axdz/tbltm4cQAW0ZQ0jA9",['headers'=> $headers]
    //     );
    //     $response = json_decode($request->getBody());

    //     foreach ($response->records as $record) {
    //         // $genre[] = $record['fields']['Genre'];
    //         $ids[] = $record->id;
    //     }  
    //     $nids = \Drupal::entityQuery('node')->condition('type','videos')->execute();
    //     $nodes =  \Drupal\node\Entity\Node::loadMultiple($nids);
    //         //  kint($nodes);

    //         foreach($nodes as $node){
    //            $video_id[] =  $node->field_id->value;
    //         //    kint($video_id);
    //         }
    //         foreach($ids as $id){
    //             if(!in_array($id,$video_id)){
    //                 $node = Node::create([

    //                     'type' => 'videos', // Replace with your content type machine name.
              
    //                     'title' => $record->fields->Name ?? '',
    //                     'field_id' => $record->id ?? '',             
                      
              
    //                     // Add more field mappings here.
              
    //                   ]);
              
               
              
    //                   // Save the node.
              
    //                   $node->save();
    //             //     $node = Node::create([
    //             //         'type' => 'videos',
    //             //         'langcode' => 'en',
    //             //         'title' => 'My videos!',
    //             //         'field_genre' => $field_value,
    //             //     ]);
    //             //     $node->set('field_genre',$field_value);
    //             //     $node->save();
    //             //     // kint($node);
    //             // // }
    //             // if ($node) {
    //             //     $node->set('field_genre', $field_value);
    //             //     $node->save();

    //             }
    //         }
    //         // return new JsoneResponse(['message' => 'Data imported successfully']);

    //  return new JsonResponse($response);
    // }
}