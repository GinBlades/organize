<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $tasks = $this->em->getRepository("AppBundle:Task")->findActive();
        $form = $this->createForm("AppBundle\Form\TaskType", new Task());
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            "tasks" => $tasks,
            "taskForm" => $form->createView()
        ]);
    }
}
