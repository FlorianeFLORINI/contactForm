<?php

namespace Contact\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Contact\ContactBundle\Entity\Contact;
use Symfony\Component\HttpFoundation\Request;
use Contact\ContactBundle\Form\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class ContactController extends Controller
{
    public function askResponseAction()
    {
        return $this->render('@ContactContact/Contact/demandeTransmise.html.twig');
    }


//affiche le formulaire de contact et hydrate l'entité 'contact'
    public function contactAction(Request $request)
    {
        $contact = new Contact();
        $contact->setdate(new \DateTime('now'));

        $form = $this->createForm(ContactType::class, $contact);

        if ($request->isMethod('POST') AND $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            return $this->redirect($this->generateUrl('home'));
        }

        return $this->render('@ContactContact/Contact/contact.html.twig', array(
                'form' => $form->createView(),)
        );
    }

//pour consulter la liste de toutes les questions
//gestion des accès via annotation, login:admin - mdp:admin
    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function liste_questionsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $listQuest = $em->getRepository('ContactContactBundle:Contact')->findBy(
            array('traite'=>'0'),
            array('date' => 'DESC')
        );
        $listQuestLu = $em->getRepository('ContactContactBundle:Contact')->lu();

        return $this->render('@ContactContact/Contact/list_questions.html.twig', array(
            'listQuest' => $listQuest,
            'listQuestLu' => $listQuestLu));
    }

//pour mettre la demande passée en post en lu
    public function checkAction(Request $request, $id)
    {
        if ($request->isMethod('POST'))
        {
            $em = $this->getDoctrine()->getManager();
            $contact = $em->getRepository('ContactContactBundle:Contact')->find($id);

            $contact->setTraite(1);
            $em->flush();
        }
        return $this->redirect($this->generateUrl('list_questions'));
    }

//pour mettre la demande passée en post en non lue
    public function nonCheckAction(Request $request, $id)
    {
        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $contact = $em->getRepository('ContactContactBundle:Contact')->find($id);

            $contact->setTraite(0);
            $em->flush();
        }
        return $this->redirect($this->generateUrl('list_questions'));
    }

}
