<?php
use PHPUnit\Framework\TestCase;
use Fluid\Base\Response;
use App\Controller\IndexController;
use App\Events\DefaultIndexPage;

final class IndexControllerTest extends TestCase
{


    public function testIndexActionReturnsARespons()
    {
        add_listener(DefaultIndexPage::class, function ($Event) {
            $this->assertInstanceOf(DefaultIndexPage::class, $Event, 'Default Index page event is not an instance of: ' . DefaultIndexPage::class);
        });
        $this->assertInstanceOf(Response::class, execute(IndexController::class . '::indexAction'));
    }

    public function testGetDefaultContentReturnsAString()
    {
        $this->assertStringContainsString('<html>', execute(IndexController::class . '::getDefaultContent'), 'Index page content returned is not a valid html');
        $this->assertStringContainsString('<head>', execute(IndexController::class . '::getDefaultContent'), 'Index page content returned is not a valid html');
        $this->assertStringContainsString('<body>', execute(IndexController::class . '::getDefaultContent'), 'Index page content returned is not a valid html');
    }
}
