<?php

namespace Drupal\axelerant_challenge\Controller;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Controller\ControllerBase;
use Drupal\node\NodeInterface;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Controller routines for AxelerantChallenge routes.
 */
class AxelerantChallengeController extends ControllerBase {

  /**
   * function return the node data
   * @param $api_key strin type
   * @param NodeInterface $node
   * @return array
   */

  public function content($api_key, NodeInterface $node) {

    $output = array();
    $output = array('node' => $node->toArray());
    return new JsonResponse($output);

  }

  /**
   *
   * Access callback function for routing menu
   * @param $api_key String type
   * @param NodeInterface $node object node
   *
   * @return \Drupal\Core\Access\AccessResultAllowed|\Drupal\Core\Access\AccessResultForbidden
   */
  public function axelerantNodeAccess($api_key, NodeInterface $node) {

    if (\Drupal::configFactory()->getEditable('system.site')->get('siteapikey') == $api_key && $node->getType() == 'page') {
      return AccessResult::allowed();
    }

    else {
      return AccessResult::forbidden();
    }

 }
}