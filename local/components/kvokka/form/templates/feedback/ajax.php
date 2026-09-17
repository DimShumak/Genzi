<?
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
 use Bitrix\Main\Mail\Event;
CModule::IncludeModule("form");

    if ($RESULT_ID = CFormResult::Add(1, $_REQUEST))
    {
        $result = Event::send(array(
                "EVENT_NAME" => "FEEDBACK_FORM",
                "LID" => "s1",
                "C_FIELDS" => array(
                    "NAME" => $_REQUEST['form_text_1'],
                    "NUMBER" => $_REQUEST['form_text_2'],
                    "EMAIL" => $_REQUEST['form_text_3'],
                    "ANSWER" => $_REQUEST['form_text_4']
                ),
            ));
            if ($result) {
                echo 200;
            } else {
                echo "Ошибка отправки";
            }
    }
    else
    {
        global $strError;
        echo $strError;
    }



require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php';