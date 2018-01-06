<?php

namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManagerInterface;
use Application\Entity\Article;
use Zend\Paginator\Paginator;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;

class IndexController extends AbstractActionController
{
    private $entityManager;
    private $articleRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->articleRepository = $entityManager->getRepository(Article::class);
    }

    public function indexAction()
    {
        $queryBuilder = $this->articleRepository->getQueryBuilder();
        $adaptor = new DoctrinePaginator(new ORMPaginator($queryBuilder));
        $paginator = new Paginator($adaptor);

        if ($paginator) {
            $pageNumber = $this->params()->fromRoute('page', 0);
            $paginator->setCurrentPageNumber($pageNumber);

            $itemCountPerPage = 10;
            $paginator->setItemCountPerPage($itemCountPerPage);
        }

        //$articles = $this->articleRepository->findAll();

        return new ViewModel([
            'articles' => $paginator,
        ]);
    }

    public function articleAction()
    {
        $id = $this->params()->fromRoute('id', 0);
        $article = $this->articleRepository->find($id);

        return new ViewModel([
            'article' => $article,
        ]);
    }
}
