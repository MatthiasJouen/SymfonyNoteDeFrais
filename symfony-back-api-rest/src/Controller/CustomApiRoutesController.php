<?php

namespace App\Controller;

use App\DTO\NoteFraisOutputDTO;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomApiRoutesController extends AbstractController
{
    #[Route("/api/user/{id}/note_frais", name: "get_user_note_frais", methods: ["GET"])]
    public function getUserNoteFrais(int $id, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($id);

        if (!$user) {
            throw $this->createNotFoundException('No user found for id '.$id);
        }

        $noteFrais = $user->getNoteFrais();

        $noteFraisDTOs = [];
        foreach ($noteFrais as $note) {
            $dto = new NoteFraisOutputDTO();
            $dto->id = $note->getId();
            $dto->date = $note->getDate();
            $dto->user = $user->getName().' '.$user->getSurname();
            $dto->amount = $note->getAmount();
            $dto->saveDate = $note->getSaveDate();
            $dto->noteType = $note->getNoteType()->getName();
            $dto->company = $note->getCompany()->getName();
            $noteFraisDTOs[] = $dto;
        }

        return $this->json($noteFraisDTOs);
    }
}
