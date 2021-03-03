<?= "<?php\n" ?>

namespace App\Controller\StratusPage;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\StratusPage\<?= $page_class_name; ?>;
use ThenLabs\StratusPHP\Request as StratusRequest;
use function Opis\Closure\{serialize as s, unserialize as u};
use Twig\Environment;

/**
 * @Route("/<?= $page_name ?>", name="<?= $page_name ?>_")
 */
class <?= $class_name ?> extends AbstractController
{
    /**
     * @Route("/", name="page")
     */
    public function page(SessionInterface $session, Environment $twig): Response
    {
        $page = new <?= $page_class_name; ?>;
        $page->setController($this);
        $page->setAjaxControllerUri($this->generateUrl('<?= $page_name ?>_ajax'));
        $page->runPlugins();

        $session->set('<?= $page_name ?>', s($page));

        return new Response($page->render());
    }

    /**
     * @Route("/ajax", name="ajax")
     */
    public function ajax(Request $request, SessionInterface $session): Response
    {
        $response = new StreamedResponse(function () use ($request, $session) {
            $page = u($session->get('<?= $page_name ?>'));
            $page->setController($this);

            $stratusRequest = StratusRequest::createFromJson(
                $request->request->get('stratus_request')
            );

            $result = $page->run($stratusRequest);

            if ($result->isSuccessful()) {
                $session->set('<?= $page_name ?>', s($page));
            }
        });

        $response->send();

        return $response;
    }
}
