<?php

namespace App;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;

class Validator
{

    private $data;

    protected $errors = [];

    private $validator;

    private $fieldsValidate;


    /**
     * Validator constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data      = $data;
        $this->validator = Validation::createValidator();

    }

    /**
     * @return array[]|null
     */
    public function validate(): ?array
    {
        foreach ($this->data as $k => $v) {
            if ($k === 'email') {
                $this->validateEmail($this->data['email']);
                $this->fieldsValidate[] = 'email';
            } else if ($k === 'phone') {
                $this->validatePhone($this->data['phone']);
                $this->fieldsValidate[] = 'phone';
            }
        }

        if (!in_array('email', $this->fieldsValidate)) {
            $this->errors[] = 'Поле Email должно быть заполнено';
        }

        if (!in_array('phone', $this->fieldsValidate)) {
            $this->errors[] = 'Поле Телефон должно быть заполнено';
        }

        if (!empty($this->errors)) {
            return ['errors' => $this->errors];
        }

        return null;

    }

    /**
     * @param string $phone
     */
    private function validatePhone(string $phone): void
    {
        $violations = $this->validator->validate(
            $phone,
            [
                new Length(['max' => 15]),
                new NotBlank(),
            ]
        );

        foreach ($violations as $violation) {
            $this->errors[] = $violation->getMessage();
        }

    }

    /**
     * @param string $email
     */
    private function validateEmail(string $email): void
    {
        $violations = $this->validator->validate(
            $email,
            [
                new Length(['max' => 255]),
                new NotBlank(),
                new Email(),
            ]
        );

        foreach ($violations as $violation) {
            $this->errors[] = $violation->getMessage();
        }

    }
}
