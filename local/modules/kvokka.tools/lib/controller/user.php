<?

namespace Kvokka\Tools\Controller;

use \Bitrix\Main\Engine\Controller;
use \Bitrix\Main\Application;


class User extends Controller
{
    public function configureActions()
    {
        return [
            'section' => [
                'prefilters' => [],
            ],
        ];
    }

    public function sectionAction(int $id)
    {
        $session = Application::getInstance()->getSession();
        $session->set('user_section_id', $id);

        return true;
    }
}
