<?= "<?php\n" ?>

namespace App\StratusPage;

use ThenLabs\Bundle\StratusBundle\AbstractPage;

class <?= $class_name; ?> extends AbstractPage
{
    public function getView(): string
    {
        $twig = $this->controller->get('twig');

        return $twig->render('<?= $template_path; ?>');
    }
}
