<?= "<?php\n" ?>

namespace App\StratusPage;

use ThenLabs\Bundle\StratusBundle\Annotation\StratusPage;
use ThenLabs\Bundle\StratusBundle\AbstractPage;
use ThenLabs\StratusPHP\Plugin\SElements\SElementsTrait;

/**
 * @StratusPage(template="<?= $template_path; ?>")
 */
class <?= $class_name; ?> extends AbstractPage
{
}
