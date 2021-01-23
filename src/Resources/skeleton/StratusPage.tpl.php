<?= "<?php\n" ?>

namespace App\StratusPage;

use ThenLabs\Bundle\StratusBundle\Annotation\StratusPage;
use ThenLabs\Bundle\StratusBundle\AbstractPage;

/**
 * @StratusPage(template="<?= $template_path; ?>")
 */
class <?= $class_name; ?> extends AbstractPage
{
}
