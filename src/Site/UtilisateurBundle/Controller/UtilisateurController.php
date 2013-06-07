<?php

namespace Site\UtilisateurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Site\UtilisateurBundle\Entity\Utilisateur;
use Site\UtilisateurBundle\Form\UtilisateurInscriptionType;

class UtilisateurController extends Controller
{
    public function inscriptionAction()
    {
        $utilisateur = new Utilisateur();
        $request = $this->getRequest();
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        
        if($session->get('rang') == 'Administrateur'){
            $form = $this->createForm(new UtilisateurInscriptionType, $utilisateur);
            if($request->getMethod() == 'POST'){
                $form->bind($request);
                $mdp = $utilisateur->getPassword();
                $utilisateur->setPassword(sha1($utilisateur->getPassword()));
                $em->persist($utilisateur);
                $em->flush();
                $session->getFlashBag()->add('success', 'Le compte '.$utilisateur->getRang().' <strong>'.$utilisateur->getPseudo().'</strong> peut maintenant se connecter avec le mot de passe : <strong>'.$mdp.'</strong>');
                return $this->redirect($this->generateUrl('utilisateur_inscription'));
            }
            return $this->render('SiteUtilisateurBundle::inscription.html.twig', array(
                'form' => $form->createView(),
            ));
        }   
        return $this->redirect($this->generateUrl('index')); 
    }

    public function connexionAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        if(!$session->has('id')){
            $form = $this->createFormBuilder()
                ->add('pseudo', 'text', array('label' => 'Login : '))
                ->add('password', 'password', array('label' => 'Password : '))
                ->getForm();
            if($request->getMethod() == 'POST'){
                $form->bind($request);
                $data = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $user = $em->getRepository('SiteUtilisateurBundle:Utilisateur')->findOneBy(array('pseudo' => $data['pseudo'], 'password' => sha1($data['password'])));
                if($user){
                    $session->set('id', $user->getId());
                    $session->set('pseudo', $data['pseudo']);
                    $session->set('rang', $user->getRang());
                    return $this->redirect($this->generateUrl('index'));
                }else{
                    $session->getFlashBag()->add('error', 'Mauvais login et/ou mot de passe');
                }
            }
        }else{
            $session->getFlashBag()->add('error', 'vous êtes déjà connecté !');
            return$this->redirect($this->generateUrl('index'));
        }
        return $this->render('SiteUtilisateurBundle::connexion.html.twig', array('form' => $form->createView()));
    }
}