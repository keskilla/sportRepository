<?php

namespace SportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SportBundle\Entity\Sport;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;



class DefaultController extends Controller
{

    /**
     *@Route("/index", name="index")
     *@Method({"GET", "POST"})
     */
    public function addAction()
    {
        $request = $this->getRequest();
        $s = new Sport();
        $form = $this->createForm('SportBundle\Form\SportType', $s);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($s);
            $em->flush();

            return $this->redirectToRoute('sport', array('id' => $s->getId()));
        }

        return $this->render('SportBundle:Default:index.html.twig', array(
            's' => $s,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/editer/{id}", name="sport_edit")
     */
    public function editAction(Sport $sport)
    {
        
        $form = $this->createForm('SportBundle\Form\SportType', $sport);
        $request = $this->getRequest();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('sport', array('id' => $sport->getId()));
        }
        return $this->render('SportBundle:Default:index.html.twig', array(
            'form' => $form->createView(),
        ));
    }


        /**
         * @Route("/effacer/{id}", name="sport_delete")
         *
         */
        public function deleteAction( Sport $sport)
    {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sport);
            $em->flush();
        return $this->redirectToRoute('sport');
    }



}
