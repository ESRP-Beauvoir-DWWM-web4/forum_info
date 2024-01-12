<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Commentaire;
use App\Form\CommentaireInlineType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'articles' => $articleRepository->findAll(),
        ]);
    }

    #[Route('/lire/{id}', name: 'app_single', methods: ['GET', 'POST'])]
    public function single(Article $article, Request $request, EntityManagerInterface $entityManager): Response
    {
        $commentaire = new Commentaire();
        $user = $this->getUser();
        $date = new \Datetime('now');
        $form = $this->createForm(CommentaireInlineType::class, $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentaire->setDate($date);
            $commentaire->setAuteur($user);
            $commentaire->setArticle($article);
            $entityManager->persist($commentaire);
            $entityManager->flush();

            return $this->redirectToRoute('app_single', ['id' => $article->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('home/single.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }
}
