<?php

namespace SportBundle\Controller;

use Doctrine\DBAL\Driver\Connection;
use Doctrine\Common\ClassLoader;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use SportBundle\Entity\Sport;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SportController extends Controller
{

    /**
     * @Route("/sport", name="sport")
     */
    public function sportAction() // affichage des sports
    {
        $em = $this->getDoctrine()->getEntityManager();
        $liste = $em->getRepository('SportBundle:Sport')->findAll();


      //  $response = new JsonResponse();
      //  return $response->setData(array('s' => $liste));
        
        
        return $this->render('SportBundle:Default:sport.html.twig', array('s' =>$liste));
    }

    /**
     * @Route("/sport/{id}", name="sport_id")
     */
    public function sportIdAction($id)   // afficher les sports par id
    {
        $em = $this->getDoctrine()->getEntityManager();
        $sport = $em->getRepository('SportBundle:Sport')->find($id);
        $liste = $em->getRepository('SportBundle:Sport')->findAll();

        //  $response = new JsonResponse();
        //  return $response->setData(array('s' => $liste, 'p'=>$sport));

        return $this->render('SportBundle:Default:sport.html.twig', array('p'=>$sport,
                                                                            's'=>$liste));
    }

    /**
     * @Route("/sport/DBAL", name="liste")
     */
    public function sportDBALAction(Connection $conn) // affichage des sports avec DBAL
    {
        $liste = $conn->fetchAll('SELECT * FROM sport');
        return $this->render('SportBundle:Default:sport.html.twig', array('s' =>$liste));
    }

    /**
     * @Route("/sport/DBAL/ajouter")
     */
    public function addDBALAction() // ajouter des sports avec DBAL
    {
        $sport = new Sport();
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $sport);
        $formBuilder
            ->add('label',TextType::class)
            ->add('valider',      SubmitType::class);
        $form = $formBuilder->getForm();
        if ($form->isValid()) {
            //    $d = $conn->executeUpdate("INSERT INTO sport VALUES label = :label", array('label' => $form));
            //
        }
        return $this->render('SportBundle:DBAL:ajouter.html.twig', array(
            'form' => $form->createView(),
        ));

    }

}
