<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UserController extends AbstractController
{
    #[Route('users/add-user',name:'addUser')]
    public function addUser():Response
    {
        return $this->render('users/addUser.html.twig',[
            'title' => 'Add User',
            'subTitle' => 'Add User',
        ]);
    }

    #[Route('users/users-grid',name:'usersGrid')]
    public function usersGrid():Response
    {
        return $this->render('users/usersGrid.html.twig',[
            'title' => 'Users Grid',
            'subTitle' => 'Users Grid',
        ]);
    }
    #[Route('users/users-list',name:'usersList')]
    public function usersList():Response
    {
        return $this->render('users/usersList.html.twig',[
            'title' => 'Users List',
            'subTitle' => 'Users List',
        ]);
    }
    #[Route('users/view-profile',name:'viewProfile')]
    public function viewProfile():Response
    {
        return $this->render('users/viewProfile.html.twig',[
            'title' => 'View Profile',
            'subTitle' => 'View Profile',
        ]);
    }
}



