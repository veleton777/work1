<?php

namespace App\Controller;

use App\DB;
use App\Validator;

class IndexController
{
    public function form(): void
    {
        echo file_get_contents(DOCUMENT_ROOT . '/views/form.html');
    }

    public function formAction(): void
    {
        $email = trim(strip_tags($_POST['email'])) ?? '';
        $phone = trim(strip_tags($_POST['phone'])) ?? '';
        $message = trim(strip_tags($_POST['message'])) ?? '';

        $data = ['email' => $email, 'phone' => $phone];

        $validator = new Validator($data);
        $errors = $validator->validate();

        if ($errors) {
            echo json_encode($errors);
            return;
        }

        $db = DB::create();
        $res = $db->query(
            "
            INSERT INTO messages(phone, email, message)
            VALUES(?, ?, ?)
        ", $phone, $email, $message
        );

        if ($res) {
            echo json_encode(['status' => 'ok']);
            return;
        }

        echo json_encode(['status' => 'error']);
    }
}