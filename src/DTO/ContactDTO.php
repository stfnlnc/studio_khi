<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class ContactDTO
{
    #[Assert\NotBlank(message: "Le champ doit être complété")]
    #[Assert\Length(min: 1, max: 200, minMessage: 'Le champ doit contenir au moins 1 caractère', maxMessage: 'Le champ doit contenir au maximum 200 caractères')]
    public string $lastname;

    #[Assert\NotBlank(message: "Le champ doit être complété")]
    #[Assert\Length(min: 1, max: 200, minMessage: 'Le champ doit contenir au moins 1 caractère', maxMessage: 'Le champ doit contenir au maximum 200 caractères')]
    public string $firstname;

    #[Assert\NotBlank(message: "Le champ doit être complété")]
    #[Assert\Email(message: "Votre email n'est pas valide")]
    public string $email;

    #[Assert\NotBlank(message: "Le champ doit être complété")]
    #[Assert\Length(min: 10, max: 20, minMessage: 'Le numéro doit contenir au minimum 10 caractères', maxMessage: 'Le numéro doit contenir au maximum 20 caractères')]
    public string $phone;

    public string $message;
}