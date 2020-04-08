<?php

namespace Drupal\custom_alters\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\NodeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ContentDisplayController.
 */
class ContentDisplayController extends ControllerBase {

  /**
   * Return node data as json output.
   *
   * @param string $api_key
   *   API Key.
   * @param NodeInterface $node
   *   Node object.
   *
   * @return JsonResponse
   *   Return the json output.
   */
  public function content($api_key, NodeInterface $node) {
    // Get the saved API Key.
    $valid_api_key = $this->config('system.site')->get('siteapikey');
    // If the Content type is "Basic Page" and
    // if the api key from the url matches the one saved with us, then return response.
    // If both the above cases fail, return access denied.
    if ($node->getType() === 'page' && $valid_api_key === $api_key) {
      return new JsonResponse([$node->toArray(), 200]);
    }
    else {
      return new JsonResponse(['Access Denied', 401]);
    }
  }

}
