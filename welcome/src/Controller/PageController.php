<?php

namespace Drupal\welcome\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
/**
 * Defines PageController class.
 */
class PageController extends ControllerBase {

  /**
   * Return json format of node details for 
   * the page content type if siteapikey matched.
   *
   * @return string JSON
   *   
   */
    
    public function page($config_id, $nid){

        $serializer = \Drupal::service('serializer');
        $node = Node::load($nid);
        if($node){
          $type  =  $node->bundle();
          $config = \Drupal::config('system.site');
          $value_set = !empty($config->get('setapikey'))?$config->get('setapikey'):'';
          // Content type and siteapikey doesnt matched
            if( $type != "page" || $config_id != $value_set)  {
              throw new \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException(); // Access denied
            }
          $data = $serializer->serialize($node,'json',['plugin_id' => 'entity']);
          return [
              '#type' => 'markup',
              '#markup' => $data
              ,
          ];
        }
      else
        throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();  // 404, if node doesnt exists
  }

}