<?php
/**
 * Created by PhpStorm.
 * User: sanek
 * Date: 17.02.16
 * Time: 10:57
 */
// src/Blogger/BlogBundle/Controller/PageController.php

namespace Blogger\BlogBundle\Controller;
// Import new namespaces
use Blogger\BlogBundle\Entity\Enquiry;
use Blogger\BlogBundle\Form\EnquiryType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class PageController extends Controller {

    public function indexAction()
    {
        //$user_name = 'Saneg13';
        $user_name = '';

//        return $this->render('BloggerBlogBundle:Page:index.html.twig', array(
//            'name' => $user_name
//        ));
        $entities = $this->getDoctrine()
            ->getRepository('BloggerBlogBundle:Enquiry')
            ->findAll();
        if (!$entities) {
            throw $this->createNotFoundException(
                'No products found'
            );
        }

        return $this->render('BloggerBlogBundle:Page:index.html.twig', array('entities' => $entities));
    }

    public function aboutAction()
    {
        return $this->render('BloggerBlogBundle:Page:about.html.twig');
    }

    public function contactAction(Request $request)
    {
        $enquiry = new Enquiry();
        $form = $this->createForm(EnquiryType::class, $enquiry);

        $form->add('submit', 'submit', array('label' => 'Create'));
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                // Perform some action, such as sending an email
                // Redirect - This is important to prevent users re-posting
                // the form if they refresh the page
                return $this->redirect($this->generateUrl('BloggerBlogBundle_contact'));
            }
        }
        return $this->render('BloggerBlogBundle:Page:contact.html.twig', array(
            'form' => $form->createView()
        ));
        //return $this->render('BloggerBlogBundle:Page:contact.html.twig');
    }

    public function createAction(Request $request){

        $entity = new Enquiry();
        $form = $this->createForm(EnquiryType::class, $entity);

        $form->add('submit', 'submit', array('label' => 'Create'));

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('BloggerBlogBundle_homepage'));
            }
        }

        return $this->render('BloggerBlogBundle:Page:create.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

//    public function contactAction(Request $request)
//    {
//        $enquiry = new Enquiry();
//        $form = $this->createForm(EnquiryType::class, $enquiry);
//
//        if ($request->getMethod() == 'POST') {
//            $form->handleRequest($request);
//
//            if ($form->isValid()) {
//                $message = \Swift_Message::newInstance()
//                    ->setSubject('Contact enquiry from symblog')
//                    ->setFrom('enquiries@symblog.co.uk')
//                    ->setTo($this->container->getParameter('blogger_blog.emails.contact_email'))
//                    ->setBody($this->renderView('BloggerBlogBundle:Page:contactEmail.txt.twig', array('enquiry' => $enquiry)));
//                $this->get('mailer')->send($message);
//
//                $this->get('session')->set('blogger-notice', 'Your contact enquiry was successfully sent. Thank you!');
//
//                // Redirect - This is important to prevent users re-posting
//                // the form if they refresh the page
//                return $this->redirect($this->generateUrl('BloggerBlogBundle_contact'));
//            }
//        }
//
//        return $this->render('BloggerBlogBundle:Page:contact.html.twig', array(
//            'form' => $form->createView()
//        ));
//    }
}