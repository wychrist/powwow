<?php

namespace App\Controller;

use Fluid\Base\Response;
use Fluid\Http\Controller as BaseController;

class PageController extends BaseController
{

   public function indexAction(string|int $id, Response $response)
   {
      $content = 'In';
      if ($id == '5' || $id == 'about-us') {
         $content = $this->aboutUs();
      }

      return $response->setContent($content);
   }

   private function aboutUs()
   {
      $data = include_once content_dir('data/paper_2/about_us_template.php');
      $data['page']->title = 'This is a new title'; // we are overriding the title for the page

      $whoWeAreChildren = $data['whoWeAre']->children;

      // we are overriding the content for the first page in section 1
      $whoWeAreChildren[0]->content = 'We are working hard in wyreema and we are loving it';

      $data['whoWeAre']->children = $whoWeAreChildren;

      return render_template('templates/about_us_template', $data);
   }
}
